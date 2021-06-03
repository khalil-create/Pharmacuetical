<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesobjective extends Model
{
    use HasFactory;
    protected $fillable = [
        'objective',
        'description',
        'supervisor_id',
        'manager_id',
        'representative_id',
        'item_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function manager()
    {
        return $this->belongsTo('App\Models\Manager','manager_id','id');//(related,foriegn key,primary key)
    }
    public function representative()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');//(related,foriegn key,primary key)
    }
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor','supervisor_id','id');//(related,foriegn key,primary key)
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');//(related,foriegn key,primary key)
    }
}
