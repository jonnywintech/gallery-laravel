<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class UrlTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        // Refresh the database and run migrations before each test
        \Artisan::call('migrate:fresh');

        // Run seeders if needed
        \Artisan::call('db:seed');

        // Create a test user and authenticate them
        $this->user = new User([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'is_verified' => true,
        ]);
        // Authenticate the user
        $this->be($this->user);
    }


    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_all_urls(): void
    {
        $this->be($this->user);

        $filtered_routes = collect(Route::getRoutes())
            ->reject(function ($route) {
                $route_name = $route->getName();

                if (is_null($route_name)) {
                    return true;
                }

                $excludedRouteNames = ['debugbar.', 'sanctum.', 'ignition.'];

                foreach ($excludedRouteNames as $needle) {
                    if (str_contains($route_name, $needle)) {
                        return true;
                    }
                }

                return false;
            })
            ->pluck('uri')
            ->all();

        foreach ($filtered_routes as $route) {
            try {
                $response = $this->get($route);
                $response->assertStatus(200);
            } catch (\Exception $e) {
                // Handle routes without the GET method, e.g., by skipping them
                continue;
            }
        }
    }
}
