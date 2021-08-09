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
    public function subareas()
    {
        return $this->hasManyThrough('App\Models\Subarea','App\Models\MainArea','supervisor_id','mainarea_id');//(related,foriegn key,primary key)
    }
    public function doctors()
    {
        return $this->hasManyThrough('App\Models\Doctor','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
    }
    // public function customers()
    // {
    //     return $this->hasManyThrough('App\Models\Customer','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
    // }
    public function orders()
    {
        return $this->hasManyThrough('App\Models\Order','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
    }
    public function services()
    {
        return $this->hasManyThrough('App\Models\Service','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
    }
    public function visits()
    {
        return $this->hasManyThrough('App\Models\Visit','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
    }
    public function plans()
    {
        return $this->hasManyThrough('App\Models\Plan','App\Models\Representative','supervisor_id','representative_id');//(related,foriegn key,primary key)
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
    public function tests()
    {
        return $this->hasMany('App\Models\Test','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function trainingCourses()
    {
        return $this->hasMany('App\Models\TrainingCourse','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function salesObjectives()
    {
        return $this->hasMany('App\Models\SalesObjective','supervisor_id','id');//(related,foriegn key,primary key)
    }
    // public function categories()
    // {
    //     return $this->hasManyThrough('App\Models\Category','App\Models\Compny','App\Models\Company','categories_companies');//(related,foriegn key,primary key)
    // }
}
