<?php

namespace App\Services;

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
}