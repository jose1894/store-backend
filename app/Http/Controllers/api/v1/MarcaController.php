<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
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
    public function store(MarcaRequest $request)
    {
        if (empty($request->input('descripcion'))) {
            return response()->json([
                'errors'=> [
                        ['message'=>'Faltan datos necesarios para procesar el registro.']
                    ]
                ], 422);
        }
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
            return response()->json(['message' => 'Detalle de la Categoria',
            'status'=>'not found'],404);
        } 

        return response()->json(['message' => 'Detalle de la Categoria',
        'status'=>'ok','data' => $marca],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request)
    {
        $marca = Marca::find($request->id);
        // dd($request);
        if (empty($marca)) {
            return response()->json([
                    'message' => 'Actualizacion de marca',
                    'status' => 'Not found',
            ], 404);
        }

        $flag = $marca->validate($request->rules());

        if ( !empty($flag) ) {
            return $flag;
        }

        $marca->flll($request->all());
        $marca->save();

        return response()->json(['message' => 'Actualizacion de Categoria',
        'status'=>'ok','data' => $marca],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        //
    }
}
