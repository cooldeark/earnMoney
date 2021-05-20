<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\stockController;

class testImplementController extends Controller
{
    public function getFuck(){
        $hi=new stockController();
        $hi->test();
    }
}
