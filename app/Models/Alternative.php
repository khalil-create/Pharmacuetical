<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;
    protected $fillable = [
        'commercial_name',
        'agency_name',
        'company_name',
        'country_manufacturing',
        'unit',
        'refill',
        'price',
        'bonus',
        'promotion_materials',
        'date',
        'competitor_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function competitor()
    {
        return $this->belongsTo('App\Models\Competitor','competitor_id','id');
    }
}
