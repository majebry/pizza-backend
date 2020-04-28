<?php

use App\Pizza;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pizza::class)->createMany([
            [
                'name'          => 'Home-made Pizza',
                'image_path'    => 'homemade-pizza.jpeg'
            ],
            [
                'name'          => 'Margherita Pizza',
                'image_path'    => 'margherita-pizza.jpg'
            ],
            [
                'name'          => 'Muffaletta Pizza',
                'image_path'    => 'muffaletta-pizza.jpeg'
            ],
            [
                'name'          => 'Basil Food Pizza',
                'image_path'    => 'pizza-basil-foods.jpg'
            ],
            [
                'name'          => 'Basil Olives Pizza',
                'image_path'    => 'pizzas-basil-olives.jpg'
            ],
            [
                'name'          => 'Rainbow Pizza',
                'image_path'    => 'rainbow-pizza.jpeg'
            ],
            [
                'name'          => 'Rocket Vegetable Pizza',
                'image_path'    => 'rocket-vegetable-pizza.jpg'
            ],
            [
                'name'          => 'Vegetables Italian Pizza',
                'image_path'    => 'vegetables-italian-pizza.jpg'
            ],
        ]);

        factory(Pizza::class, 4)->create();
    }
}
