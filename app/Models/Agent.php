<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agent';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'agent_code',
        'first_name',
        'last_name',
        'active',
    ];
}
