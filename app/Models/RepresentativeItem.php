<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeItem extends Model
{
    use HasFactory;
    protected $table = 'representatives_items';
    protected $fillable = [
        'representative_id',
        'item_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
