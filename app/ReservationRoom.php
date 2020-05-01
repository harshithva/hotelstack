<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationRoom extends Model
{
    protected $guarded = [];

    // protected $dates = ['check_in','check_out'];

    public function reservation_rooms() {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    public function room() {
        return $this->hasOne(Room::class, 'room_id');
    }
}
