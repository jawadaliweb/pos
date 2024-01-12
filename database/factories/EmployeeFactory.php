<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     public function definition()
     {
         return [
             'name' => $this->faker->name,
             'email' => $this->faker->unique()->safeEmail,
             'phone' => $this->faker->phoneNumber,
             'address' => $this->faker->address,
             'experience' => $this->faker->sentence,
             'image' => 'noimage.jpg', // You can replace this with logic to generate image URLs
             'salary' => $this->faker->numberBetween(30000, 80000),
             'holidays' => $this->faker->numberBetween(0, 30),
             'city' => $this->faker->city,
         ];
     }

}
