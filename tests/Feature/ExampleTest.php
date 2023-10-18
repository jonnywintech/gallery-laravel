<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */

     use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get(env('APP_URL'));

        $response->assertStatus(200);
    }
}
