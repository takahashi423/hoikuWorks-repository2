<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoikusController extends Controller
{
    //メイン
    public function main()
    {
        return view('works.main');
    }

}
