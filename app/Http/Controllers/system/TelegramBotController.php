<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class TelegramBotController extends Controller
{

    public function index(Request $request){

        dd("hello");


    }



    public function customer(Request $request){
        $data = $request;


        Customer::create([
            'name' => $data['name'],
            "contact" => $data['phone'],
            "chatid" => $data['chatid']
        ]);

        return response()->json(["success"=>true], 200);
    }

    public function wherecustomer(Request $request){

        if (Customer::where("chatid", $request->id)->exists()){
            return response()->json(["status"=> true], 200);
        }

    }

}
