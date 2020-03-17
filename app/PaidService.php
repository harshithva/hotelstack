<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidService extends Model
{
    protected $fillable = [
        'title','price','short_desc','status'
    ];
}
