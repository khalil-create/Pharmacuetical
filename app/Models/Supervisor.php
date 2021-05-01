<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true

    public function mainareas()
    {
        return $this->hasMany('App\Models\MainArea','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function company()
    {
        return $this->hasMany('App\Models\Company','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');//(related,foriegn key,primary key)
    }
}
