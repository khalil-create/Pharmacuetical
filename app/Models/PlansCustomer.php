<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlansCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'visit_date',
        'period',
        'note',
        'plan_id',
        'customer_id',
        'doctor_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor','doctor_id','id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan','plan_id','id');
    }
}
