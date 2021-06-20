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
    public function uses()
    {
        return $this->belongsToMany('App\Models\Uses','uses_items');
    }
    public function specialists()
    {
        return $this->belongsToMany('App\Models\Spesialist','specialists_items');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order','item_id','id');
    }
    public function samples()
    {
        return $this->hasMany('App\Models\Sample','item_id','id');
    }
    public function companies()
    {
        return $this->belongsToMany('App\Models\Company','companies_items');
    }
    public function trainingCourses()
    {
        return $this->hasMany('App\Models\TrainingCourse','item_id','id');
    }
}
