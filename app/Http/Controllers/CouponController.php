<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function applyCoupon()
    {
        $code = \request()->query('code');

        $study_before = \request()->query('study_before');
        if ($study_before == 'yes'){
            $student_number = \request()->query('std_number');
            $student = Student::query()->where('serial_number', $student_number)->first();
            if (!$student){
                return response()->json(['msg' => __('resubscribe.Please enter your student number')], 404, [], JSON_UNESCAPED_UNICODE);
            }
            Session::put('student_id', $student->id);
        }else{
            Session::put('student_type', 'new_student');
        }

        $course = Course::query()->where('code', 'new-students')->first();
        $coupon = Coupon::where('code', $code)->where('course_id', $course->id)->first();

        if (@$coupon->is_valid){
            $discount    = $coupon->getDiscount($course->amount)/100;
            $base_amount = $course->amount/100;
            return response()->json(['discount' => $discount, 'base_amount' => $base_amount, 'price_after_discount' => ($base_amount - $discount)], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['msg' => __('resubscribe.Cant use this coupon')], 404, [], JSON_UNESCAPED_UNICODE);
    }

}
