<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeSubarea extends Model
{
    use HasFactory;
    protected $table = 'representatives_subareas';
    protected $fillable = [
        'representative_id',
        'subarea_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
