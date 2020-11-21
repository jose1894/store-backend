<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProductoTest extends TestCase
{
    /** Test Producto Index */
    function test_Producto_index()
    {
        $this->json('GET', 'api/v1/producto', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Productos list',
            'status'=>'ok',
        ]);
    }

    /** Test Producto Store Successfull */
    function test_Productos_Store_Successfull()
    {
        $producto = [
            "categoria_id" => 3,
            "codigo" => "LP-SCW1",
            "nombre" => "Producto 1",
            "modelo_id" => 3,
            "undmed_id" => 3,
            "tipoprod_id" => 3,
            "precio_compra" => 1,
            "precio_venta" => 1
        ];
        $this->json('POST', 'api/v1/producto', $producto, ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Producto creado exitosamente!',   
            'status'=>'ok',
        ]);
    }

    /** A test for Productos Store validation     */
    function test_Productos_Store_Validate()
    {
         $producto = [];
 
         $this->json('POST', 'api/v1/producto', $producto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
                        'message'=>'The given data was invalid.',
         ]);
     }

     /** A test for Productos Show    */
     function test_Productos_Show_Successfully()
     {
        $this->json('GET', 'api/v1/producto/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Detalle del Producto',
            'status'=>'ok',
        ]);
     }

     function test_Productos_Show_Failed()
     {
        $this->json('GET', 'api/v1/producto/500', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Detalle del Producto',
            'status'=>'not found'
            ]);
     }

     /** A test for ProductosUpdate     */
    function test_Productos_Update_Successfull()
    {
        $producto = [
            "categoria_id" => 3,
            "codigo" => "LP-SC2",
            "nombre" => "Producto uno",
            "modelo_id" => 3,
            "undmed_id" => 3,
            "tipoprod_id" => 3,
            "precio_compra" => 1,
            "precio_venta" => 1
        ];

        $this->json('PATCH', 'api/v1/producto/1', $producto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Actualizacion del Producto',
            'status'=>'ok',
        ]);
    }

    /** A test for ProductosUpdate validation Id     */
    function test_Productos_Update_Validate_Id()
    {

        $this->json('PATCH', 'api/v1/producto/1000', [], ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Actualizacion del Producto',
            'status' => 'Not found',
        ]);
    }

    /** A test for CategoriasUpdate validation     */
    function test_Productos_Update_Validate()
    {
         $producto = [];
 
         $this->json('PATCH', 'api/v1/producto/1', $producto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
            "message" => "The given data was invalid.",           
         ]);
    }

    // /** A test for CategoriasDelete      */
    function test_Producto_Delete()
    {         
         $this->json('DELETE', 'api/v1/producto/1', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(204);
    }

     /** A test for ProductosDelete      */
     function test_Productos_Delete_Validate_Id()
     {        
          $this->json('DELETE', 'api/v1/producto/31', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(404)
          ->assertJson([
            'message' => 'Detalle del Producto',
            'status'=>'not found'
        ]);
     }
}
