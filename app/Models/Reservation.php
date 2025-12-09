<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['room_id', 'guest_name', 'guest_email', 'checkin_date', 'checkout_date', 'reservation_status'];

    public function room()
    {
        return $this->belongsTo(RoomType::class, 'room_id');
    }

    // format tanggal
    public function getFormattedCheckinDateAttribute()
    {
        return date('d M Y', strtotime($this->checkin_date));
    }

    public function getFormattedCheckoutDateAttribute()
    {
        return date('d M Y', strtotime($this->checkout_date));
    }
}
