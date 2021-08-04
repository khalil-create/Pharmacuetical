<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'representative_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function representative()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');
    }
    public function alternative()
    {
        return $this->hasOne('App\Models\Alternative','competitor_id','id');//(related,foriegn key,primary key)
    }
    public function competitionService()
    {
        return $this->hasOne('App\Models\CompetitionService','competitor_id','id');//(related,foriegn key,primary key)
    }
    public function promotionMaterial()
    {
        return $this->hasOne('App\Models\PromotionMaterial','competitor_id','id');//(related,foriegn key,primary key)
    }
}
