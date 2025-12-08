<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): string
    {
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        return $user->createToken('api_token')->plainTextToken;
    }

    public function login(array $data): string
    {
        $user = User::where('email', $data['email'])->first();

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect credentials.'],
            ]);
        }

        return $user->createToken('api_token')->plainTextToken;
    }
}
