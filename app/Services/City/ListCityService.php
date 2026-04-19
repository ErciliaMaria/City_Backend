<?php

namespace App\Services\City;

use App\Contracts\City\Service\ListCityServiceInterface;
use App\DTO\City\ListCityDTO;
use App\Models\Cidade;
use Illuminate\Http\JsonResponse;

class ListCityService implements ListCityServiceInterface
{
    public function execute(ListCityDTO $dto): JsonResponse
    {
        $page = max(1, (int) $dto->page);
        $limit = max(1, (int) $dto->limit);

        $query = Cidade::query()->with('uf');

        if ($dto->search !== '') {
            $query->where('nome', 'like', '%' . $dto->search . '%');
        }

        $cities = $query
            ->orderBy('nome')
            ->paginate(perPage: $limit, page: $page);

        return response()->json([
            'success' => true,
            'message' => 'Cities fetched successfully',
            'data' => $cities->items(),
            'meta' => [
                'current_page' => $cities->currentPage(),
                'per_page' => $cities->perPage(),
                'total' => $cities->total(),
                'last_page' => $cities->lastPage(),
            ],
        ]);
    }
}
