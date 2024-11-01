<?php

namespace App\Services;

use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\ProductBlueprint;
use App\Models\AdditionBlueprint;
use App\Models\CategoryBlueprint;
use App\Repository\UserRepository;
use App\Repository\companyRepository;
use App\Repository\ProductRepository;
use App\Repository\AdditionRepository;
use App\Repository\CategoryRepository;

class UserServices {

    private UserRepository $userRepository;
    private JWTServices $jwtService;

    public function __construct(UserRepository $userRepository, JWTServices $jwtService)  
    {
        $this->userRepository = $userRepository;
        $this->jwtService = $jwtService;
    }

    public function getUser(): ?array   
    {
        $user = $this->jwtService->getContent();
        return $user;
    }
    public function userWithCompany(): ?\stdClass   
    {
        $userToken = $this->jwtService->getContent();
        $user = \DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'role_id',
                'companies.name as company_name',            
                'companies.id as company_id',
                \DB::raw("JSON_ARRAYAGG(shops.id) as shop_ids") // Ispravi ovde
            )
            ->leftJoin('companies', 'users.company_id', '=', 'companies.id')
            ->leftJoin('shops', 'companies.id', '=', 'shops.company_id')
            ->where('users.id', $userToken['id'])
            ->groupBy('users.id', 'users.name', 'users.email', 'role_id', 'companies.name', 'companies.id')
            ->first();
        
        $user->shop_ids = json_decode($user->shop_ids);

        return $user;
    }
}