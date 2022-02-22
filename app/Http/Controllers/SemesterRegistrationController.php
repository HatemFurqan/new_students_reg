<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\FavoriteTime;
use App\Models\Student;
use App\Models\Subscribe;
use App\Service\Payment\Checkout;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\json_decode;

class SemesterRegistrationController extends Controller
{

    private $payment_link;
    private $secret;
    private $public;

    public function __construct()
    {
        $config = config('checkoutpayment');
        $this->payment_link = $config['checkout_link'];
        $this->secret = $config['checkout_sk'];
        $this->public = $config['checkout_pk'];
    }

    public function thankYouPage()
    {

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students')->first();

        return view('thank-you-page', ['countries' => $countries, 'course' => $course]);
    }

    public function indexOneToOne()
    {

        if(request()->query('cko-session-id')){
            $client = new Client(['base_uri' => $this->payment_link]);

            try {

                $response = $client->request('GET', '/payments/' . request()->query('cko-session-id'),
                    [
                        'headers' => [
                            'Authorization' => config('checkoutpayment.checkout_sk')
                        ]
                    ]);

                $data = json_decode($response->getBody()->getContents());

                if ($response->getStatusCode() != 404){

                    $subscribe = Subscribe::query()
                        ->where('payment_id', '=', $data->id)
                        ->first();

                    $result = $subscribe->update([
                        'payment_status' => $data->status,
                        'response_code'  => $data->actions[0]->response_code ?? '-',
                    ]);

                    if ($data->approved){
                        session()->flash('success', __('resubscribe.The registration process has been completed successfully'));
                    }else{
                        session()->flash('error', __('resubscribe.Payment failed'));
                    }

                }else{
                    session()->flash('error', __('resubscribe.Payment failed'));
                }

                return redirect()->route('semester.thankYouPage');
            }catch (\GuzzleHttp\Exception\ClientException $e) {
//                $response = $e->getResponse();

                session()->flash('error', __('resubscribe.Payment failed'));
                return redirect()->route('semester.thankYouPage');
            }
        }

        $countries = Country::query()->where('lang', '=', App::getLocale())->get();
        $course = Course::query()->where('code', '=', 'new-students')->first();

        return view('one-to-one', ['countries' => $countries, 'course' => $course]);
    }

    public function getStudentInfo()
    {
        $student = Student::query()
            ->where('serial_number', '=', \request()->std_number)
            ->where('section', '=', \request()->std_section)
            ->first();


        if (\request()->query('form_type') == 'new_students' && $student){
            if ($student->status == 1){
                return response()->json(['msg' => __('To register in the semester')], 500);
            }
        }

        if ($student){
            return response()->json(['name' => $student->name], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['msg' => __('resubscribe.serial number is incorrect')], 404);
    }

}
