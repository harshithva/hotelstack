<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];
    // protected $dates = ['check_in','check_out'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reservation_rooms() {
        return $this->hasMany(ReservationRoom::class, 'reservation_id');
    }

}
