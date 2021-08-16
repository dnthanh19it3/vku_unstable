<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdTamTru extends Controller
{
    function index(){
        $hocky = DB::table("table_hocky")->get();
        return view('Admin.TamTru.TamTruIndex')->with([
            'hocky' => $hocky
        ]);
    }
    function moKhaiBao(Request $request, $hocky){
        $hocky = DB::table("table_hocky")->where('table_hocky.id', '=', $hocky)->update(['tamtru' => 1]);
        return Redirect::back();
    }
    function dongKhaiBao(Request $request, $hocky){
        $hocky = DB::table("table_hocky")->where('table_hocky.id', '=', $hocky)->update(['tamtru' => 0]);
        return Redirect::back();
    }
}
