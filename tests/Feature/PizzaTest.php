<?php

namespace Tests\Feature;

use App\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PizzaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_get_list_of_pizzas()
    {
        // Given a list of pizzas are stored in the database
        factory(Pizza::class, 3)->create();

        // When a guest requests to get list of pizzas
        $response = $this->getJson('api/pizzas');

        // Then they should get a successful response
        $response->assertOk();
    }
}
