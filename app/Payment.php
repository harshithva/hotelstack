<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['reservation_id', 'amount','method','transaction_id'];
}
