<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testCreateUser()
    {
        $response = $this->postJson('/api/users', ["name" => "Jack",
            "email" => "acle@a",
            "password" => "test"]);
        $response->assertStatus(201)
            ->assertJson([
                "user" =>[
                    "name" => "Jack",
                    "email" => "acle@a",
                ],
                'message' => 'Created successfully',
            ]);
    }

    public function testGetAllUsers()
    {
        $response = $this->postJson('/api/users', ["name" => "Jack",
            "email" => "acle@a",
            "password" => "test"]);
        $response = $this->getJson('/api/users');
        $response->assertStatus(200)
            ->assertJson([
                "users" =>
                    [[
                        "name" => "Jack",
                        "email" => "acle@a",
                        "email_verified_at" => null,
                    ]],
                'message' => 'Retrieved successfully',
            ]);
    }

    public function testGetUserById()
    {
        $response = $this->postJson('/api/users', ["name" => "Jack",
            "email" => "acle@a",
            "password" => "test"]);
        $response = $this->getJson('/api/users/3');
        $response
            ->assertJson([
                "user" =>
                    [
                        "name" => "Jack",
                        "email" => "acle@a",
                        "email_verified_at" => null,
                    ],
                'message' => 'Retrieved successfully',
            ]);
    }
}
