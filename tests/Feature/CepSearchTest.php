<?php

namespace Tests\Feature;

use Tests\TestCase;

class CepSearchTest extends TestCase
{
    /**
     * Test searching CEP data successfully
     */
    public function test_search_cep_successfully(): void
    {
        // Using a real CEP example: 01310100 (Av. Paulista, São Paulo)
        $response = $this->postJson('/api/v1/cep/search', [
            'cep' => '01310100',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'cep',
                    'nome',
                    'ddd',
                    'codigo_ibge',
                    'uf',
                    'bairro',
                    'logradouro',
                ],
            ]);
    }

    /**
     * Test searching with invalid CEP
     */
    public function test_search_cep_not_found(): void
    {
        // Using a non-existent CEP
        $response = $this->postJson('/api/v1/cep/search', [
            'cep' => '99999999',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'CEP not found',
            ]);
    }

    /**
     * Test searching with invalid CEP format
     */
    public function test_search_cep_invalid_format(): void
    {
        $response = $this->postJson('/api/v1/cep/search', [
            'cep' => '123',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test searching without CEP parameter
     */
    public function test_search_cep_missing_parameter(): void
    {
        $response = $this->postJson('/api/v1/cep/search', []);

        $response->assertStatus(422);
    }
}
