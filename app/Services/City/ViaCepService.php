<?php

namespace App\Services\City;

use App\Contracts\City\Service\ViaCepServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Exception;

class ViaCepService implements ViaCepServiceInterface
{
    private const API_URL = 'https://viacep.com.br/ws';

    /**
     * Fetch city data from ViaCEP API by CEP
     *
     * @param string $cep CEP without formatting (8 digits)
     * @return array|null Array with city data or null if not found
     * @throws Exception
     */
    public function fetchByCep(string $cep): ?array
    {
        try {
            // Remove any non-numeric characters
            $cep = preg_replace('/\D/', '', $cep);

            // Validate CEP format
            if (strlen($cep) !== 8) {
                throw new Exception('CEP must have 8 digits');
            }

            // Format CEP for API call (XXXXX-XXX)
            $formattedCep = substr($cep, 0, 5) . '-' . substr($cep, 5);

            $response = Http::timeout(5)->get(
                "{$this::API_URL}/{$formattedCep}/json"
            );

            if (!$response->successful()) {
                throw new Exception('Failed to fetch data from ViaCEP');
            }

            $data = $response->json();

            // Check if ViaCEP returned an error
            if (isset($data['erro']) && $data['erro'] === true) {
                return null;
            }

            return $this->formatResponse($data);
        } catch (Exception $e) {
            throw new Exception("Error fetching CEP data: {$e->getMessage()}");
        }
    }

    /**
     * Format ViaCEP response to standardized format
     *
     * @param array $data Raw data from ViaCEP API
     * @return array Formatted data
     */
    private function formatResponse(array $data): array
    {
        return [
            'cep' => $data['cep'] ?? null,
            'nome' => $data['localidade'] ?? null,
            'ddd' => (int)($data['ddd'] ?? 0),
            'codigo_ibge' => $data['ibge'] ?? null,
            'uf' => $data['uf'] ?? null,
            'bairro' => $data['bairro'] ?? null,
            'logradouro' => $data['logradouro'] ?? null,
        ];
    }
}
