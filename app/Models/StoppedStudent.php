<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoppedStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'student_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_student');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function residenceCountry()
    {
        return $this->belongsTo(Country::class, 'country_residence_id');
    }

}
