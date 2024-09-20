<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket_type';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'type_name',
    ];
}
