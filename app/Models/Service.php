<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',//عيني او نقدي
        'name',//اذا كانت خدمة عينية تكتب اسمها
        'cost',
        'statues',
        'representative_id',
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
    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer','services_customers');
    }
    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor','services_doctors');
    }
}
