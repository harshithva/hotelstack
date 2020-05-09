<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidService extends Model
{
    protected $fillable = [
        'title','price','short_desc','status'
    ];

    public function paid_service() {
        return $this->hasMany(Service::class, 'paid_service_id');
    }
}
