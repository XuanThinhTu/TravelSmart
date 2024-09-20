<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportService extends Model
{
    protected $table = 'transport_services';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'ticket_type_id',
        'from_city_id',
        'to_city_id',
        'service_price',
        'active',
    ];

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function toCity()
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }
}
