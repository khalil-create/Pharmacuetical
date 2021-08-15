<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'owner_name',
        'owner_phone',
        'owner_tel',
        'size',
        'loyalty',
        'address',
        'statues',
        'contact_official_name',
        'contact_official_type',
        'contact_official_phone',
        'contact_official_tel',
        // 'representative_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function representative()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_customers');
    }
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','services_customers');//(related,foriegn key,primary key)
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order','customer_id','id');//(related,foriegn key,primary key)
    }
    public function plans()
    {
        return $this->belongsToMany('App\Models\Plan','plans_customers');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\Visit','customer_id','id');
    }
}
