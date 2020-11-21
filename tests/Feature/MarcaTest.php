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
                        'message'=>'The given data was invalid.',
                        'errors' => [
                            'descripcion' => ['The descripcion field is required.']
                            ]
                    ]);
     }

     /** A test for Marcas Show    */
     function test_Marcas_Show_Successfully()
     {
        $this->json('GET', 'api/v1/marca/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Detalle de la Marca',
            'status'=>'ok',
        ]);
     }

     function test_Marcas_Show_Failed()
     {
        $this->json('GET', 'api/v1/marca/500', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Detalle de la Marca',
            'status'=>'not found'
            ]);
     }

     /** A test for MarcasUpdate     */
    function test_Marcas_Update_Successfull()
    {
        $marca = [
            'descripcion' => 'Marca uno'
        ];

        $this->json('PATCH', 'api/v1/marca/1', $marca, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Actualizacion de Marca',
            'status'=>'ok',
        ]);
    }

    /** A test for MarcasUpdate validation Id     */
    function test_Marcas_Update_Validate_Id()
    {

        $this->json('PATCH', 'api/v1/marca/1000', [], ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Actualizacion de Marca',
            'status' => 'Not found',
        ]);
    }

    /** A test for CategoriasUpdate validation     */
    function test_Marcas_Update_Validate()
    {
         $marca = [
             'descripcion' => ''
         ];
 
         $this->json('PATCH', 'api/v1/marca/1', $marca, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "descripcion" => [
                    "The descripcion field is required."
                ]
            ]
         ]);
    }

    // /** A test for CategoriasDelete      */
    function test_Marca_Delete()
    {         
         $this->json('DELETE', 'api/v1/marca/5', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(204);
    }

     /** A test for MarcasDelete      */
     function test_Marcas_Delete_Validate_Id()
     {        
          $this->json('DELETE', 'api/v1/marca/31', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(404)
          ->assertJson([
            'message' => 'Detalle de la Marca',
            'status'=>'not found'
        ]);
     }
}
