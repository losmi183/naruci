<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Str;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\UnexpectedValueException;
use Firebase\JWT\SignatureInvalidException;
use Symfony\Component\HttpFoundation\Response;

class JWTServices
{
    private $content = null;
    private $key = null;

    public function __construct()
    {
        $key = env('APP_KEY', "base64:pNRM1hxbl2F78ocAnr+ybyiJ/Wor3HznH+Fb+I5KxEo=");
        // $key = "base64:pNRM1hxbl2F78ocAnr+ybyiJ/Wor3HznH+Fb+I5KxEo=";

        $key = (string) $key;
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $this->key = $key;
    }

    public function setPair(array $user, ?int $ttl=null): \stdClass
    {
        $obj = new \stdClass;
        
        if($ttl) {
            $jwt_time_to_live = $ttl;
        } else {
            // $jwt_time_to_live = config('settings.JWT2LIVEMIN');
            $jwt_time_to_live = config('auth.jwt_token_expiration');
        }
        $obj->token = $this->createJWT($user, $jwt_time_to_live);
        // $jwt_refresh_t2l = config('settings.JWT2RFSHMIN');
        $jwt_refresh_t2l = config('auth.jwt_refresh_token_expiration');
        $obj->refresh_token = $this->createJWT($user, $jwt_refresh_t2l);
        $obj->user = $user;

        return $obj;
    }

    public function decodeJWT($token): int
    {
        $this->content = null;
        try{
            //Algoritam je odredjen ovde pa bi trebalo da zastiti od laznih tokena bez algoritma
            $this->content = (array)JWT::decode($token, new Key($this->key, 'HS256'));
            return Response::HTTP_OK;
        } catch (SignatureInvalidException $e) {
            return Response::HTTP_UNAUTHORIZED;
        } catch (ExpiredException $e) {
            return Response::HTTP_FORBIDDEN;
        } catch (\Exception $e) {
            return Response::HTTP_NOT_ACCEPTABLE;
        }
    }

    public function createJWT(array $userData, float $ttl_minutes): string
    {
        $userData['exp'] = time() + $ttl_minutes * 60;
        $token = JWT::encode($userData, $this->key, 'HS256');
        return $token;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }
}
