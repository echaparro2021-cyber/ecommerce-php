<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleApiController extends Controller
{
    /*public function __construct()*/

    public function store(Request $request){
        
        $sale = Sale::create([
            'email' => $request->input('email'),
            'sale_date' => $request->input('sale_date'),
        ]);

        return response()->json($sale, 201);
    }
}
