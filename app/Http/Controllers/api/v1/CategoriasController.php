<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


		// Caché se actualizará con nuevos datos cada 15 segundos.
		// cachecategorias es la clave con la que se almacenarán 
		// los registros obtenidos de Categorias::all()
		// El segundo parámetro son los minutos.
		$categorias = Cache::remember('cachecategorias',15/60, function() {
			return Categorias::simplePaginate(5);  // Paginamos cada 10 elementos.
        });
        
		return response()->json([
            'status'=>'ok',
            'siguiente'=>$categorias->nextPageUrl(),
            'anterior'=>$categorias->previousPageUrl(),
            'data'=>$categorias->items()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->input('descripcion'))) {
            return response()->json(
                ['errors'=> [
                    ['code'=>422,'message'=>'Faltan datos necesarios para procesar el registro.']]
                ], 422);
        }
        $categoria = Categorias::create($request->all());        
        return response()->json([ 'status' => 'ok', 'data'=>$categoria],201);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categorias::find($id);

        if ( !$categoria)
		{
			return response()->json(
                [
                    'errors'=> [
                                ['code'=>404,'message'=>'No se encuentra un fabricante con ese código.']
                    ]
                ], 404);
        }
        
		return response()->json([ 'status' => 'ok', 'data' => $categoria], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$categoria = Categorias::find($id);

		if (!$categoria) {			
			return response()->json(
                [ 
                    'errors' => [
                                    [ 'code' => 404, 'message' => 'No se encuentra una categoria con ese código.']
                                ]
                ], 404);
		}
		// Comprobamos si recibimos petición PATCH(parcial) o PUT (Total)
		if ($request->method() == 'PATCH' || $request->method() == 'PUT') {
			
			if (!empty($request->input('descripcion'))) {
                
                return response()->json(
                    ['errors' => [
                        [ 'code' => 304, 'message' => 'No se ha modificado ningún dato.']
                    ]
                ], 304);
			}
            $categoria->descripcion = $request->input('descripcion');
            $categoria->save();                
			return response()->json(['status'=>'ok','data'=>$categoria],200);
			
        }
        
        return response()->json(
            [ 
                'errors' => 
                [
                    [ 'code' => 404, 'message' => 'Metodo de actualizacion incorrecto.']
                ]
            ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$categoria = Categorias::find($id);

		if (empty($categoria)) {
			return response()->json(
                [ 'errors' => [
                                [ 'code' => 404, 'message' => 'No se encuentra una categoria con ese código.']
                              ]
                ], 404);
		}
		$productos = $categoria->productos;
		// if (sizeof($productos) >0)
		// {
			
		// 	return response()->json(['errors'=>array(['code'=>409,'message'=>'Esta categoria posee productos y no puede ser eliminado.'])],409);
		// }.
		$categoria->delete();
		return response()->json([ 'code' => 200, 'message' => 'Se ha eliminado correctamente la categoria.'], 200);
    }
}
