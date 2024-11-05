<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Policies\ShopPolicy;
use App\Services\ShopServices;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClientStoreShopRequest;
use App\Http\Requests\ClientUpdateShopRequest;

class ShopController extends Controller
{
    private ShopServices $shopServices;
    private UserServices $userServices;
    private $user;
    private $user_company;
    private ShopPolicy $shopPolicy;
    public function __construct(ShopServices $shopServices, UserServices $userServices, ShopPolicy $shopPolicy)
    {
        $this->shopServices = $shopServices;
        $this->userServices = $userServices;
        $this->shopPolicy = $shopPolicy;
        $this->user = $this->userServices->userWithCompany();
    }

    public function show($shop_id): JsonResponse
    {
        $authorizationResponse = $this->shopPolicy->show($this->user, $shop_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $result = $this->shopServices->show(intval($shop_id));
            return response()->json($result , 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }

    public function store(ClientStoreShopRequest $request): JsonResponse
    {
        $data = $request->validated();

        $authorizationResponse = $this->shopPolicy->store($this->user);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $data['company_id'] = $this->user->company_id;
            $result = $this->shopServices->store($data);
            return response()->json($result , 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }

    public function update(ClientUpdateShopRequest $request, $shop_id): JsonResponse
    {
        $data = $request->validated();

        $authorizationResponse = $this->shopPolicy->update($this->user, $shop_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            $result = $this->shopServices->update(intval($shop_id), $data);
            return response()->json($result , 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }

    public function delete($shop_id): JsonResponse
    {        
        $authorizationResponse = $this->shopPolicy->delete($this->user, $shop_id);
        if ($authorizationResponse->denied()) {
            return response()->json(['error' => $authorizationResponse->message()], 403);
        }

        try {
            Shop::where('id', $shop_id)->delete();
            // $result = $this->companyServices->delete(intval($shop_id));
            return response()->json(__('custom.shop deleted') , 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ] ,  $e->getCode() ?: 500);
        }
    }
}
