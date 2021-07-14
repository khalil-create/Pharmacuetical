<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'period',
        'type',
        'date',
        'result',
        'representative_id',
        'doctor_id',
        'customer_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function representative()
    {
        return $this->belongsTo('App\Models\Representative','representative_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor','doctor_id','id');//(related,foriegn key,primary key)
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');//(related,foriegn key,primary key)
    }
    public function composition()
    {
        return $this->hasOne('App\Models\VisitComposition','visit_id','id');//(related,foriegn key,primary key)
    }
    public function serviceOffer()
    {
        return $this->hasOne('App\Models\OfferService','visit_id','id');//(related,foriegn key,primary key)
    }
    public function solveProblem()
    {
        return $this->hasOne('App\Models\ProblemsSolve','visit_id','id');//(related,foriegn key,primary key)
    }
}
