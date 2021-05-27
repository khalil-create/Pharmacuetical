<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'type',
        'user_id',
        'supervisor_id',
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
    public function mainarea()
    {
        return $this->belongsTo('App\Models\Mainarea','representative_id','id');//(related,foriegn key,primary key)
    }
    public function subareas()
    {
        return $this->belongsToMany('App\Models\Subarea','representatives_subareas');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task','representative_id','id');
    }
}
