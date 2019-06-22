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
    
    public function region(){ return $this->belongsTo(Region::class);}
    public function city(){ return $this->belongsTo(City::class);}
    public function address(){ return $this->hasMany(Address::class);}
    public function map(){ return $this->hasMany(Map::class, 'center_id', 'id');}
    
}
