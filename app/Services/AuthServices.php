<?php

namespace App\Services;

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

    
    // public function register(array $data): User
    // {
    //     return $this->userRepository->store($data);
    // }

    public function login(array $data): \stdClass
    {
        // Find user with email
        $user = $this->userRepository->findByEmail($data['email']);

        // Check password match and set token
        if($user && Hash::check($data['password'], $user->password)) {

            // Set time to live in minutes
            // $ttl = (int) config('settings.JWT2LIVEMIN');
            $pair = $this->jwtService->setPair($user->toArray(), 60);

            $obj = new \stdClass;
            $obj->token = $pair->token;
            $obj->token_ttl_min  = $pair->token_ttl_min;

            return $obj;
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