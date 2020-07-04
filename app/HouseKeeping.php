<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseKeeping extends Model
{
    public function room() {
        return $this->belongsTo(Room::class, 'room_id','id');
    }
}
