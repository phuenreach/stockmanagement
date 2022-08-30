<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $context =[
            "sale"  => Sale::all('qty', 'created_at', 'sub_total'),
            "customer" => Customer::count(),

        ];

        dd($context);

        return view("systems.homepage", $context);
    }
}
