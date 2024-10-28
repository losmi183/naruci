<?php

namespace App\Repository;
use Exception;
use App\Models\Product;
use App\Models\ProductBlueprint;
use Illuminate\Support\Facades\Log;

class ProductRepository {

    public function create(ProductBlueprint $data): Product
    {
        try {
            $product = Product::create($data->toArray());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);
        }
        return $product;
    }

}