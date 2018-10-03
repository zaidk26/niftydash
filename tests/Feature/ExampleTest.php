<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_guest_directed_to_login()
    {
        $response = $this->get('/');

        $response->assertRedirect('login')->assertStatus(302);
    }
}
