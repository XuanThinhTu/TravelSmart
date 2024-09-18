<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTable extends Migration
{
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->id();
            $table->string('city_name', 255);
            $table->foreignId('country_id')->constrained('country')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('city');
    }
}
