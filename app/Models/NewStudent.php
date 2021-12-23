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
}
