<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'supervisor_id',
        'manager_id',
        'mainarea_id',
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
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager','manager_id','id');//(related,foriegn key,primary key)
    }
    public function mainarea()
    {
        return $this->belongsTo('App\Models\Mainarea','mainarea_id','id');//(related,foriegn key,primary key)
    }
    public function subareas()
    {
        return $this->belongsToMany('App\Models\Subarea','representatives_subareas');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task','representative_id','id');
    }
    public function plans()
    {
        return $this->hasMany('App\Models\Plan','representative_id','id');
    }
    public function customers()
    {
        return $this->hasMany('App\Models\Customer','representative_id','id');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order','representative_id','id');
    }
    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor','representative_id','id');
    }
    public function tests()
    {
        return $this->belongsToMany('App\Models\Test','representarives_tests');
    }
    public function visits()
    {
        return $this->hasMany('App\Models\Visit','representative_id','id');
    }
    public function trainingCourses()
    {
        return $this->belongsToMany('App\Models\TrainingCourse','representatives_training_courses');
    }
    public function studies()
    {
        return $this->belongsToMany('App\Models\Study','representatives_studies');
    }
    public function samples()
    {
        return $this->hasMany('App\Models\Sample','represntative_id','id');//(related,foriegn key,primary key)
    }
    public function salesObjectives()
    {
        return $this->hasMany('App\Models\Salesobjective','representative_id','id');//(related,foriegn key,primary key)
    }
}
