<?php

namespace App\Repository;
use Exception;
use App\Models\Category;
use App\Models\CategoryBlueprint;
use Illuminate\Support\Facades\Log;

class CategoryRepository {

    public function create(CategoryBlueprint $data): Category
    {
        try {
            $category = Category::create($data->toArray());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);
        }
        return $category;
    }

}