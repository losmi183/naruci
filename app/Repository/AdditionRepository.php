<?php

namespace App\Repository;
use Exception;
use App\Models\Addition;
use App\Models\AdditionBlueprint;
use Illuminate\Support\Facades\Log;

class AdditionRepository {

    public function create(AdditionBlueprint $data): Addition
    {
        try {
            $addition = Addition::create($data->toArray());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);
        }
        return $addition;
    }

}