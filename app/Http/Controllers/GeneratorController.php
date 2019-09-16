<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    public function getZajavaIspit(Request $request)
    {
        return view('generate.zajava_ispit');
    }
}
