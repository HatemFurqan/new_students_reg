<?php

namespace App\Models;

use App\Notifications\SubscribeNotification;
use App\Services\GoogleSheet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Subscribe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        static::created(function($subscribe) {
            $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
            $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

            $course = Course::query()->where('code', '=', 'new-students')->first();
            $price = $course->price - ($subscribe->discount_value/100);

            $image_path = '-';
            if($subscribe->money_transfer_image_path){
                $image_path = url(Storage::url($subscribe->money_transfer_image_path));
            }

            $relation = 'stoppedStudent';
            $is_new = 'لا';
            if ($subscribe->form_type == 'stopped-students'){
                $relation = 'stoppedStudent';
                $subscribe->stoppedStudent['first_name'] = '-';
                $subscribe->stoppedStudent['father_name'] = '-';
                $subscribe->stoppedStudent['grandfather_name'] = '-';
                $subscribe->stoppedStudent['family_name'] = '-';
                $subscribe->stoppedStudent['section'] = $subscribe->student->section;
                $subscribe->stoppedStudent['name'] = $subscribe->student->name;
                $subscribe->stoppedStudent['serial_number'] = $subscribe->student->serial_number;
                $is_new = 'نعم';
            }

            if ($subscribe->form_type == 'new-students'){
                $relation = 'newStudent';
                $subscribe->newStudent['name'] = $subscribe->{$relation}->first_name . ' ' . $subscribe->{$relation}->father_name . ' ' . $subscribe->{$relation}->grandfather_name . ' ' . $subscribe->{$relation}->family_name;
            }

            $guardian_id_image = '-';
            if($subscribe->{$relation}->guardian_id_image){
                $guardian_id_image = url(Storage::url($subscribe->{$relation}->guardian_id_image));
            }

            $student_id_image = '-';
            if($subscribe->{$relation}->student_id_image){
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            $googleSheet = new GoogleSheet();
            $values = [
                [
                    $created_at  ?? '-', $subscribe->reference_number  ?? '-', $created_at_formatted ?? '-',
                    'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', $is_new ?? '-',
                    $subscribe->{$relation}->section ?? '-', $subscribe->{$relation}->serial_number ?? '-',
                    $subscribe->{$relation}->name ?? '-', $subscribe->{$relation}->first_name ?? '-', $subscribe->{$relation}->father_name ?? '-',
                    $subscribe->{$relation}->grandfather_name ?? '-', $subscribe->{$relation}->family_name ?? '-',
                    $subscribe->{$relation}->favorite_time ?? '-', $subscribe->{$relation}->bod ?? '-',
                    $subscribe->payment_method ?? '-', $subscribe->payment_id ?? '-', $subscribe->payment_status ?? '-',
                    $subscribe->response_code ?? '-', $subscribe->coupon_code ?? '-', ($subscribe->discount_value/100) ?? '0.0',
                    $image_path ?? '-', $subscribe->account_owner ?? '-', $subscribe->transfer_date ?? '-', $subscribe->bank_reference_number ?? '-',
                    $subscribe->bank_name ?? '-', $subscribe->{$relation}->country->code ?? '-', $subscribe->{$relation}->residenceCountry->name ?? '-',
                    $subscribe->{$relation}->city ?? '-', $subscribe->{$relation}->address ?? '-', $subscribe->{$relation}->postal_code ?? '-',
                    $subscribe->{$relation}->place_birth ?? '-',
                    $subscribe->{$relation}->id_number ?? '-', $subscribe->{$relation}->father_whatsApp_number ?? '-',
                    $subscribe->{$relation}->mother_whatsApp_number ?? '-', $subscribe->{$relation}->father_email ?? '-',
                    $subscribe->{$relation}->mother_email ?? '-',
                    $subscribe->{$relation}->preferred_language ?? '-', $subscribe->{$relation}->guardian_name ?? '-',
                    $subscribe->{$relation}->guardian_work ?? '-', $subscribe->{$relation}->mother_name ?? '-',
                    $subscribe->{$relation}->mother_work ?? '-', $subscribe->{$relation}->social_situation ?? '-',
                    is_null($subscribe->{$relation}->current_disease) ? 'لا' : 'نعم', $subscribe->{$relation}->current_disease ?? '-',
                    is_null($subscribe->{$relation}->name_school) ? 'لا' : 'نعم', $subscribe->{$relation}->name_school ?? '-',
                    is_null($subscribe->{$relation}->studied_qaeedah) ? 'لا' : 'نعم',
                    $student_id_image ?? '-', $guardian_id_image ?? '-',
                    $subscribe->{$relation}->residenceCountry->code ?? '-', $price, $subscribe->id
                ],
            ];

            $googleSheet->saveDataToSheet($values);

            if ($subscribe->payment_method == 'checkout_gateway' && is_numeric($subscribe->response_code) && in_array($subscribe->payment_status, ['Captured', 'Authorized']) ){
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            }

            if ($subscribe->payment_method == 'hsbc'){
                Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
            }

        });

        static::updated(function($subscribe) {

            $relation = 'stoppedStudent';
            $is_new = 'لا';
            if ($subscribe->form_type == 'stopped-students'){
                $relation = 'stoppedStudent';
                $subscribe->stoppedStudent['first_name'] = '-';
                $subscribe->stoppedStudent['father_name'] = '-';
                $subscribe->stoppedStudent['grandfather_name'] = '-';
                $subscribe->stoppedStudent['family_name'] = '-';
                $subscribe->stoppedStudent['section'] = $subscribe->student->section;
                $subscribe->stoppedStudent['name'] = $subscribe->student->name;
                $subscribe->stoppedStudent['serial_number'] = $subscribe->student->serial_number;
                $is_new = 'نعم';
            }

            if ($subscribe->form_type == 'new-students'){
                $relation = 'newStudent';
                $subscribe->newStudent['name'] = $subscribe->{$relation}->first_name . ' ' . $subscribe->{$relation}->father_name . ' ' . $subscribe->{$relation}->grandfather_name . ' ' . $subscribe->{$relation}->family_name;
            }

            $guardian_id_image = '-';
            if($subscribe->{$relation}->guardian_id_image){
                $guardian_id_image = url(Storage::url($subscribe->{$relation}->guardian_id_image));
            }

            $student_id_image = '-';
            if($subscribe->{$relation}->student_id_image){
                $student_id_image = url(Storage::url($subscribe->{$relation}->student_id_image));
            }

            $course = Course::query()->where('code', '=', 'new-students')->first();
            $price = $course->price - ($subscribe->discount_value/100);

            if ($subscribe->payment_method == 'checkout_gateway'){
                $created_at = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');
                $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

                $image_path = '-';
                if($subscribe->money_transfer_image_path){
                    $image_path = url(Storage::url($subscribe->money_transfer_image_path));
                }

                $googleSheet = new GoogleSheet();
                $values = [
                    [
                        $created_at  ?? '-', $subscribe->reference_number  ?? '-', $created_at_formatted ?? '-',
                        'أقرّ باطلاعي نظام التعليم عن بعد الخاص بالمركز.', $is_new ?? '-',
                        $subscribe->{$relation}->section ?? '-', $subscribe->{$relation}->serial_number ?? '-',
                        $subscribe->{$relation}->name ?? '-', $subscribe->{$relation}->first_name ?? '-', $subscribe->{$relation}->father_name ?? '-', $subscribe->{$relation}->grandfather_name ?? '-',
                        $subscribe->{$relation}->family_name ?? '-', $subscribe->{$relation}->favorite_time ?? '-', $subscribe->{$relation}->bod ?? '-',
                        $subscribe->payment_method ?? '-', $subscribe->payment_id ?? '-', $subscribe->payment_status ?? '-',
                        $subscribe->response_code ?? '-', $subscribe->coupon_code ?? '-', ($subscribe->discount_value/100) ?? '0.0',
                        $image_path ?? '-', $subscribe->account_owner ?? '-', $subscribe->transfer_date ?? '-', $subscribe->bank_reference_number ?? '-',
                        $subscribe->bank_name ?? '-', $subscribe->{$relation}->country->code ?? '-', $subscribe->{$relation}->residenceCountry->name ?? '-',
                        $subscribe->{$relation}->city ?? '-', $subscribe->{$relation}->address ?? '-', $subscribe->{$relation}->postal_code ?? '-',
                        $subscribe->{$relation}->place_birth ?? '-',
                        $subscribe->{$relation}->id_number ?? '-', $subscribe->{$relation}->father_whatsApp_number ?? '-',
                        $subscribe->{$relation}->mother_whatsApp_number ?? '-', $subscribe->{$relation}->father_email ?? '-',
                        $subscribe->{$relation}->mother_email ?? '-',
                        $subscribe->{$relation}->preferred_language ?? '-', $subscribe->{$relation}->guardian_name ?? '-',
                        $subscribe->{$relation}->guardian_work ?? '-', $subscribe->{$relation}->mother_name ?? '-',
                        $subscribe->{$relation}->mother_work ?? '-', $subscribe->{$relation}->social_situation ?? '-',
                        is_null($subscribe->{$relation}->current_disease) ? 'لا' : 'نعم', $subscribe->{$relation}->current_disease ?? '-',
                        is_null($subscribe->{$relation}->name_school) ? 'لا' : 'نعم', $subscribe->{$relation}->name_school ?? '-',
                        is_null($subscribe->{$relation}->studied_qaeedah) ? 'لا' : 'نعم',
                        $student_id_image ?? '-', $guardian_id_image ?? '-',
                        $subscribe->{$relation}->residenceCountry->code ?? '-', $price, $subscribe->id
                    ],
                ];

                $googleSheet->saveDataToSheet($values);

                if (is_numeric($subscribe->response_code) && in_array($subscribe->payment_status, ['Captured', 'Authorized']) ){
                    Notification::route('mail', [$subscribe->email])->notify(new SubscribeNotification($subscribe));
                }
            }
        });

    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function residenceCountry()
    {
        return $this->belongsTo(Country::class, 'country_residence_id');
    }

    public function newStudent()
    {
        return $this->belongsTo(NewStudent::class, 'new_student_id');
    }

    public function stoppedStudent()
    {
        return $this->belongsTo(StoppedStudent::class, 'student_id', 'student_id');
    }

}
