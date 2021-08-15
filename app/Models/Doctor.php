<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile_phone',
        'clinic_phone',
        'workplace_am',
        'workplace_pm',
        // 'size',
        'loyalty',
        'rank',
        'address',
        'statues',
        'representative_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function representative()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');//(related,foriegn key,primary key)
    }
    public function specialists()
    {
        return $this->belongsToMany('App\Models\Specialist','doctors_specialists');
    }
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','services_doctors');//(related,foriegn key,primary key)
    }
    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan','plans_customers');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\Visit','doctor_id','id');
    }
}
