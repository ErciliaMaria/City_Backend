<?php

namespace App\Http\Controllers;

use App\Contracts\City\Service\CepServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CepController extends Controller
{
    public function __construct(private CepServiceInterface $cepService)
    {
    }

    /**
     * Fetch city data by CEP
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function execute(Request $request): JsonResponse
    {
        try {
            $data = $this->cepService->searchByCep((string) $request->input('cep', ''));

            return response()->json([
                'success' => true,
                'message' => 'CEP data fetched successfully',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 400);
        }
    }
}
