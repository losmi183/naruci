<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Category;
use App\Models\ProductBlueprint;
use App\Models\AdditionBlueprint;
use App\Models\CategoryBlueprint;
use App\Repository\ClientRepository;
use App\Repository\ProductRepository;
use App\Repository\AdditionRepository;
use App\Repository\CategoryRepository;

class ClientServices {

    private CategoryRepository $categoryRepository;
    private ProductRepository $productRepository;
    private AdditionRepository $additionRepository;
    private ClientRepository $clientRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        AdditionRepository $additionRepository,
        ClientRepository $clientRepository) 
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->additionRepository = $additionRepository;
        $this->clientRepository = $clientRepository;        
    }
    public function register(array $data): Company
    {
        return $this->clientRepository->create($data);
    }
    public function initializeClientData(array $data): bool
    {
        foreach ($data['selected_categories'] as $id) {
            $category_blueprint = CategoryBlueprint::find($id);
            $category_blueprint->company_id = $data['company_id'];
            $this->categoryRepository->create($category_blueprint);
        }
        foreach ($data['selected_products'] as $id) {
            $product_blueprint = ProductBlueprint::find($id);
            $product_blueprint->company_id = $data['company_id'];
            $this->productRepository->create($product_blueprint);
        }
        foreach ($data['selected_additions'] as $id) {
            $addition_blueprint = AdditionBlueprint::find($id);
            $addition_blueprint->company_id = $data['company_id'];
            $this->additionRepository->create($addition_blueprint);
        }
        return true;
    }

}