<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table = 'maps';
    public $timestamps = false;

    protected $fillable = ['center_id','latitude', 'longitude', 'capacity', 'zoom'];
}
