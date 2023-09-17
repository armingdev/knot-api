<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('passport:install');
});

describe('AuthController', function () {

    it('registers a new user', function () {
        $userData = [
            'name' => 'Armin',
            'email' => 'armin@test.com',
            'password' => 'password8',
        ];

        $response = $this->postJson('/api/auth/register', $userData);

        $response->assertStatus(200);
        expect($response['name'])->toBe('Armin')
            ->and($response['email'])->toBe('armin@test.com');
    });

    it('logs in an existing user', function () {
        $user = User::factory()->create([
            'email' => 'armin_new@test.com',
            'password' => bcrypt('password8'),
        ]);

        $loginData = [
            'email' => 'armin_new@test.com',
            'password' => 'password8',
        ];

        $response = $this->postJson('/api/auth/login', $loginData);

        $response->assertStatus(200);
        expect($response['user']['email'])->toBe('armin_new@test.com')
            ->and($response['access_token'])->toBeString();
    });

    it('fails to log in with invalid credentials', function () {
        $user = User::factory()->create([
            'email' => 'armin_fake@test.com',
            'password' => bcrypt('password8'),
        ]);

        $loginData = [
            'email' => 'armin_fake@test.com',
            'password' => 'wrong-password',
        ];

        $response = $this->postJson('/api/auth/login', $loginData);

        $response->assertStatus(200);
        expect($response['message'])->toBe('Invalid Credentials');
    });

});
