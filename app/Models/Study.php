<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'source',
        'emission_date',
        'supervisor_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function strengths()
    {
        return $this->hasMany('App\Models\Strengthspromotion','study_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_studies');
    }
}
