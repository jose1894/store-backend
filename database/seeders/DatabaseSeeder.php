<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'jose1894',
            'email' => 'jose1894@jose.local',
            'email_verified_at' => now(),
            'password' => bcrypt('123456'), // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(9)->create();
        $this->call(CategoriasSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ModeloSeeder::class);
    }
}
