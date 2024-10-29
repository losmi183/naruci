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

            $pair = $this->jwtService->setPair($user->toArray());
            return $pair;
        }

        abort(response()->json(['errors' => __('auth.failed')], 401));
    }

    public function whoami(): User
    {
        $user = $this->userService->loggedUser();
        //$user->pusher = $this->pusherServices->clientConfig($user);
        return $user;
    }

    public function refresh(): \stdClass
    {
        $user = $this->jwtService->getContent();

        return $this->jwtService->setPair($user, 60);
    }
}