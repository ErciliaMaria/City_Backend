<?php

namespace App\Services\City;

use App\Contracts\City\Service\CepServiceInterface;
use Illuminate\Support\Facades\Http;
use Exception;

class CepService implements CepServiceInterface
{
    private const API_URL = 'https://viacep.com.br/ws';

    public function __construct(private CepResponseFormatter $responseFormatter)
    {
    }

    /**
     * Fetch city data from ViaCEP API by CEP
     *
     * @param string $cep CEP without formatting (8 digits)
     * @return array|null Array with city data or null if not found
     * @throws Exception
     */
    public function searchByCep(string $cep): ?array
    {
        try {
            $response = Http::timeout(5)->get(
                self::API_URL . "/{$cep}/json"
            );

            $data = $response->json();

            return $this->responseFormatter->formatCepResponse($data);
        } catch (Exception $e) {
            throw new Exception("Error fetching CEP data: {$e->getMessage()}");
        }
    }
}
