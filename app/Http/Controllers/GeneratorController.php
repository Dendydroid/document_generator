<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ticketpark\HtmlPhpExcel\HtmlPhpExcel;

class GeneratorController extends Controller
{
    public function getZajavaIspit(Request $request)
    {
        return view('generate.zajava_ispit');
    }

    public function generateXLSX(Request $request)
    {
        $data = $request->all();
        if(isset($data['html']) && !empty($data['html']))
        {
            $html2xlsx = new HtmlPhpExcel($data['html']);
            $html2xlsx->process()->output();
        }
    }
}
