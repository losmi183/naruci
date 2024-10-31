<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = ['id'];

    public function shops()
    {
        return $this->hasMany(Shop::class, 'company_id', 'id')
        ->select('id', 'name', 'company_id', 'city_id', 'address');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->select('id', 'name');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')->select('id', 'name');
    }
}
