<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'phone',
        'email',
        'detail',
        'customer_from',
    ];
}
