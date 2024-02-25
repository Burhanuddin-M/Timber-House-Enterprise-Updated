<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    public function index(){
        return view('Misc.index');
    }

    public function turnover_index(){
        return view('Misc.Turnover.index');
    }
}
