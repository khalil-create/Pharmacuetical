<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCustomer extends Model
{
    use HasFactory;
    protected $table = 'services_customers'; 
    protected $fillable = [
        'service_id',
        'customer_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
}
