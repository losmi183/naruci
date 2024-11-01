<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function show($user, int $company_id)
    {
        // Da li user pripada kompaniji
        if($user->company_id != $company_id) {
            return Response::deny(__('auth.user dont have rights to view company data'));
        }

        return  Response::allow();
    }

    public function store($user)
    {
        // Da li user vec ima kompaniju
        if($user->company_id != null) {
            return Response::deny(__('auth.user already has a company'));
        }

        return  Response::allow();
    }

    public function update($user, int $company_id)
    {
        // Da li user pripada kompaniji
        if($user->company_id != $company_id) {
            return Response::deny(__('auth.user dont have rights to edit company data'));
        }

        // Da li je user owner kompanije
        if($user->role_id != config('business.roles.owner')) {
            return Response::deny(__('auth.only owner can edit company data'));
        }
        return  Response::allow();
    }

    public function delete($user, int $company_id)
    {
        // Da li user pripada kompaniji
        if($user->company_id != $company_id) {
            return Response::deny(__('auth.user dont have rights to delete company'));
        }

        // Da li je user owner kompanije
        if($user->role_id != config('business.roles.owner')) {
            return Response::deny(__('auth.only owner can delete company'));
        }
        return  Response::allow();
    }
}