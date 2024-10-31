<?php

namespace App\Repository;
use Exception;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyRepository {

    public function show(int $company_id): Company
    {
        return Company::with(['shops', 'city', 'country'])->find($company_id);

        // $result = \DB::table('companies')
        // ->select(
        //     'companies.*',
        //     'countries.name as country_name', 
        //     'cities.name as city_name'
        // )
        // ->leftJoin('countries', 'companies.country_id', '=', 'countries.id')
        // ->leftJoin('cities', 'companies.city_id', '=', 'cities.id')
        // ->where('companies.id', $user['company_id'])      
        // ->first();
        // $result->shops = json_decode($result->shops);
        // return $result;
    }

    public function store(array $data): Company
    {
        try {
            $company = Company::create( $data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);            
        }
        return $company;
    }

    public function update(int $company_id, array $data): Company
    {
        try {
            Company::where('id', $company_id)
            ->update( $data);
            $company = Company::find($company_id);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw new Exception($th->getMessage(), 500);            
        }
        return $company;
    }

    // public function delete(int $company_id): bool
    // {
    //     try {
    //        $result = Company::where( $company_id)
    //         ->delete();
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         throw new Exception($th->getMessage(), 400);            
    //     }
    //     return $result;
    // }

    public function userCompany(int $user_id): ?\stdClass
    {
        $company = \DB::select("
            SELECT * FROM companies WHERE id = (SELECT company_id FROM users WHERE id = ?)
        ", [$user_id]);
        return count($company) ==  0 ? null : $company[0];
    }

}