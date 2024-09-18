<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportServicesTable extends Migration
{
    public function up()
    {
        Schema::create('transport_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_type_id')->constrained('ticket_type')->onDelete('cascade');
            $table->foreignId('from_city_id')->constrained('city')->onDelete('cascade');
            $table->foreignId('to_city_id')->constrained('city')->onDelete('cascade');
            $table->decimal('service_price', 10, 2);
            $table->enum('active', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transport_services');
    }
}
