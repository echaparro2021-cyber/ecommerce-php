<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class SellerApiController extends Controller
{
    /*public function __construct()*/

    public function store(Request $request){
        
        $seller = Seller::create([
            'name' => $request->input('name'),
        ]);

        return response()->json($seller, 201);
    }
}
