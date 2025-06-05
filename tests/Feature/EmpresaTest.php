<?php

namespace Tests\Feature;

use App\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_empresa()
    {
        $data = [
            'nit' => '123456789',
            'nombre' => 'Empresa Test',
            'direccion' => 'Calle 123',
            'telefono' => '555-1234',
        ];

        $response = $this->postJson('/api/empresas', $data);
        $response->assertStatus(201)
                 ->assertJson($data + ['estado' => 'Activo']);
    }

    public function test_can_get_all_empresas()
    {
        Empresa::factory()->count(3)->create();
        $response = $this->getJson('/api/empresas');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_get_empresa_by_nit()
    {
        $empresa = Empresa::factory()->create(['nit' => '123456789']);
        $response = $this->getJson('/api/empresas/123456789');
        $response->assertStatus(200)
                 ->assertJsonFragment(['nit' => '123456789']);
    }

    public function test_can_update_empresa()
    {
        $empresa = Empresa::factory()->create(['nit' => '123456789']);
        $data = ['nombre' => 'Empresa Actualizada'];
        $response = $this->putJson('/api/empresas/123456789', $data);
        $response->assertStatus(200)
                 ->assertJsonFragment($data);
    }

    public function test_can_delete_inactive_empresas()
    {
        Empresa::factory()->create(['estado' => 'Inactivo']);
        $response = $this->deleteJson('/api/empresas/inactivas');
        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => '1 empresas inactivas eliminadas']);
    }

    public function test_fails_if_nit_is_not_unique()
    {
        Empresa::factory()->create(['nit' => '123456789']);
        $data = [
            'nit' => '123456789',
            'nombre' => 'Empresa Test',
            'direccion' => 'Calle 123',
            'telefono' => '555-1234',
        ];

        $response = $this->postJson('/api/empresas', $data);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors('nit');
    }
}