<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/api/test');

        $response->assertStatus(200);
    }

    public function testPostTest()
    {
        $response = $this->json('POST', '/api/test/post', ['name' => 'Sally']);

        $response
          ->assertStatus(200)
          ->assertJson([
            'created' => true,
          ]);
    }

    public function testPostFailTest()
    {
        $response = $this->json('POST', '/api/test/post', ['name' => 'Sa']);

        $response
          ->assertStatus(422);
    }

    public function testDatabaseTest()
    {
        $response = $this->json('POST', '/api/test/db', [
          'name' => 'Bubu',
          'price' => 233.95,
        ]);

        $response
          ->assertStatus(200);
    }


}
