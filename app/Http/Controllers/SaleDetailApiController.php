<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SaleDetail;

class SaleDetailApiController extends Controller
{
    /*public function __construct()*/

    public function store(Request $request){
        
        $sale_detail = SaleDetail::create([
            'sale_id' => $request->input('sale_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]);

        return response()->json($sale_detail, 201);
    }
}
