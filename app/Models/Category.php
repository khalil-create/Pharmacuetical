<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_cat',
        // 'company_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function companies()
    {
        return $this->belongsToMany('App\Models\Company','categories_companies');
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item','category_id','id');//(related,foriegn key,primary key)
    }
}
