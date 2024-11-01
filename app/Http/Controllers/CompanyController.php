<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Policies\CompanyPolicy;
use App\Services\ClientServices;
use App\Services\CompanyServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\InitializeClientRequest;
use App\Http\Requests\ClientStoreCompanyRequest;
use App\Http\Requests\ClientCreateCompanyRequest;
use App\Http\Requests\ClientUpdateCompanyRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    private CompanyServices $companyServices;
    private UserServices $userServices;
    private $user;
    private $user_company;
    private CompanyPolicy $companyPolicy;
    public function __construct(CompanyServices $companyServices, ClientServices $clientServices, UserServices $userServices, CompanyPolicy $companyPolicy)
    {
        $this->companyServices = $companyServices;
        $this->clientServices = $clientServices;
        $this->userServices = $userServices;
        $this->companyPolicy = $companyPolicy;
    }

    public function show($company_id): JsonResponse
    {
        $user = $this->userServices->userWithCompany();

        $authorizationResponse = $this->companyPolicy->show($user, $company_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $result = $this->companyServices->show(intval($company_id));
            return response()->json($result , 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }

    public function store(ClientStoreCompanyRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = $this->userServices->userWithCompany();

        $authorizationResponse = $this->companyPolicy->store($user);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $result = $this->companyServices->store( intval($user->id), $data);
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
        
        $user = $this->userServices->userWithCompany();

        $authorizationResponse = $this->companyPolicy->update($user, $company_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }
        
        try {      
            $result = $this->companyServices->update(intval(  $company_id), $data);
            return response()->json( $result , 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }
    public function delete($company_id): JsonResponse
    {        
        $user = $this->userServices->userWithCompany();

        $authorizationResponse = $this->companyPolicy->delete($user, $company_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            Company::where('id', $company_id)->delete();
            // $result = $this->companyServices->delete(intval($company_id));
            return response()->json(__('custom.company deleted') , 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }

}
