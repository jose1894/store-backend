<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class UnidadMedidaTest extends TestCase
{
    /** Test UnidadMedida Index */
    function test_UnidadMedidas_index()
    {
        $this->json('GET', 'api/v1/unidadmedida', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'UnidadMedidas list',
            'status'=>'ok',
        ]);
    }

    /** Test UnidadMedida Store Successfull */
    function test_UnidadMedidas_Store_Successfull()
    {
        $unidadMedida = [
            'descripcion' => Str::random(5),
        ];
        $this->json('POST', 'api/v1/unidadmedida', $unidadMedida, ['Accept' => 'application/json', 'Content-Type' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            'message' => 'UnidadMedida creada exitosamente!',   
            'status'=>'ok',
        ]);
    }

    /** A test for UnidadMedidas Store validation     */
    function test_UnidadMedidas_Store_Validate()
    {
         $unidadMedida = [
             'descripcion' => ''
         ];
 
         $this->json('POST', 'api/v1/unidadmedida', $unidadMedida, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(422)
         ->assertJson([
                        'message'=>'The given data was invalid.',
                        'errors' => [
                            'descripcion' => ['The descripcion field is required.']
                            ]
                    ]);
     }

     /** A test for UnidadMedidas Show    */
     function test_UnidadMedidas_Show_Successfully()
     {
        $this->json('GET', 'api/v1/unidadmedida/1', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Detalle de la UnidadMedida',
            'status'=>'ok',
        ]);
     }

     function test_UnidadMedidas_Show_Failed()
     {
        $this->json('GET', 'api/v1/unidadmedida/500', ['Content-Type' => 'application/json','Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Detalle de la UnidadMedida',
            'status'=>'not found'
            ]);
     }

     /** A test for UnidadMedidasUpdate     */
    function test_UnidadMedidas_Update_Successfull()
    {
        $unidadMedida = [
            'descripcion' => 'UnidadMedida uno'
        ];

        $this->json('PATCH', 'api/v1/unidadmedida/1', $unidadMedida, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            'message' => 'Actualizacion de UnidadMedida',
            'status'=>'ok',
        ]);
    }

    /** A test for UnidadMedidasUpdate validation Id     */
    function test_UnidadMedidas_Update_Validate_Id()
    {

        $this->json('PATCH', 'api/v1/unidadmedida/1000', [], ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
        ->assertStatus(404)
        ->assertJson([
            'message' => 'Actualizacion de UnidadMedida',
            'status' => 'Not found',
        ]);
    }

    /** A test for CategoriasUpdate validation     */
    function test_UnidadMedidas_Update_Validate()
    {
         $unidadMedida = [
             'descripcion' => ''
         ];
 
         $this->json('PATCH', 'api/v1/unidadmedida/1', $unidadMedida, ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
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
    function test_UnidadMedida_Delete()
    {         
         $this->json('DELETE', 'api/v1/unidadmedida/1', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
         ->assertStatus(204);
    }

     /** A test for UnidadMedidasDelete      */
     function test_UnidadMedidas_Delete_Validate_Id()
     {        
          $this->json('DELETE', 'api/v1/unidadmedida/31', ['Content-Type' =>'application/json', 'Accept' => 'application/json'])
          ->assertStatus(404)
          ->assertJson([
            'message' => 'Detalle de la UnidadMedida',
            'status'=>'not found'
        ]);
     }
}
