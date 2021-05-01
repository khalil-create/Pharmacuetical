<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_cat',
        'company_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id','id');//(related,foriegn key,primary key)
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item','category_id','id');//(related,foriegn key,primary key)
    }
}
