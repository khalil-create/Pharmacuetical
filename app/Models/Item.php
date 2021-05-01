<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'commercial_name',
        'science_name',
        'price',
        'bonus',
        'unit',
        'category_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');//(related,foriegn key,primary key)
    }
}
