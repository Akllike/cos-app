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

    public function test_visit_musses_page(): void
    {
        $response = $this->get('/catalog/musses');
        $response->assertStatus(200);
    }

    public function test_visit_scrabs_page(): void
    {
        $response = $this->get('/catalog/scrabs');
        $response->assertStatus(200);
    }

    public function test_visit_oils_page(): void
    {
        $response = $this->get('/catalog/oils');
        $response->assertStatus(200);
    }

    public function test_visit_gels_page(): void
    {
        $response = $this->get('/catalog/gels');
        $response->assertStatus(200);
    }

    public function test_visit_admin_page(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
    }
}
