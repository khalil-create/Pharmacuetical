<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mainarea extends Model
{
    protected $fillable = [
            'name_main_area',
            'supervisor_id',
            'representative_id',
            'created_at',
            'updated_at',
        ];
        protected $hidden = [
            'created_at',
            'updated_at',
        ];
        public $timestamps = true; //the default is true

    public function subareas()
    {
        return $this->hasMany('App\Models\Subarea','mainarea_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->hasMany('App\Models\Representative','representative_id','id');//(related,foriegn key,primary key)
    }
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    
}
