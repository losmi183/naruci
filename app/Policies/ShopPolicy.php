<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShopPolicy
{
    public function show($user, int $shop_id)
    {
        // Da li user pripada kompaniji
        if(in_array($shop_id, $user->shop_ids)) {
            return  Response::allow();
        }
        
        return Response::deny(__('auth.user dont have rights to view shop data'));
    }

    public function store($user)
    {
        // Da li user vec ima kompaniju
        if($user->role_id != config('business.roles.owner')) {
            return Response::deny(__('auth.only owner can create shops'));
        }
        if ($user->company_id == null) {
            return Response::deny(__('auth.first create company then shop'));
        }

        return  Response::allow();
    }

    public function update($user, int $shop_id)
    {
        if(!in_array($shop_id, $user->shop_ids)) {
            return  Response::deny(__('auth.only owner can edit shop data'));
        }

        // Da li je user owner kompanije
        if($user->role_id != config('business.roles.owner')) {
            return Response::deny(__('auth.only owner can edit shop data'));
        }
        return  Response::allow();
    }

    public function delete($user, int $shop_id)
    {
        if(!in_array($shop_id, $user->shop_ids)) {
            return  Response::deny(__('auth.only owner can delete shop'));
        }

        // Da li je user owner kompanije
        if($user->role_id != config('business.roles.owner')) {
            return Response::deny(__('auth.only owner can delete shop'));
        }
        return  Response::allow();
    }
}