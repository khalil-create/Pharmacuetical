<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $fillable = [
        'user_id',
        'manager_id',
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
    public function representatives()
    {
        return $this->hasMany('App\Models\Representative','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function company()
    {
        return $this->hasMany('App\Models\Company','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function studies()
    {
        return $this->hasMany('App\Models\Study','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');//(related,foriegn key,primary key)
    }
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager','manager_id','id');//(related,foriegn key,primary key)
    }
    public function samples()
    {
        return $this->hasMany('App\Models\Sample','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task','supervisor_id','id');//(related,foriegn key,primary key)
    }
}
