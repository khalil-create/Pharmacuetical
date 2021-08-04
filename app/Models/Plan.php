<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_month',
        'plan_date',
        'plan_status',
        'plan_progress',
        'representative_id',
        'type_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function represntaitives()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');
    }
    public function planType()
    {
        return $this->belongsTo('App\Models\PlanType','type_id');
    }
    public function customers_all()
    {
        return $this->hasMany('App\Models\PlansCustomer','plan_id','id');
    }
    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer','plans_customers','customer_id','plan_id');
    }
    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor','plans_customers','doctor_id','plan_id');
    }
}
