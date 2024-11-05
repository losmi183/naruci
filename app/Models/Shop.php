<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class)->select('id', 'name');
    }
}
