<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strengthspromotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'strength',
        'study_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function study()
    {
        return $this->belongsTo('App\Models\Study','study_id','id');//(related,foriegn key,primary key)
    }
}
