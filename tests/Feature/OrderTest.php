<?php

namespace Tests\Feature;

use App\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_guest_can_submit_an_order()
    {
        // Given a list of pizzas are stored in the database
        $pizzas = factory(Pizza::class, 3)->create();

        // When a guest submits an order containing chosen pizzas
        $chosenPizza = $pizzas->first();

        $clientDetails = [
            'name'      =>  $this->faker->name,
            'phone'     =>  $this->faker->phoneNumber,
            'address'   =>  $this->faker->address,
        ];

        $orderDetails = [
            'currency'  =>  'euro',
            'cart_items' => [
                [
                    'pizzaId' => $chosenPizza->id,
                    'quantity' => 1
                ]
            ]
        ];

        $response = $this->postJson(
            'api/orders',
            Arr::collapse([$clientDetails, $orderDetails])
        );

        // Then they order should be inserted
        $this->assertDatabaseHas('clients', $clientDetails);
        $this->assertDatabaseHas('order_items', [
            'pizza_id' => $chosenPizza->id,
            'quantity' => 1
        ]);

        // And the client should get a successful response
        $response->assertCreated();
    }
}
