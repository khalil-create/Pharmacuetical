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
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','services_customers');//(related,foriegn key,primary key)
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order','customer_id','id');//(related,foriegn key,primary key)
    }

}
