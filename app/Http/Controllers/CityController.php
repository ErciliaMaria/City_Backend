<?php

namespace App\Http\Controllers;

use App\Contracts\City\Service\ListCityServiceInterface;
use App\DTO\City\ListCityDTO;
use App\Http\Request\City\ListCityRequest;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{
      public function __construct(protected ListCityServiceInterface $listCityService){}

    public function execute(ListCityRequest $listCityRequest): JsonResponse
    {
        $data = $listCityRequest->only(['page', 'limit', 'search']);

        $dto = ListCityDTO::fromRequest($data);

        return $this->listCityService->execute($dto);
    }
}
