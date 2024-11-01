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

    public function show(int $company_id): Company
    {   
        $company = $this->companyRepository->show( $company_id);

        return $company;    
    }

    public function store(int $user_id, array $data): Company
    {
        $company = $this->companyRepository->store( $data);
        try {
            User::where('id', $user_id)
            ->update([
                'company_id' => $company->id,
                'role_id' => config('business.roles.owner'),
            ]);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 500);
        }
        return $company;
    }

    public function update(int $company_id, array $data): Company
    {
        $company = $this->companyRepository->update($company_id, $data);     
        return $company;
    }
}