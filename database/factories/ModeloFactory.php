<?php

namespace Database\Factories;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ModeloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modelo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $marca = DB::table('marcas')->select('id')->where('id', '=', '1')->get()->pluck('id')->toArray()[0];
        return [
            'descripcion' => Str::random(10),
            'marca_id' => $marca,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
