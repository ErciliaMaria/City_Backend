<?php

namespace App\Contracts\City\Repository;

use App\DTO\City\ListCityDTO;
use Illuminate\Http\JsonResponse;

interface ListCityRepositoryInterface
{
    /**
     * @var {ListCityDTO} $dto
     * @return JsonResponse
     */
    public function execute(ListCityDTO $dto): JsonResponse;
}
