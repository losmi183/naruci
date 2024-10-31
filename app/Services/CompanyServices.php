<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\ProductBlueprint;
use App\Models\AdditionBlueprint;
use App\Models\CategoryBlueprint;
use App\Repository\companyRepository;
use App\Repository\ProductRepository;
use App\Repository\AdditionRepository;
use App\Repository\CategoryRepository;

class CompanyServices {

    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;
    private AdditionRepository $additionRepository;
    private CompanyRepository $companyRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        AdditionRepository $additionRepository,
        CompanyRepository $companyRepository,
    ) 
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->additionRepository = $additionRepository;
        $this->companyRepository = $companyRepository;        
    }

    public function show(array $user): Company
    {
        $company = $this->companyRepository->show($user);

        return $company;    
    }

    public function store(array $user, array $data): Company
    {
        $data['user_id'] = $user['id'];

        if($this->companyRepository->userCompany($user['id'])) {
            abort(400, __("custom.user already has a company"));
        }

        $company = $this->companyRepository->store( $data);
        try {
            User::where('id', $user['id'])
            ->update([
                'company_id' => $company->id,
                'role_id' => config('business.roles.owner'),
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 500);
        }
        return $company;
    }

    public function delete(int $company_id): bool
    {
        return $this->companyRepository->delete($company_id);
    }
}