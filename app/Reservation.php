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

    public function reservation_room() {
        return $this->hasMany(ReservationRoom::class, 'reservation_id');
    }

    public function payment() {
        return $this->hasMany(Payment::class, 'reservation_id','id');
    }

    public function service() {
        return $this->hasMany(Service::class, 'reservation_id','id');
    }

    public function invoice() {
        return $this->hasOne(Invoice::class, 'checkin_id','id')->latest();
    }
}
