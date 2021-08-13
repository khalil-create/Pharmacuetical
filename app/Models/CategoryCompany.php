<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCompany extends Model
{
    use HasFactory;
    protected $table = 'categories_companies';
    protected $fillable = [
        'company_id',
        'category_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
