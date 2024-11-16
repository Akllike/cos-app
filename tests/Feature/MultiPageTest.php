<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MultiPageTest extends TestCase
{
    public function test_visit_index_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_visit_hairs_page(): void
    {
        $response = $this->get('/catalog/hairs');
        $response->assertStatus(200);
    }

    public function test_visit_faces_page(): void
    {
        $response = $this->get('/catalog/faces');
        $response->assertStatus(200);
    }

    public function test_visit_bodies_page(): void
    {
        $response = $this->get('/catalog/bodies');
        $response->assertStatus(200);
    }

    public function test_visit_admin_page(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }
}
