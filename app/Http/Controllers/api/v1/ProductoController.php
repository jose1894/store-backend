<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Cache;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Cache::remember('cacheproductos',15/60, function() {
			return Producto::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Productos list',
            'status'=>'ok',
            'totalRecords' => sizeOf($productos->items()),
            'siguiente'=>$productos->nextPageUrl(),
            'anterior'=>$productos->previousPageUrl(),
            'data'=>$productos->items(),
        ], 200);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Producto::createRules());

        $producto = Producto::create($request->all());
        
        return response()->json([ 'status' => 'ok', 'message' => 'Producto creado exitosamente!', 'data'=>$producto],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        
        if ( empty($producto) ) {
            return response()->json(['message' => 'Detalle del Producto',
            'status'=>'not found'],404);
        } 

        return response()->json(['message' => 'Detalle del Producto',
        'status'=>'ok','data' => $producto],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        // dd($id);

        if (empty($producto)) {
            return response()->json([
                    'message' => 'Actualizacion del Producto',
                    'status' => 'Not found',
            ], 404);
        }

        $request->validate(Producto::updateRules($id));

        $producto->fill($request->all());
        $producto->save();

        return response()->json([
            'message' => 'Actualizacion del Producto',
            'status'=>'ok',
            'data' => $producto
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto = Producto::find($id);
        
        if ( empty($producto) ) {
            return response()->json([
                'message' => 'Detalle del Producto',
                'status'=>'not found'
            ],404);
        } 
        
        $producto->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([], 204);
    }
}
