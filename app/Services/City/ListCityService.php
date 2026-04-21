<?php

namespace App\Services\City;

use App\Contracts\City\Repository\ListCityRepositoryInterface;
use App\Contracts\City\Service\ListCityServiceInterface;
use App\DTO\City\ListCityDTO;
use Illuminate\Http\JsonResponse;

class ListCityService implements ListCityServiceInterface
{
    public function __construct(private ListCityRepositoryInterface $listCityRepository)
    {
    }

    public function execute(ListCityDTO $dto): JsonResponse
    {
        $page = max(1, (int) $dto->page);
        $limit = max(1, (int) $dto->limit);

        $cities = $this->listCityRepository->execute($page, $limit, $dto->search);

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
