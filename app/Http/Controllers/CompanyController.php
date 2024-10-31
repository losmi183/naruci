<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
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
        $data = $request->validated();
        
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
