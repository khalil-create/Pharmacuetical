<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Representative extends Controller
{
    
    public function home()
    {
        return view('Representative.repSales.home');
    }
    public function notAllowed()
    {
        return view('unAuth.not');
    }
}
