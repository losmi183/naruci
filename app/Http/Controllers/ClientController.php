<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Http\Requests\ClientRegisterRequest;

class ClientController extends Controller
{
    private ClientServices $clientServices;
    public function __construct(ClientServices $clientServices)
    {
        $this->clientServices = $clientServices;
    }

    public function register(ClientRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->clientServices->register($data);
            return response()->json($result , 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }
}
