<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewStudent extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'new_student_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_student');
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
