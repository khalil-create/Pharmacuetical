<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'test_name',
        'type',
        'type_id',
        'supervisor_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_tests');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question','test_id','id');
    }
    public function type()
    {
        return $this->hasMany('App\Models\Test','type_id','id');
    }
    public function testResults()
    {
        return $this->hasMany('App\Models\RepresentativeTest','test_id','id');
    }
}
