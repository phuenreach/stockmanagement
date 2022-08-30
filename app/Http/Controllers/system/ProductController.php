<?php

namespace App\Http\Controllers\system;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductGallary;
use App\Models\Sale;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){


        $context=[
            'products' => Product::with(["pro_galleries" => function($qeury){
                $qeury->where('feature',0);
            }])
            ->with("categories")
            ->when($request->search, function($q) use($request){
                $q->where("name","like","%".$request->search."%");
            })
            ->when($request->cat, function($q) use($request){
                $q->where("category_id",$request->cat);
            })
            ->paginate(10),

            'categories' => Category::all()
        ];
        return view("systems.product.index", $context);
    }

    public function create(){
        $context =[
            'categories' => Category::all(),
        ];
        return view("systems.product.create" , $context);
    }


    public function store(Request $request){
        $request->validate([
            'name'=> 'required|max:100',
            'qty' => 'required|integer',
            'price' => 'required|numeric|between:0,99.99',
            'category_id' => 'required|numeric|min:0|not_in:0'
        ]);

        $images=array();
        $product = Product::create([
            'name'=>$request->name,
            'code' => $request->code,
            'quality' => $request->qty,
            'unit_price' => $request->price,
            'category_id' => $request->category_id
        ]);

        if ($request->images){

            foreach ($request->images as $file) {
                $filename = md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $destination = public_path('uploads/product');
                $file->move($destination,$filename);

                $images[] = $filename;
            }
            foreach ($images as $key => $image) {
                $pg = new ProductGallary();
                $pg->img_name = $image;
                $pg->product_id = $product->id;
                $pg->feature = $key;

                $pg->save();
                print($key);
        }

        }else{
            ProductGallary::create([
                'img_name' => '',
                'product_id' => $product->id,
                'feature' => 0
            ]);
        }

        return redirect()->route("product.create");
    }



    public function edit(Request $request){

        $context =[
            'product'=>Product::with("pro_galleries")
                                ->where("id", $request->id)->get(),
            'categories' => Category::all(),
        ];
        return view("systems.product.edit", $context);
    }
    public function update(){

    }


    public function search(Request $request){

        $context=[
            'products' => Product::where('name' , 'LIKE', '%'.$request->search.'%')
                                    ->orWhere('quality' , 'LIKE', '%'.$request->search.'%')
                                    ->get(),
            'categories' => Category::all()
        ];

        // dd($context);
        return view("systems.product.index", $context);
    }




    // there are function above for handle of sale product
 }
