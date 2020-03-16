<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'number','image','status','floor_id','room_type_id'
    ];

    public function floor() {
        return $this->belongsTo('App\Floor');
    }

    public function type(){
        return $this->belongsTo(RoomType::class,'room_type_id');
    }
}
