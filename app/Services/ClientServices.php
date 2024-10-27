<?php

namespace App\Services;

use App\Models\Company;
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

}