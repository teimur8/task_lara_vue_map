<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = 'centers';
    protected $fillable = [
        'center_name'
        , 'phone'
        , 'region_id'
        , 'city_id'
        , 'okrug'
        , 'big'
        , 'email'
        , 'devices'
        , 'shifts'
    ];
}
