<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoProducto;
use Illuminate\Support\Facades\Cache;

class TipoProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProductos = Cache::remember('cachetipoProductos',15/60, function() {
			return TipoProducto::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'TipoProductos list',
            'status'=>'ok',
            'totalRecords' => sizeOf($tipoProductos->items()),
            'siguiente'=>$tipoProductos->nextPageUrl(),
            'anterior'=>$tipoProductos->previousPageUrl(),
            'data'=>$tipoProductos->items(),
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
        $request->validate(TipoProducto::createRules());

        $tipoProducto = TipoProducto::create($request->all());
        
        return response()->json([ 'status' => 'ok', 'message' => 'TipoProducto creada exitosamente!', 'data'=>$tipoProducto],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoProducto = TipoProducto::find($id);
        
        if ( empty($tipoProducto) ) {
            return response()->json(['message' => 'Detalle de la TipoProducto',
            'status'=>'not found'],404);
        } 

        return response()->json(['message' => 'Detalle de la TipoProducto',
        'status'=>'ok','data' => $tipoProducto],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoProducto = TipoProducto::find($id);
        // dd($id);

        if (empty($tipoProducto)) {
            return response()->json([
                    'message' => 'Actualizacion de TipoProducto',
                    'status' => 'Not found',
            ], 404);
        }

        $request->validate(TipoProducto::updateRules($id));

        $tipoProducto->fill($request->all());
        $tipoProducto->save();

        return response()->json([
            'message' => 'Actualizacion de TipoProducto',
            'status'=>'ok',
            'data' => $tipoProducto
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tipoProducto = TipoProducto::find($id);
        
        if ( empty($tipoProducto) ) {
            return response()->json([
                'message' => 'Detalle de la TipoProducto',
                'status'=>'not found'
            ],404);
        } 
        
        $tipoProducto->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([], 204);
    }
}
