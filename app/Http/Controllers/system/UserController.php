<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


    public function index(){


        $context =[
            'user'=>User::all()
        ];

        return view('systems.admins.list',$context);
    }

    public function create(){
        return view('systems.admins.create');
    }


    public function store(Request $request){


        $image = Upload::saveFile('/users', $request->file('photo'), $request->tmp_file);

        $user = new User();

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->contact = $request->contact;
        $user->photo = $image;
        $user->type= "user";
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->back();
    }

    public function edit($id){
        $user = User::find($id);
        return view("systems.admins.edit",["user"=> $user] );
    }

    public function update(Request $request, $id){
        $image = Upload::saveFile('/users', $request->file('photo'), $request->tmp_file);

        $user = User::find($id);

        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->contact = $request->contact;
        $user->photo = $image;
        $user->type= "user";
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('user.list');
    }

    public function status($id, $status)
    {
        $st = $status==0?1:0;
        $use =User::find($id);
        $use->update(['status' => $st]);
        return back();
    }

}
