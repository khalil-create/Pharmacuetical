<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferService extends Model
{
    use HasFactory;
    protected $fillable = [
        'visit_id',
        'service_id',
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
        return $this->belongsTo('App\Models\Visit','visit_id','id');
    }
    public function services()
    {
        return $this->belongsTo('App\Models\Service','service_id','id');//(related,foriegn key,primary key)
    }
}
