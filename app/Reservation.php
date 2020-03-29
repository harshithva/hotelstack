<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room_type(){
        return $this->belongsTo(RoomType::class, 'id');
    }
}
