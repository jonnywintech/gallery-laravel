<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use function Laravel\Prompts\table;
use Database\Seeders\DatabaseSeeder;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // Run migrations
        \Artisan::call('migrate:fresh');

        // Run seeders
        \Artisan::call('db:seed');

        $this->user = new User();
        $this->user->first_name = 'John';
        $this->user->last_name = 'Wicker';
        $this->user->email = 'john@example.com';
        $this->user->password = password_hash('password', PASSWORD_BCRYPT);
        $this->user->is_verified = true;

        $this->user->save();
    }

    /**
     * A basic login test.
     *
     * @return void
     */


    public function testUserData(): void
    {
        $this->assertTrue($this->user->first_name === 'John');
        $this->assertTrue($this->user->last_name === 'Wicker');
        $this->assertTrue($this->user->email === 'john@example.com');
    }

    public function testLogin(): void
    {

        $response = $this->post('/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
}
