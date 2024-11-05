<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
use App\Services\UserServices;
use App\Policies\CompanyPolicy;
use App\Services\CompanyServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientStoreCompanyRequest;
use App\Http\Requests\ClientUpdateCompanyRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    private CompanyServices $companyServices;
    private UserServices $userServices;
    private $user;
    private CompanyPolicy $companyPolicy;
    public function __construct(CompanyServices $companyServices, UserServices $userServices, CompanyPolicy $companyPolicy)
    {
        $this->companyServices = $companyServices;
        $this->userServices = $userServices;
        $this->companyPolicy = $companyPolicy;
        $this->user = $this->userServices->userWithCompany();
    }

    public function show($company_id): JsonResponse
    {
        $authorizationResponse = $this->companyPolicy->show( $this->user, $company_id);
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

        $authorizationResponse = $this->companyPolicy->store($this->user);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $result = $this->companyServices->store( intval($this->user->id), $data);
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
        
        $authorizationResponse = $this->companyPolicy->update($this->user, $company_id);
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
        $authorizationResponse = $this->companyPolicy->delete($this->user, $company_id);
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
