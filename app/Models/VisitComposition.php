<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitComposition extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'item',
        'scientific_mission',
        'visit_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function visit()
    {
        return $this->belongsTo('App\Models\Visit','visit_id');
    }
    public function samples()
    {
        return $this->hasMany('App\Models\Sample','sample_id','id');//(related,foriegn key,primary key)
    }

}
