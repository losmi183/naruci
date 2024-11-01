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
        $this->user = $this->userServices->getUser();
        $this->user_company = $this->companyServices->userCompany($this->user['id']);
    }

    public function show(): JsonResponse
    {
        try {
            $user = $this->userServices->getUser();        
            $result = $this->companyServices->show($user);
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
        try {
            $user = $this->userServices->getUser();
            $user_company = $this->companyServices->userCompany($user['id']);
            if($user_company) {
                return response()->json([
                    'error' => __('custom.user already has a company')
                ], 400);
            }

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
        // 1. Validation ant input trimming
        $data = $request->validated();
        
        $user = $this->userServices->userWithCompany();

        // 2. Authorization for user
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
        try {            
            $user = $this->userServices->getUser();
            $user_company = $this->companyServices->userCompany($user['id']);
    
            if($user_company->id != $company_id) {
                return response()->json([
                    'error' => __('custom.user dont have rights to update company')
                ], 403);
            } else if ($user['role_id'] != config('business.roles.owner')) {
                return response()->json([
                    'error' => __('custom.only owner can update company')
                ], 400);
            }

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
