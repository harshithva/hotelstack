<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function reservation() {
        return $this->hasMany(Reservation::class, 'reservation_id');
    }
}
