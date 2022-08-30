<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{

    public function index(){

        $context =[
            "sale"  => Sale::count(),
            "customer" => Customer::count(),
            "revenue" => Sale::all()->sum("sub_total")
        ];


        return view("systems.homepage", $context);
    }




    public function login()
    {
        return view('systems.admins.login');
    }
    public function postLogin(Request $request)
    {
         $this->validate($request, [
            'username'     => 'required',
            'password'  => 'required',
         ]);

         if(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status'=> 1])){
            Session::flash('success', 'you are logged In!');
            return redirect()->route("home.page");
         }else{
            return back()->with('status','msg');
         }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
