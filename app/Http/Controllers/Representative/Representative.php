<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Representative extends Controller
{
    
    public function index()
    {
        return view('Representative.side');
    }
}
