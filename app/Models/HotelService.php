<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $table = 'hotel_service';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'service_price',
        'active',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
