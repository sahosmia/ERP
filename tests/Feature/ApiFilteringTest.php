<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Fabric;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiFilteringTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_returns_paginated_fabrics_as_json_for_ajax_requests()
    {
        Supplier::factory()->count(5)->create();
        Fabric::factory()->count(20)->create();

        $response = $this->json('GET', route('api.fabrics.index'), [], ['Accept' => 'application/json']);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'fabric_no',
                        'composition',
                        'gsm',
                        'supplier_id',
                    ]
                ],
                'links_html',
            ]);
    }

    /** @test */
    public function it_filters_fabrics_by_company_name()
    {
        $supplier1 = Supplier::factory()->create(['company_name' => 'Test Supplier 1']);
        $supplier2 = Supplier::factory()->create(['company_name' => 'Another Supplier']);

        Fabric::factory()->count(5)->for($supplier1)->create();
        Fabric::factory()->count(5)->for($supplier2)->create();

        $response = $this->json('GET', route('api.fabrics.index', ['company_name' => 'Test Supplier 1']), [], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertCount(5, $response->json('data'));
    }

    /** @test */
    public function it_returns_paginated_suppliers_as_json_for_ajax_requests()
    {
        Supplier::factory()->count(20)->create();

        $response = $this->json('GET', route('api.suppliers.index'), [], ['Accept' => 'application/json']);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'company_name',
                        'code',
                        'representative_name',
                        'country',
                    ]
                ],
                'links_html',
            ]);
    }

    /** @test */
    public function it_filters_suppliers_by_company_name()
    {
        Supplier::factory()->create(['company_name' => 'Filter Test Co']);
        Supplier::factory()->count(10)->create();

        $response = $this->json('GET', route('api.suppliers.index', ['company_name' => 'Filter Test Co']), [], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
    }
}