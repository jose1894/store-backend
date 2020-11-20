<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\UnidadMedida;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UnidadMedida::factory()->times(10)->create();
    }
}
