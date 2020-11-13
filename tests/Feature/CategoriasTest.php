<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriasTest extends TestCase
{
    /** A test for CategoriasIndex     */
    function test_Categorias_Index()
    {
        $this->json('GET', 'api/v1/categoria', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Categorias list',
            'status'=>'ok',
        ]);

    }

    /** A test for CategoriasStore     */
    function test_Categorias_Store_Successfull()
    {
        $categoria = [
            'descripcion' => 'Categoria test'
        ];

        $this->json('POST', 'api/v1/categoria', $categoria, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([                
            'message' => 'Categoria creada exitosamente!',            
        ]);
    }

    /** A test for CategoriasStore validation     */
    function test_Categorias_Store_Validate()
    {
         $categoria = [
             'descripcion' => ''
         ];
 
         $this->json('POST', 'api/v1/categoria', $categoria, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
            'errors'=> [
                    ['message'=>'Faltan datos necesarios para procesar el registro.']
                ]
            ]);
     }

     function test_Categorias_Show_Successfully()
     {
        $this->json('GET', 'api/v1/categoria/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Detalle de la Categoria',
            'status'=>'ok',
        ]);
     }

     function test_Categorias_Show_Failed()
     {
        $this->json('GET', 'api/v1/categoria/500', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'errors'=> [
                        ['message'=>'No se encuentra una categoria con ese código.']
                    ]
            ]);
     }

     /** A test for CategoriasUpdate     */
    function test_Categorias_Update_Successfull()
    {
        $categoria = [
            'descripcion' => 'Categoria uno'
        ];

        $this->json('PATCH', 'api/v1/categoria/1', $categoria, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([                
            'message' => 'Categoria actualizada exitosamente!',
            'status'=>'ok'
        ]);
    }

    /** A test for CategoriasUpdate validation Id     */
    function test_Categorias_Update_Validate_Id()
    {
        $categoria = [
            'descripcion' => 'Categoria'
        ];

        $this->json('PATCH', 'api/v1/categoria/1000', $categoria, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson(['errors' => [
                [ 'message' => 'No se encuentra una categoria con ese código.']
            ]
        ]);
    }

    /** A test for CategoriasUpdate validation     */
    function test_Categorias_Update_Validate()
    {
         $categoria = [
             'descripcion' => ''
         ];
 
         $this->json('PATCH', 'api/v1/categoria/1', $categoria, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(304);
    }

    /** A test for CategoriasDelete      */
    function test_Categorias_Delete()
    {        
 
         $this->json('DELETE', 'api/v1/categoria/2', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(204);
    }

     /** A test for CategoriasDelete      */
     function test_Categorias_Delete_Validate_Id()
     {        
          $this->json('DELETE', 'api/v1/categoria/31', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(404)
          ->assertJson([ 'errors' => [
                        ['message' => 'No se encuentra una categoria con ese código.']
                    ]
            ]);
     }


}
