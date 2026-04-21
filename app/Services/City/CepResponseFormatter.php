<?php

namespace App\Services\City;

class CepResponseFormatter
{
    public function formatCepResponse(array $data): array
    {
        return [
            'nome' => $data['localidade'] ?? null,
            'ddd' => (int) ($data['ddd'] ?? 0),
            'codigo_ibge' => $data['ibge'] ?? null,
        ];
    }
}
