<?php

namespace App\Http\Controllers;

use App\Services\City\ViaCepService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CepController extends Controller
{
    public function __construct(private ViaCepService $viaCepService)
    {
    }

    /**
     * Fetch city data by CEP
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByCep(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'cep' => 'required|string|min:8|max:9',
            ]);

            $data = $this->viaCepService->fetchByCep($validated['cep']);

            if ($data === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'CEP not found',
                    'data' => null,
                ], 404);
            }

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
