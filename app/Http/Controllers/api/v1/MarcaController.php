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
        if (empty($request->input('descripcion'))) {
            return response()->json([
                'errors'=> [
                        ['message'=>'Faltan datos necesarios para procesar el registro.']
                    ]
                ], 422);
        }
        $categoria = Categorias::create($request->all());
        
        return response()->json([ 'status' => 'ok', 'message' => 'Categoria stored successfully!', 'data'=>$categoria],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return response()->json(['error'=>'Unauthorised'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        //
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
