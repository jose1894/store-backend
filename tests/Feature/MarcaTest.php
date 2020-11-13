<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class MarcaTest extends TestCase
{
    /** Test Marca Index */
    function test_Marcas_index()
    {
        $this->json('GET', 'api/v1/marca', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Marcas list',
            'status'=>'ok',
        ]);
    }

    /** Test Marca Store Successfull */
    function test_Marcas_Store_Successfull()
    {
        $marca = [
            'descripcion' => Str::random(5),
        ];
        $this->json('POST', 'api/v1/marca', $marca, ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Marca creada exitosamente!',   
            'status'=>'ok',
        ]);
    }

    /** A test for Marcas Store validation     */
    function test_Marcas_Store_Validate()
    {
         $marca = [
             'descripcion' => ''
         ];
 
         $this->json('POST', 'api/v1/marca', $marca, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
            'errors'=> [
                    ['message'=>'Faltan datos necesarios para procesar el registro.']
                ]
            ]);
     }

     /** A test for Marcas Show    */
     function test_Categorias_Show_Successfully()
     {
        $this->json('GET', 'api/v1/marca/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Detalle de la Categoria',
            'status'=>'ok',
        ]);
     }
}
