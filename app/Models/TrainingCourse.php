<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'important_points',
        'supervisor_id',
        'item_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];
    public $timestamps = true; //the default is true
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');//(related,foriegn key,primary key)
    }
    public function represntaitives()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_training_courses');
    }
}
