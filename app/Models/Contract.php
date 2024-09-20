<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts'; // Make sure this matches the database table name
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'user_id', // Changed from customer_id to user_id
        'agent_id',
        'hotel_service_id', // Include hotel_service_id
        'transport_service_id', // Include transport_service_id
        'time_signed',
        'total_price',
        'payment_date',
        'paid_status',
        'payment_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Ensure you have a User model
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function hotelService()
    {
        return $this->belongsTo(HotelService::class, 'hotel_service_id');
    }

    public function transportService()
    {
        return $this->belongsTo(TransportService::class, 'transport_service_id');
    }
}
