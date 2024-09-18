<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_type';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'type_name',
    ];
}
