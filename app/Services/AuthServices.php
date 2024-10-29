<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
    private UserRepository $userRepository;
    private JWTServices $jwtService;

    public function __construct(UserRepository $userRepository, JWTServices $jwtService)
    {
        $this->userRepository = $userRepository;
        $this->jwtService = $jwtService;
    }

    
    public function register(array $data): User
    {
        if(isset($data['business']) && $data['business'] === true) {
            $data['role_id'] = config('business.roles.client');
        }
        return $this->userRepository->store($data);
    }

    public function login(array $data): \stdClass
    {
        // Find user with email
        $user = $this->userRepository->findByEmail($data['email']);

        // Check password match and set token
        if($user && Hash::check($data['password'], $user->password)) {
            $result = $this->jwtService->setPair($user->toArray());
            // $pair->company = $user->company;
            return $result;
        }
        throw new \Exception(__('auth.failed'), 401);
    }

    public function refreshToken(string $refreshToken): \stdClass
    {
        $status =$this->jwtService->decodeJWT($refreshToken);
        if($status) {
            $user = $this->jwtService->getContent();
            $result = $this->jwtService->setPair($user, 60);
            // $pair->company = $user->company;
            return $result;
        }
        throw new \Exception(__('auth.failed'), 401);
    }

    public function whoami(): array
    {
        return $this->jwtService->getContent();
    }
}