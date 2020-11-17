<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Cache::remember('cachemarcas',15/60, function() {
			return Marca::simplePaginate(20);  // Paginamos cada 20 elementos.
        });
        
		return response()->json([
            'message' => 'Marcas list',
            'status'=>'ok',
            'totalRecords' => sizeOf($marcas->items()),
            'siguiente'=>$marcas->nextPageUrl(),
            'anterior'=>$marcas->previousPageUrl(),
            'data'=>$marcas->items(),
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
        $request->validate(Marca::createRules());

        $marca = Marca::create($request->all());
        
        return response()->json([ 'status' => 'ok', 'message' => 'Marca creada exitosamente!', 'data'=>$marca],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = Marca::find($id);
        
        if ( empty($marca) ) {
            return response()->json(['message' => 'Detalle de la Marca',
            'status'=>'not found'],404);
        } 

        return response()->json(['message' => 'Detalle de la Marca',
        'status'=>'ok','data' => $marca],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);
        // dd($id);

        if (empty($marca)) {
            return response()->json([
                    'message' => 'Actualizacion de Marca',
                    'status' => 'Not found',
            ], 404);
        }

        $request->validate(Marca::updateRules($id));

        $marca->fill($request->all());
        $marca->save();

        return response()->json([
            'message' => 'Actualizacion de Marca',
            'status'=>'ok',
            'data' => $marca
        ],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $marca = Marca::find($id);
        
        if ( empty($marca) ) {
            return response()->json([
                'message' => 'Detalle de la Marca',
                'status'=>'not found'
            ],404);
        } 
        
        $marca->delete();
        
		// Se devuelve código 204 No Content.
		return response()->json([], 204);
    }
}
