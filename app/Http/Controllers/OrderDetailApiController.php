<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailApiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->only(['getById']);
        //$this->middleware(['client.credentials'])->only(['index']);
    }
    //Seleccionar todos los datos de ordenes con detalles

    public function index() {
        $ordersD = OrderDetail::with([])->get();
        return response()->json($ordersD, 200);
    }
    
    //Seleccionar una orden por su Id
    
    public function getById($id) {
        $orderD = OrderDetail::with([])
                            ->where('id', $id)    
                            ->first();

        if (empty($orderD)) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }      

        return response()->json($orderD, 200);
    }
    
    //Crear una orden de compra sin detalle
    
    public function store(Request $request){
        
        $orderD = OrderDetail::create([
            'email' => $request->input('email'),
        ]);

        return response()->json($orderD, 201);
    }
}
