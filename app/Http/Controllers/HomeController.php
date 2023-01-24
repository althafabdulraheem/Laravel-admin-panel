<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tabs=['tab1'=>"active",'tab2'=>"",'tab3'=>"",'tab4'=>''];
        return view('admin.index')->with($tabs);
    }
}
