<?php

namespace App\Contracts\City\Service;

interface CepServiceInterface
{
    /**
     * Fetch city data from ViaCEP API by CEP
     *
     * @param string $cep CEP without formatting (8 digits)
     * @return array|null Array with city data or null if not found
     */
    public function searchByCep(string $cep): ?array;
}
