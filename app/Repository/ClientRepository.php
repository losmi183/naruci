<?php

namespace App\Repository;
use Exception;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class ClientRepository {

    public function store(array $data): Company
    {
        try {
            $company = Company::create($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);            
        }
        return $company;
    }

}