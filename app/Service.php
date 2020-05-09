<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function service() {
        return $this->belongsTo(Reservation::class, 'id');
    }

    public function paid_service() {
        return $this->belongsTo(PaidService::class, 'id');
    }
}
