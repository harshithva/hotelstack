<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{

    public function room(){
        return $this->hasMany(Room::class,'floor_id');
    }
}

