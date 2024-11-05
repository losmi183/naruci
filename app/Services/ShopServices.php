<?php

namespace App\Services;

use Exception;
use App\Models\Shop;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\ProductBlueprint;
use App\Models\AdditionBlueprint;
use App\Models\CategoryBlueprint;
use App\Repository\ShopRepository;
use App\Repository\companyRepository;
use App\Repository\ProductRepository;
use App\Repository\AdditionRepository;
use App\Repository\CategoryRepository;

class ShopServices {

    private CategoryRepository $categoryRepository;
    private ShopRepository $shopRepository;
    private ProductRepository $productRepository;
    private AdditionRepository $additionRepository;
    private CompanyRepository $companyRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ShopRepository $shopRepository,
        ProductRepository $productRepository,
        AdditionRepository $additionRepository,
        CompanyRepository $companyRepository,
    ) 
    {
        $this->categoryRepository = $categoryRepository;
        $this->shopRepository = $shopRepository;
        $this->productRepository = $productRepository;
        $this->additionRepository = $additionRepository;
        $this->companyRepository = $companyRepository;        
    }

    public function show(int $shop_id): Shop
    {   
        $shop = $this->shopRepository->show( $shop_id);

        return $shop;    
    }

    public function store(array $data): Shop
    {
        $shop = $this->shopRepository->store( $data);
        try {
            $shop = Shop::create($data);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 500);
        }
        return $shop;
    }

    public function update(int $shop_id, array $data): Shop
    {
        $shop = $this->shopRepository->update($shop_id, $data,);
        try {
            $shop = Shop::find($shop_id);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 500);
        }
        return $shop;
    }
}