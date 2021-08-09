<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDoctor extends Model
{
    use HasFactory;
    protected $table = 'services_doctors'; 
    protected $fillable = [
        'service_id',
        'doctor_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; 
}
