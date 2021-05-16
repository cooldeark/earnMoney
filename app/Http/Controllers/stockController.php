<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stockController extends Controller
{
    public function calculator(){
        return view('stock.calculator');
    }
}
