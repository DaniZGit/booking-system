<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['user_id', 'room_id', 'date_from', 'date_to', 'total_price', 'name', 'email'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
