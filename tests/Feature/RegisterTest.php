<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('example', function () {
    $response = $this->postJson('/api/register',[
        'name'=>'test user',
        'email'=>'test@test.com',
        'password'=>'password123',
        'password_confirmation'=>'password123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data'=>[
                'user'=>[
                    'id',
                    'name',
                    'email'
                ],
                'avatar_url',
                'token'
            ]
        ]);

    $this->assertDatabaseHas('users',[
        'email'=>'test@test.com'
    ]);
});
