<?php

namespace App\Contracts\City\Service;

use App\DTO\City\ListCityDTO;
use Illuminate\Http\JsonResponse;

interface ListCityServiceInterface
{
    /**
     * @var {ListCityDTO} $dto
     * @return JsonResponse
     */
    public function execute(ListCityDTO $dto): JsonResponse;
}
