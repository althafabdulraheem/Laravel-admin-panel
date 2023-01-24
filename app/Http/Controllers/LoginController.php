<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
    
        if(Auth::attempt(['password'=>$request->password,'email'=>$request->email]))
        {
            if(Auth::user()->role=="0" && Auth::user()->is_enabled=="yes")
            {
                $tabs=['tab1'=>"active",'tab2'=>"",'tab3'=>"",'tab4'=>''];
                return view('admin.index')->with($tabs);
            }
            elseif(Auth::user()->role=="1")
            {
                $tabs=['tab1'=>"active",'tab2'=>"",'tab3'=>"",'tab4'=>''];
                return view('admin.index')->with($tabs);
            }
            else
            {
                Auth::logout();
                return redirect('/')->with('msg','Your Account Disabled');
            }
        }
        else
        {
            return redirect('/')->with('msg','Invalid UserCredialtials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
