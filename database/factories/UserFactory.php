<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lang = 33.7490;
        $long = -84.3880;

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'address' => fake()->streetAddress,
            'country' => fake()->country,
            'state' => fake()->state,
            'city' => fake()->city,
            'post_code' => fake()->postCode,
            'location_lat' => fake()->latitude($min = ($lang - mt_rand(0, 20)), $max = ($lang + mt_rand(0, 20))),
            'location_log' => fake()->longitude($min = ($long - mt_rand(0, 20)), $max = ($long + mt_rand(0, 20))),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
