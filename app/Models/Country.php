<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country'; 

    protected $primaryKey = 'id'; 

    public $incrementing = true; 

    protected $fillable = [
        'country_code',
        'country_name',
    ];

}
