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
        'supervisor_id',
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
    public function represntaitives()
    {
        return $this->belongsToMany('App\Models\Representative','representatives_tests');
    }
}
