<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    // Define the table name (if it differs from the default)
    protected $table = 'ticket_type';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'type_name',
    ];

    // You can also define relationships here if necessary
}
