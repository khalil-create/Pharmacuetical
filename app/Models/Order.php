<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'count',
        'bonus',
        'note',
        'representative_id',
        'customer_id',
        'item_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function represntaitive()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }
}
