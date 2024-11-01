<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
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
}