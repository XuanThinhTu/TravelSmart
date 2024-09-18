<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contract';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'customer_id',
        'agent_id',
        'time_signed',
        'total_price',
        'payment_date',
        'paid_status',
        'payment_time',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
