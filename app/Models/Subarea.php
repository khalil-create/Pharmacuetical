<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subarea extends Model
{
    protected $fillable = [
        'name_sub_area',
        'mainarea_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    //public $timestamps = true; //the default is true

    public function mainarea()
    {
        return $this->belongsTo('App\Models\Mainarea','mainarea_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_subareas');
    }
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','_id','id');//(related,foriegn key,primary key)
    }
}
