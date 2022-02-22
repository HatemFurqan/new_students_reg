<?php

namespace App\Exports;

use App\Models\Subscribe;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NewStudentsExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return Subscribe::query()->where('form_type', '=', 'new-students')->with('newStudent')->get();
    }

    public function map($subscribe): array
    {
        $created_at_formatted = Carbon::parse($subscribe->created_at)->timezone('Asia/Riyadh')->format('Y-m-d');

        $fav_times_en = [
            'Morning Session | 09:00 am - 12:00 pm GMT+3',
            'Evening Session 1 | 03:00 pm - 06:00 pm GMT+3',
            'Evening Session 2 | 07:00 pm - 10:00 pm GMT+3',
            'Evening Session 3 | 11:00 pm - 02:00 am GMT+3',
            'Evening Session 4 | 03:00 am - 06:00 am GMT+3'
        ];

        $fav_times_ar = [
            'الفترة الصباحية (9:00 - 12:00 ظهرا بتوقيت مكة المكرمة GMT+3)',
            'الفترة المسائية 1 (3:00 - 6:00 مساء بتوقيت مكة المكرمة GMT+3)',
            'الفترة المسائية 2 (7:00 - 10:00 مساء بتوقيت مكة المكرمة GMT+3)',
            'الفترة المسائية 3 (11:00 - 2:00 ليلا بتوقيت مكة المكرمة GMT+3)',
            'الفترة المسائية 4 (3:00 - 6:00 ليلا بتوقيت مكة المكرمة GMT+3)'
        ];

        $favorite_time = array_search($subscribe->newStudent->favorite_time, $fav_times_ar);
        if (!$favorite_time){
            $favorite_time = array_search($subscribe->newStudent->favorite_time, $fav_times_en);
        }

        return [
            "" . $subscribe->id . "" ?? "",
            $created_at_formatted,
            $subscribe->newStudent->section ?? "",
            $subscribe->newStudent->student->serial_number ?? "",
            "",
            $favorite_time ? ("" . $favorite_time+1 . "") : "",
            $subscribe->newStudent->bod ?? "",
            $subscribe->newStudent->first_name ?? "",
            $subscribe->newStudent->father_name ?? "",
            $subscribe->newStudent->grandfather_name ?? "",
            $subscribe->newStudent->family_name ?? "",
            $subscribe->newStudent->country->code ?? "",
            $subscribe->newStudent->residenceCountry->code ?? "",
            $subscribe->newStudent->city ?? "",
            $subscribe->newStudent->address ?? "",
            $subscribe->newStudent->postal_code ?? "",
            $subscribe->newStudent->place_birth ?? "",
            $subscribe->newStudent->id_number ?? "",
            $subscribe->newStudent->father_whatsApp_number ?? "",
            $subscribe->newStudent->mother_whatsApp_number ?? "",
            $subscribe->newStudent->father_email ?? "",
            $subscribe->newStudent->mother_email ?? "",
            $subscribe->newStudent->preferred_language == 'Arabic' ? "1" : "2",
            $subscribe->newStudent->guardian_name ?? "",
            $subscribe->newStudent->guardian_work ?? "",
            $subscribe->newStudent->mother_name ?? "",
            $subscribe->newStudent->mother_work ?? "",
            $subscribe->newStudent->social_situation ?? "",
            "",
            is_null($subscribe->newStudent->current_disease) ? "لا" : "نعم",
            $subscribe->newStudent->current_disease ?? "",
            is_null($subscribe->newStudent->name_school) ? "لا" : "نعم",
            $subscribe->newStudent->name_school ?? "",
            is_null($subscribe->newStudent->studied_qaeedah) ? "لا" : "نعم",
        ];
    }

    public function headings(): array
    {
        return [
            'serial number',
            'Date',
            'الجنس',
            'رقم تسلسلي',
            'اسم الطالب',
            'الفترة',
            'تاريخ ميلاد الطالب',
            'الاسم الأول',
            'اسم الأب',
            'اسم الجد',
            'اللقب',
            'الجنسية',
            'دولة الاقامة',
            'المدينة',
            'العنوان - الشارع - المبنى',
            'الرمز البريدي',
            'مكان الميلاد',
            'رقم الهوية/جواز السفر',
            'رقم جوال والد الطالب (واتس اب)',
            'رقم جوال والدة الطالب (واتس اب)',
            'البريد الإلكتروني الخاص بوالد الطالب',
            'البريد الإلكتروني الخاص بوالدة الطالب',
            'اللغة المفضلة',
            'اسم ولي أمر الطالب',
            'جهة العمل',
            'اسم والدة الطالب',
            'جهة عمل الأم',
            'وضع الطالب الاجتماعي',
            'أذكرها (حالة الطالب)',
            'هل يعاني الطالب من مرض معين؟',
            'اشرح المرض الذي يعاني منه الطالب',
            'هل سبق للطالب الاشتراك في حلقة التحفيظ؟',
            'اسم المسجد/الممركز السابق',
            'هل سبق للطالب دراسة القاعدة النورانية؟',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
        ];
    }
}
