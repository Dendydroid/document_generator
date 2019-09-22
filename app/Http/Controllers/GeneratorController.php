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
    public function getZvedenaVidomist(Request $request)
    {
        return view('generate.zvedena_vidomist');
    }
    public function getVpiskaOzinok(Request $request)
    {
        return view('generate.vpiska_ozinok');
    }
    public function getVidomistKr(Request $request)
    {
        return view('generate.vidomist_kr');
    }
    public function getVidomistMod1(Request $request)
    {
        return view('generate.vidomist_mod_1');
    }
    public function getVidomistMod2(Request $request)
    {

        return view('generate.vidomist_mod_2');
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
