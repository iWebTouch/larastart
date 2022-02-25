<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition() 
    {
        static $password;
        
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => $password ?: $password = Hash::make('secret'),
            'remember_token' => Str::random(10),
            'is_admin' => 0,
            'status' => 'active'
        ];
    }
}
