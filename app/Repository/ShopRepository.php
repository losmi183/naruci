<?php

namespace App\Repository;
use Exception;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;

class ShopRepository {

    public function show(int $shop_id): Shop
    {
        return Shop::with(['city'])->find($shop_id);
    }

    public function store(array $data): Shop
    {
        try {
            $shop = Shop::create( $data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);            
        }
        return $shop;
    }

    public function update(int $shop_id, array $data): Shop
    {
        try {
            Shop::where('id', $shop_id)
            ->update( $data);
            $shop = Shop::find($shop_id);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);            
        }
        return $shop;
    }

    // public function delete(int $shop_id): bool
    // {
    //     try {
    //        $result = Shop::where( $shop_id)
    //         ->delete();
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         throw new Exception($th->getMessage(), 400);            
    //     }
    //     return $result;
    // }

    public function userShop(int $user_id): ?\stdClass
    {
        $Shop = \DB::select("
            SELECT * FROM companies WHERE id = (SELECT Shop_id FROM users WHERE id = ?)
        ", [$user_id]);
        return count($Shop) ==  0 ? null : $Shop[0];
    }

}