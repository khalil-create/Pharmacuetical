<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uses extends Model
{
    use HasFactory;
    protected $fillable = [
        'use',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function items()
    {
        return $this->belongsToMany('App\Models\Item','uses_items');
    }
}
