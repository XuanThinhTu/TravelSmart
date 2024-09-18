<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypeTable extends Migration
{
    public function up()
    {
        Schema::create('room_type', function (Blueprint $table) {
            $table->id();
            $table->string('type_name', 64);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_type');
    }
}
