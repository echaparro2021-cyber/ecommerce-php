<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->only(['getById']);
        //$this->middleware(['client.credentials'])->only(['index']);
    }
    
    //Seleccionar todos los datos de la tabla order
    
    public function index() {
        $orders = Order::with([])->get();
        return response()->json($orders, 200);
    }
    
    //Seleccionar una orden de la tabla order por su Id
    
    public function getById($id) {
        $order = Order::with([])
                            ->where('id', $id)    
                            ->first();

        if (empty($order)) {
            return response()->json(['message' => 'Orden no encontrada'], 404);
        }      

        return response()->json($order, 200);
    }
    
    //Guardar una orden
    
    public function store(Request $request){
        
        $order = Order::create([
            'email' => $request->input('email'),]);

        $query = DB::table('orders')
        ->where('email', $request->input('email'))
        ->value('id');

        $order_d = OrderDetail::create([
            'order_id' => $query,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            

        ]);
        
        return response()->json($order_d, 201) . $query;
    }

    public function run(Request $request) {

        $order = Order::create(['email' => $request->input('email')]);
        
        if($request->isMethod('post')){
            echo 'Hemos recibido: ' . $request->method();
            $recibido = $request->all();
        }
        
        //$quantityR = $request->input('quantity');
            
        //$query = DB::table('orders')->where('email', $request->input('email'))->value('id');
        
             
        /* DB::table('order_details')->insert([
            'order_id' => $query,
            'product_id' => $request->input('products'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]); */
        return response()->json($recibido, 201);
    } 

    public function guardar_orden(SaveOrderRequest $request){

        Order::create($request->all());
        return response()->json([
            'resp' => 'true',
            'msg' => 'Orden creada correctamente'
        ]);
    }
    
}