<?php

namespace App\Http\Controllers\fronts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    public function index(){




        $context =[
            'category' => Category::all(),
            'products' => Product::with(["pro_galleries" => function($qeury){
                $qeury->where('feature',0);
            }])->get()
        ];

        return view("frontsite.product_order.index", $context);
    }


    public function filterCategory(Request $request){


        $products =Product::where(function($q) use($request){
            if ($request->cate !=0){
                $q->where("category_id",$request->cate);
            }
        })
        ->with(["pro_galleries" => function($qeury){
            $qeury->where('feature',0);
        }])
        ->get();
        return response()->json($products,200);

    }

    public function price_by_id(Request $request){
        $products = Product::whereIn('id',$request->id)->get();

        return response()->json(["data"=>$products]);
    }
}
