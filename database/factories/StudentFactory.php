<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'city_id' => City::inRandomOrder()->first()->id ?? 1,
            'birthday' => $this->faker->date('Y-m-d'),
            'grupe_id' => \App\Models\Group::inRandomOrder()->first()->id ?? null,
            'gim_data' => $this->faker->optional()->date('Y-m-d'),
        ];
    }
}

