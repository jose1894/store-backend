<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarcaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Marca_index()
    {
        $this->json('GET', 'api/v1/marca', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Marcas list',
            'status'=>'ok',
        ]);
    }
}
