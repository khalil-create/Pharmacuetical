<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialist extends Model
{
    use HasFactory;
    protected $table = 'doctors_specialists';
    protected $fillable = [
        'doctor_id',
        'specialist_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
