<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentativeTest extends Model
{
    protected $table = 'representatives_tests';
    use HasFactory;
    protected $fillable = [
        'representative_id',
        'test_id',
        'result',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = true; //the default is true
    public function test()
    {
        return $this->belongsTo('App\Models\Test','test_id','id');
    }
    public function representative()
    {
        return $this->belongsTo('App\Models\Representative','representative_id','id');
    }
}
