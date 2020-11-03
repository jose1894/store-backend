<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /*function testRequiredFieldsForSignUp()
    {
        $this->json('POST', 'api/auth/signup', ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    function testEmailTakenForSignUp()
    {
        $userData = [
            "name" => "Maria",
            "email" => "jose1894@gmail.com",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ]; 
        $this->json('POST', 'api/auth/signup', ['Accept' => 'application/json'])
            ->assertStatus(401);        
    }

    function testRepeatPassword()
    {
        $userData = [
            "name" => "Maria",
            "email" => "maria@example.com",
            "password" => "demo12345",
            "password_confirmation" => "12345"
        ];

        $this->json('POST', 'api/auth/signup', $userData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password_confirmation" => ["The password confirmation does not match."]
                ]
            ]);
    }

    function testSuccessfulSignUp()
    {
        $this->withoutExceptionHandling();
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];

        $this->json('POST', 'api/auth/signup', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "token",
                "message"
            ]);
    }

    function testFailedSignUp()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];

        $this->json('POST', 'api/auth/signup', $userData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJsonStructure([                
                "message"
            ]);
    }

    function testLoginSuccessfull()
    {
        $userData = [
            "email" => "doe@example.com",
            "password" => "demo12345",
            "remember_me" => true
        ];

        $this->json('POST', 'api/auth/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([                
                'message' => 'Login successfully',
                'user', 
                'token'
            ]);
    }*/
}
