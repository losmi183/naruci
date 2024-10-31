<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Services\ClientServices;
use App\Services\CompanyServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\InitializeClientRequest;
use App\Http\Requests\ClientStoreCompanyRequest;
use App\Http\Requests\ClientCreateCompanyRequest;
use App\Http\Requests\ClientUpdateCompanyRequest;

class CompanyController extends Controller
{
    private CompanyServices $companyServices;
    private UserServices $userServices;
    public function __construct(CompanyServices $companyServices, ClientServices $clientServices, UserServices $userServices)
    {
        $this->companyServices = $companyServices;
        $this->clientServices = $clientServices;
        $this->userServices = $userServices;        
    }

    public function show(): JsonResponse
    {
        $user = $this->userServices->getUser();
        if($user['company_id'] == null) {
            return response()->json([
                'error' => __('custom.user dont have company')
            ], 404);
        }
        $result = $this->companyServices->show($user);
        return response()->json($result , 200);
    }

    public function store(ClientStoreCompanyRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $user = $this->userServices->getUser();
            $result = $this->companyServices->store( $user,$data);
            return response()->json($result , 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }

    public function update(ClientUpdateCompanyRequest $request, $company_id): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->companyServices->store(intval( $company_id), $data);
            return response()->json($result , 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }
    public function delete($company_id): JsonResponse
    {
        try {
            $result = $this->companyServices->delete(intval($company_id));
            return response()->json($result , 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }

}
