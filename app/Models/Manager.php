<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');//(related,foriegn key,primary key)
    }
    public function supervisors()
    {
        return $this->hasMany('App\Models\Supervisor','manager_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->hasMany('App\Models\Representative','manager_id','id');//(related,foriegn key,primary key)
    }
    public function samples()
    {
        return $this->hasMany('App\Models\Sample','manager_id','id');//(related,foriegn key,primary key)
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task','manager_id','id');//(related,foriegn key,primary key)
    }
    public function salesobjectives()
    {
        return $this->hasMany('App\Models\Salesobjective','manager_id','id');//(related,foriegn key,primary key)
    }
}
