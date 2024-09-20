<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_type';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'type_name',
    ];
}
