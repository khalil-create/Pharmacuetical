<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor','doctors_specialists');
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item','specialists_items');
    }
}
