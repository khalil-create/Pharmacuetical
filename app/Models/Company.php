<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_company',
        'country_manufacturing',
        'sign_img_company',
        'have_category',
        'supervisor_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','categories_companies');
    }
}
