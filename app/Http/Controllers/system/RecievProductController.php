<?php

namespace App\Http\Controllers\system;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\RecievProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecievProductController extends Controller
{
    public function index(){

        $context=[
            'categories'=>Category::all(),
            're_products' => RecievProduct::with(["product" => function($q){
                $q->get('name');
            }])->with(['user' => function($q){
                $q->get('fullname');
            }])->paginate(10),
        ];

        return view("systems.recieve_product.index", $context);
    }

    public function search(Request $request){

        $context=[
            're_products' => RecievProduct::with(["product" => function($q) use($request){
                $q->where("name","LIKE",'%'.$request->search)->orWhere("name","LIKE",'%'.$request->search);
            }])->with(['user' => function($q) use($request){
                $q->get('fullname');
            }])->paginate(10),

        ];

        return response()->json(['data'=>$context]);
    }

    public function create(){

        $context=[
            'product' => Product::all(),
            'categories' => Category::all()
        ];

        return view("systems.recieve_product.create", $context);
    }
    public function store(Request $request){
        $request->validate([
            'pro_id' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric|between:0,999.999',
        ]);

        $sub_total = $request->qty * $request->price;

        $pro = Product::where('id', $request->pro_id)
        ->update(['quality'=> DB::raw('quality +'.$request->qty), 'unit_price'=>$request->price]);
        RecievProduct::create([
            "product_id" => $request->pro_id,
            "user_id" => Auth::user()->id,
            "price" => $request->price,
            "qty" => $request->qty,
            'sub_total' => $sub_total
        ]);


        return redirect()->back();

    }

    public function edit(){

    }
    public function update(){

    }
    public function delete(){

    }

    public function cat_filter(Request $request)
    {
        if ($request->cat_id !=0){
            $data = Product::where('category_id', $request->cat_id )->get();
        }
       else{
        $data = Product::all();
       }

        return response()->json(['data'=>$data]);
    }

    public function pro_filter(Request $request)
    {
        if ($request->pro_id !=0){
            $data = Product::where('id', $request->pro_id )->first(['unit_price'])->unit_price;
        }

        return response()->json(['data'=>$data]);
    }

}
