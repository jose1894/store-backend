<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\Cache;

class UnidadMedidaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadMedidas = Cache::remember('cachemarcas',15/60, function() {
			return UnidadMedida::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'UnidadMedidas list',
            'status'=>'ok',
            'totalRecords' => sizeOf($unidadMedidas->items()),
            'siguiente'=>$unidadMedidas->nextPageUrl(),
            'anterior'=>$unidadMedidas->previousPageUrl(),
            'data'=>$unidadMedidas->items(),
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
        $request->validate(UnidadMedida::createRules());

        $unidadMedida = UnidadMedida::create($request->all());
        
        return response()->json([ 'status' => 'ok', 'message' => 'UnidadMedida creada exitosamente!', 'data'=>$unidadMedida],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadMedida = UnidadMedida::find($id);
        
        if ( empty($unidadMedida) ) {
            return response()->json(['message' => 'Detalle de la UnidadMedida',
            'status'=>'not found'],404);
        } 

        return response()->json(['message' => 'Detalle de la UnidadMedida',
        'status'=>'ok','data' => $unidadMedida],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unidadMedida = UnidadMedida::find($id);
        // dd($id);

        if (empty($unidadMedida)) {
            return response()->json([
                    'message' => 'Actualizacion de UnidadMedida',
                    'status' => 'Not found',
            ], 404);
        }

        $request->validate(UnidadMedida::updateRules($id));

        $unidadMedida->fill($request->all());
        $unidadMedida->save();

        return response()->json([
            'message' => 'Actualizacion de UnidadMedida',
            'status'=>'ok',
            'data' => $unidadMedida
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $unidadMedida = UnidadMedida::find($id);
        
        if ( empty($unidadMedida) ) {
            return response()->json([
                'message' => 'Detalle de la UnidadMedida',
                'status'=>'not found'
            ],404);
        } 
        
        $unidadMedida->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([], 204);
    }
}
