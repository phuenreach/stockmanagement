<?php

namespace App\Http\Controllers\system;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOption\None;

class SaleController extends Controller
{
    public function index(Request $request){

        $context =[
            'product' => Product::all(),
            'customer' => Customer::all(),
        ];
        return view("systems.sale.index", $context);
    }


    public function store(Request $request){


        DB::beginTransaction();
        $cus_id =0;
        if (gettype($request->cus) != "string"){
            $cus_data = $request->cus[0];

            $cus = Customer::create([
                'name' => $cus_data['name'],
                'address' => $cus_data['addr'],
                'contact' => $cus_data['contact']
            ]);
            $cus_id =  $cus->id;
        }else{
            $cus_id = (int)$request->cus;
        }

        // insert data to invoice table
        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $cus_id,
            'pay_type' => "riel",
            'total_amount' => $request->amount

        ]);

        foreach($request->pro_data as $item){
            $this->stock_trigger($item['pro_id'], $item['qty']);
            Sale::create([
                'product_id' => $item['pro_id'],
                'invoice_id' => $invoice->id,
                'qty' => $item['qty'],
                'price' => $item['price'],
                'sub_total' => $item['total']
            ]);
        }





        DB::commit();
        return response()->json(['message' => "suc"]);

    }


    private function stock_trigger($pro_id, $qty){

        Product::where('id', $pro_id)
        ->update(['quality' => DB::raw('quality -'.$qty)]);
    }


    public function view(Request $request){
        $contax=[
            'category' => Category::all(),
            'sold' => Sale::with(['invoice' => function($q) {
                $q->with(['customer' =>function($q1) {
                    $q1->get('name');
                }]);
                $q->with(['user' => function($q2){
                    $q2->get("fullname");
                }]);
            }])->with(['product' => function($query) {
                $query->with(["pro_galleries" => function($query1){
                    $query1->where("feature", 0);
                }]);
                $query->with("categories");
            }])
            ->when($request->search, function($q) use($request){
                $q->whereHas('product', function($qsearch) use($request){
                    $qsearch->where("name","like","%".$request->search."%");
                });
            })
            ->when($request->cat, function($q) use($request){
                $q->whereHas('product', function($qsearch) use($request){
                    $qsearch->where('category_id', $request->cat);
                });
            })


            ->orderBy('id','DESC')
            ->paginate(10)
        ];

        // dd($contax);

        return view("systems.sale.view", $contax);
    }

}

