<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'hotel_name',
        'city_id',
        'hotel_address',
        'details',
        'status',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
