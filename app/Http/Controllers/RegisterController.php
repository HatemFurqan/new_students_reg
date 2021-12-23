<?php

namespace App\Http\Controllers;

use App\FilesHelper;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\NewStudent;
use App\Models\Register;
use App\Models\StoppedStudent;
use App\Models\Student;
use App\Models\Subscribe;
use App\Service\Payment\Checkout;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    use FilesHelper;

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function register(Request $request)
    {
//        $this->validation($request);
        $data = $request->all();

        $data['name'] = $this->concatenateName($data);

        if ($request->hasFile('student_id')) {
            $data['student_id'] = $this->fileUpload($request->file('student_id'), 'files');
        }

        if ($request->hasFile('parent_id')) {
            $data['parent_id'] = $this->fileUpload($request->file('parent_id'), 'files');
        }
        Register::create($data);
        return view('welcome');
    }

    /**
     * @param array $names
     * @return string
     */
    private function concatenateName(array $names): string
    {
        return $names['first_name'] . ' ' . $names['father_name'] . ' ' . $names['grandfather_name'] . ' ' . $names['nickname'];
    }

    /**
     * @param string $token
     * @param array $customer
     * @return string
     */
    public function payment(string $token, array $customer, $amount)
    {
        $result = (new Checkout())->payment($token, $customer, $amount);

        return $result;
    }

    public function subscribeNewStudent(Request $request)
    {

        $request->validate([
            'signature' => 'required|string',
            'payment_method' => 'required|string',
            'favorite_time' => 'required|string',
            'study_before' => 'required|string',
        ]);

        if ($request->payment_method == 'hsbc'){
            $request->validate([
                'money_transfer_image_path' => 'required|mimes:jpeg,jpg,bmp,gif,svg,webp,png,pdf,doc,docx',
                'bank_name'     => 'required|string',
                'account_owner' => 'required|string',
                'transfer_date' => 'required|date',
                'bank_reference_number' => 'required|string',
            ]);
        }else{
            $request->validate([
                'token_pay' => 'required|string',
            ]);
        }
        // payment methods validation here is ok

        if ($request->study_before == 'yes'){
            $request->validate([
                'student_number' => 'required|exists:students,serial_number',
                'section' => 'required',
                'student_name' => 'required|string',
                'nationality_studied' => 'required|string',
                'country_residence_studied' => 'required|string',
                'city_studied' => 'required|string',
                'postal_code_studied' => 'required|string',
                'place_birth_studied' => 'required|string',
                'id_number_studied' => 'required|string',
                'father_whatsApp_number_studied' => 'required|string',
                'mother_whatsApp_number_studied' => 'required|string',
                'father_email_studied' => 'required|string',
                'mother_email_studied' => 'required|string',
                'preferred_language_studied' => 'required|string',
                'address_studied' => 'required|string',
            ]);

            $student = Student::query()
                ->where('serial_number', '=', $request->student_number)
                ->where('section', '=', $request->section)
                ->first();

            if (is_null($student)){
                session()->flash('error', __('resubscribe.The student ID is not in our records'));
                return redirect()->route('semester.indexOneToOne');
            }

            if ($student->status == 1){
                session()->flash('error', __('one-to-one.Sorry just'));
                return redirect()->route('semester.indexOneToOne');
            }

            Session::put('student_id', $student->id);
            $course = Course::query()->where('code', 'new-students')->first();
            $amount = $course->amount;

            if (isset($request->hidden_apply_coupon) && !empty($request->hidden_apply_coupon)){
                $coupon_code = $request->hidden_apply_coupon;
                $coupon = Coupon::where('code', $coupon_code)->where('course_id', $course->id)->first();

                if (@$coupon->is_valid){
                    $discount    = $coupon->getDiscount($course->amount);
                    $base_amount = $course->amount;
                    $amount = ($base_amount - $discount);
                    $coupon->use($student->id);
                }
            }

            $stoppedStudent = StoppedStudent::query()->create([
                'student_id' => $student->id,
                'favorite_time' => $request->favorite_time,
                'nationality_id' => $request->nationality_studied,
                'country_residence_id' => $request->country_residence_studied,
                'city' => $request->city_studied,
                'postal_code' => $request->postal_code_studied,
                'place_birth' => $request->place_birth_studied,
                'address' => $request->address_studied,
                'id_number' => $request->id_number_studied,
                'father_whatsApp_number' => $request->father_whatsApp_number_studied,
                'mother_whatsApp_number' => $request->mother_whatsApp_number_studied,
                'father_email' => $request->father_email_studied,
                'mother_email' => $request->mother_email_studied,
                'preferred_language' => $request->preferred_language_studied,
            ]);

            if ($request->payment_method == 'checkout_gateway') {

                $customer = ['email' => $request->father_email_studied, 'name' => $request->student_name];
                $result  = $this->payment($request->token_pay, $customer, $amount);

                $subscribe = Subscribe::query()->create([
                    'student_id' => $student->id,
                    'country_id' => $request->country_residence_studied,
                    'email' => $request->father_email_studied,
                    'payment_method' => 'checkout_gateway',
                    'payment_id' => Session::get('payment_id'),
                    'reference_number' => Session::get('reference_number'),
                    'payment_status' => Session::get('payment_status'),
                    'form_type' => 'stopped-students',
                    'response_code' => $result->response_code ?? '-',
                    'coupon_id' => $coupon->id ?? null,
                    'discount_value' => $discount ?? 0.00,
                    'coupon_code' => $coupon->code ?? null,
                ]);

                Session::forget('payment_id');
                Session::forget('payment_status');
                Session::forget('reference_number');

                $redirection = $result->getRedirection();
                if ($redirection){
                    return Redirect::to($redirection);
                }else{
                    if ($result->approved){
                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed!'));
                    }
                    return redirect()->route('semester.indexOneToOne');
                }

            }else{
                $subscribe = Subscribe::query()->create([
                    'student_id' => $student->id,
                    'country_id' => $request->country_residence_studied,
                    'email' => $request->father_email_studied,
                    'payment_method' => $request->payment_method,
                    'money_transfer_image_path' => $request->file('money_transfer_image_path')->store('public/money_transfer_images'),
                    'bank_name' => $request->bank_name,
                    'account_owner' => $request->account_owner,
                    'transfer_date' => $request->transfer_date,
                    'bank_reference_number' => $request->bank_reference_number,
                    'form_type' => 'stopped-students',
                ]);
            }

            session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
            return redirect()->route('semester.indexOneToOne');
        }else{
            $request->validate([
                'study_before' => 'required|string',
                'favorite_time' => 'required|string',
                'birthdate' => 'required|string',
                'first_name' => 'required|string',
                'father_name' => 'required|string',
                'grandfather_name' => 'required|string',
                'family_name' => 'required|string',
                'nationality' => 'required|string',
                'country_residence' => 'required|string',
                'city' => 'required|string',
                'postal_code' => 'required|string',
                'place_birth' => 'required|string',
                'address' => 'required|string',
                'id_number' => 'required|string',
                'father_whatsApp_number' => 'required|string',
                'mother_whatsApp_number' => 'required|string',
                'father_email' => 'required|string',
                'mother_email' => 'required|string',
                'preferred_language' => 'required|string',
                'guardian_name' => 'required|string',
                'guardian_work' => 'required|string',
                'mother_name' => 'required|string',
                'mother_work' => 'required|string',
                'social_situation' => 'required|string',
                'chronic_disease' => 'required|string',
                'quran_school' => 'required|string',
                'studied_qaeedah' => 'required|string',
                'guardian_commitment' => 'required|string',
                'student_id' => 'required|mimes:jpeg,jpg,bmp,gif,svg,webp,png,pdf,doc,docx',
                'guardian_id' => 'required|mimes:jpeg,jpg,bmp,gif,svg,webp,png,pdf,doc,docx',
            ]);

            if ($request->social_situation == 'other'){
                $social_situation = $request->other_social_situation;
            }else{
                $social_situation = $request->social_situation;
            }

            $newStudent = NewStudent::query()->create([
                'bod' => $request->birthdate,
                'favorite_time' => $request->favorite_time,
                'first_name' => $request->first_name,
                'father_name' => $request->father_name,
                'grandfather_name' => $request->grandfather_name,
                'family_name' => $request->family_name,
                'section' => $request->new_student_section,
                'nationality_id' => $request->nationality,
                'country_residence_id' => $request->country_residence,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'place_birth' => $request->place_birth,
                'address' => $request->address,
                'id_number' => $request->id_number,
                'father_whatsApp_number' => $request->father_whatsApp_number,
                'mother_whatsApp_number' => $request->mother_whatsApp_number,
                'father_email' => $request->father_email,
                'mother_email' => $request->mother_email,
                'preferred_language' => $request->preferred_language,
                'guardian_name' => $request->guardian_name,
                'guardian_work' => $request->guardian_work,
                'mother_name' => $request->mother_name,
                'mother_work' => $request->mother_work,
                'social_situation' => $social_situation,
                'current_disease' => $request->current_disease,
                'name_school' => $request->name_school,
                'studied_qaeedah' => $request->studied_qaeedah == 'yes' ? '1' : '0',
                'student_id_image' => $request->file('student_id')->store('public/new_students'),
                'guardian_id_image' => $request->file('guardian_id')->store('public/new_students'),
            ]);

            if ($request->payment_method == 'checkout_gateway') {

                Session::put('student_id', $newStudent->id);
                $course = Course::query()->where('code', 'new-students')->first();
                $amount = $course->amount;

                $student_name = $request->first_name . ' ' . $request->father_name . ' ' . $request->grandfather_name . ' ' . $request->family_name;

                $customer = ['email' => $request->father_email, 'name' => $student_name];

                $result  = $this->payment($request->token_pay, $customer, $amount);

                $subscribe = Subscribe::query()->create([
                    'new_student_id' => $newStudent->id,
                    'country_id' => $request->country_residence,
                    'email' => $request->father_email,
                    'payment_method' => 'checkout_gateway',
                    'payment_id' => Session::get('payment_id'),
                    'reference_number' => Session::get('reference_number'),
                    'payment_status' => Session::get('payment_status'),
                    'form_type' => 'new-students',
                    'response_code' => $result->response_code ?? '-',
                    'coupon_id' => $coupon->id ?? null,
                    'discount_value' => $discount ?? 0.00,
                    'coupon_code' => $coupon->code ?? null,
                ]);

                Session::forget('payment_id');
                Session::forget('payment_status');
                Session::forget('reference_number');

                $redirection = $result->getRedirection();
                if ($redirection){
                    return Redirect::to($redirection);
                }else{
                    if ($result->approved){
                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed!'));
                    }
                    return redirect()->route('semester.indexOneToOne');
                }

            }else{
                $subscribe = Subscribe::query()->create([
                    'new_student_id' => $newStudent->id,
                    'country_id' => $request->country_residence,
                    'email' => $request->father_email,
                    'payment_method' => $request->payment_method,
                    'money_transfer_image_path' => $request->file('money_transfer_image_path')->store('public/money_transfer_images'),
                    'bank_name' => $request->bank_name,
                    'account_owner' => $request->account_owner,
                    'transfer_date' => $request->transfer_date,
                    'bank_reference_number' => $request->bank_reference_number,
                    'form_type' => 'new-students',
                ]);
            }

            session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
            return redirect()->route('semester.indexOneToOne');
        }
        // =========================================
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function checkStudentExists(Request $request)
    {
        $student = Register::find($request->get('student_id'));

        if ($student) {
            return $student->name;
        }
        return response('not found', 404);
    }

    /**
     * @param Request $request
     */
    private function validation(Request $request)
    {
        $request->validate([
            'sex' => ['sometimes', 'string'],
            'period' => ['sometimes', 'string'],
            'dob' => ['sometimes', 'string'],
            'payment_method' => ['sometimes', 'string'],
            'serial_number' => ['sometimes', 'string'],
            'name' => ['sometimes', 'string'],
            'nationality' => ['sometimes', 'string'],
            'country_of_residence' => ['sometimes', 'string'],
            'city' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string'],
            'post_code' => ['sometimes', 'string'],
            'place_of_birth' => ['sometimes', 'string'],
            'id_passport_number' => ['sometimes', 'string'],
            'student_fathers_mobile_number' => ['sometimes', 'string'],
            'student_mothers_mobile_number' => ['sometimes', 'string'],
            'student_fathers_email' => ['sometimes', 'string'],
            'student_mothers_email' => ['sometimes', 'string'],
            'preferred_language' => ['sometimes', 'string'],
            'student_fathers_name' => ['sometimes', 'string'],
            'student_fathers_employer' => ['sometimes', 'string'],
            'student_mothers_name' => ['sometimes', 'string'],
            'student_mothers_employer' => ['sometimes', 'string'],
            'student_social_status' => ['sometimes', 'string'],
            'student_disease' => ['sometimes', 'string'],
            'participated' => ['sometimes', 'string'],
            'al_nooraniah' => ['sometimes', 'string'],
            'student_id' => ['sometimes', 'string'],
            'parent_id' => ['sometimes', 'string'],
        ]);
    }
}
