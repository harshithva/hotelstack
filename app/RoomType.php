<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
   
    public function floor(){
        return $this->belongsTo(Floor::class,'floor_id');
    }

    public function rooms() {
        return $this->hasMany(Room::class, 'room_type_id');
    }

}
