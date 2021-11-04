<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function getLogin(){
        return view('vendors.auth.login');
    }



    public function login(LoginRequest  $request){
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('vendors')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('vendors.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);

    }



    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('vendors.login');
    }
}
