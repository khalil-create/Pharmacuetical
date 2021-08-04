<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionService extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'service_goal',
        'service_period',
        'source',
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
