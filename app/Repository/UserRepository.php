<?php

namespace App\Repository;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    public function findByEmail(string $email): ?User
    {
        $user = User::where('email', $email)
        ->first();

        return $user;
    }

    public function store(array $data): User
    {
        try {
            $user = User::create($data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception("Error on creating user", 500);            
        }
        return $user;
    }

}