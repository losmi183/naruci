<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Category;
use App\Models\ProductBlueprint;
use App\Models\AdditionBlueprint;
use App\Models\CategoryBlueprint;
use App\Repository\companyRepository;
use App\Repository\ProductRepository;
use App\Repository\AdditionRepository;
use App\Repository\CategoryRepository;

class ClientServices {

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
    public function createCompany(array $data): Company
    {
        return $this->companyRepository->store($data);
    }
    public function initializeClientData(array $data): bool
    {
        foreach ($data['selected_categories'] as $id) {
            $category_blueprint = CategoryBlueprint::find($id);
            $category_blueprint->company_id = $data['company_id'];
            $this->categoryRepository->store($category_blueprint);
        }
        foreach ($data['selected_products'] as $id) {
            $product_blueprint = ProductBlueprint::find($id);
            $product_blueprint->company_id = $data['company_id'];
            $this->productRepository->store($product_blueprint);
        }
        foreach ($data['selected_additions'] as $id) {
            $addition_blueprint = AdditionBlueprint::find($id);
            $addition_blueprint->company_id = $data['company_id'];
            $this->additionRepository->store($addition_blueprint);
        }
        return true;
    }

}