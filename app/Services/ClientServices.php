<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Category;
use App\Models\CategoryBlueprint;
use App\Repository\ClientRepository;

class ClientServices {

    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository) {
        $this->clientRepository = $clientRepository;        
    }
    public function register(array $data): Company
    {
        return $this->clientRepository->create($data);
    }
    public function initializeClientData(array $data)
    {
        foreach ($data['selected_categories'] as $id) {
            $category_blueprint = CategoryBlueprint::find($id);
            Category::create([
                // 'company_id' => $data['company_id'],
                'name' => $category_blueprint->name,
                'description' => $category_blueprint->description,
            ]);            
        }
    }

}