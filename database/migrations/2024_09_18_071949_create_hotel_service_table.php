<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelServiceTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->onDelete('cascade');
            $table->foreignId('room_type_id')->constrained('room_type')->onDelete('cascade');
            $table->decimal('service_price', 10, 2);
            $table->enum('active', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_service');
    }
}
