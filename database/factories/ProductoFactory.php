<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $modelo = DB::table('modelos')->select('id')->where('id', '=', '2')->get()->pluck('id')->toArray()[0];
        $undMed = DB::table('unidad_medida')->select('id')->where('id', '=', '2')->get()->pluck('id')->toArray()[0];
        $categoria = DB::table('categorias')->select('id')->where('id', '=', '2')->get()->pluck('id')->toArray()[0];
        $tipoProd = DB::table('tipo_productos')->select('id')->where('id', '=', '2')->get()->pluck('id')->toArray()[0];
        
        return [
            'codigo' => Str::random(10),
            'nombre' => Str::random(50),
            'imagen' => Str::random(255),
            'descripcion' => Str::random(10),
            'modelo_id' => $modelo,
            'undmed_id' => $undMed,
            'categoria_id' => $categoria,
            'tipoprod_id' => $tipoProd,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
