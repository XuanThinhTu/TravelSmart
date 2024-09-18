<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 8);
            $table->string('country_name', 64);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('country');
    }
}
