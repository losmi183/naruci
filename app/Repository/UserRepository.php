<?php

namespace App\Repository;

use App\Models\User;

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
            
            Contract::create([
                'date_from' => $data['date_join'],
                'date_to' => $data['date_to'],
                'user_id' => $user->id
            ]);

            $token = AuthServices::createTokenEmail($data['email']);
            AuthServices::sendEmailRegistration($data, $token);
            

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            abort(response()->json(['errors' => 'User not created'], Response::HTTP_BAD_REQUEST));
        }
        return $user;
    }

}