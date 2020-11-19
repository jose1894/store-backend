<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class TipoProductoTest extends TestCase
{
     /** Test TipoProducto Index */
     function test_TipoProductos_index()
     {
         $this->json('GET', 'api/v1/tipoproductos', ['Accept' => 'application/json'])
         ->assertStatus(200)
         ->assertJson([
             'message' => 'TipoProductos list',
             'status'=>'ok',
         ]);
     }
 
     /** Test TipoProducto Store Successfull */
     function test_TipoProductos_Store_Successfull()
     {
         $tipoProducto = [
             'descripcion' => Str::random(5),
         ];
         $this->json('POST', 'api/v1/tipoproductos', $tipoProducto, ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
         ->assertStatus(201)
         ->assertJson([
             'message' => 'TipoProducto creada exitosamente!',   
             'status'=>'ok',
         ]);
     }
 
     /** A test for TipoProductos Store validation     */
     function test_TipoProductos_Store_Validate()
     {
          $tipoProducto = [
              'descripcion' => ''
          ];
  
          $this->json('POST', 'api/v1/tipoproductos', $tipoProducto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(422)
          ->assertJson([
                         'message'=>'The given data was invalid.',
                         'errors' => [
                             'descripcion' => ['The descripcion field is required.']
                             ]
                     ]);
      }
 
      /** A test for TipoProductos Show    */
      function test_TipoProductos_Show_Successfully()
      {
         $this->json('GET', 'api/v1/tipoproductos/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
         ->assertStatus(200)
         ->assertJson([
             'message' => 'Detalle de la TipoProducto',
             'status'=>'ok',
         ]);
      }
 
      function test_TipoProductos_Show_Failed()
      {
         $this->json('GET', 'api/v1/tipoproductos/500', ['Content-Type' => 'application/json','Accept' => 'application/json'])
         ->assertStatus(404)
         ->assertJson([
             'message' => 'Detalle de la TipoProducto',
             'status'=>'not found'
             ]);
      }
 
      /** A test for TipoProductosUpdate     */
     function test_TipoProductos_Update_Successfull()
     {
         $tipoProducto = [
             'descripcion' => 'TipoProducto uno'
         ];
 
         $this->json('PATCH', 'api/v1/tipoproductos/1', $tipoProducto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(200)
         ->assertJson([
             'message' => 'Actualizacion de TipoProducto',
             'status'=>'ok',
         ]);
     }
 
     /** A test for TipoProductosUpdate validation Id     */
     function test_TipoProductos_Update_Validate_Id()
     {
 
         $this->json('PATCH', 'api/v1/tipoproductos/1000', [], ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(404)
         ->assertJson([
             'message' => 'Actualizacion de TipoProducto',
             'status' => 'Not found',
         ]);
     }
 
     /** A test for CategoriasUpdate validation     */
     function test_TipoProductos_Update_Validate()
     {
          $tipoProducto = [
              'descripcion' => ''
          ];
  
          $this->json('PATCH', 'api/v1/tipoproductos/1', $tipoProducto, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
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
          $this->json('DELETE', 'api/v1/tipoproductos/1', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(204);
     }
 
      /** A test for TipoProductosDelete      */
      function test_TipoProductos_Delete_Validate_Id()
      {        
           $this->json('DELETE', 'api/v1/tipoproductos/31', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
           ->assertStatus(404)
           ->assertJson([
             'message' => 'Detalle de la TipoProducto',
             'status'=>'not found'
         ]);
      }
}
