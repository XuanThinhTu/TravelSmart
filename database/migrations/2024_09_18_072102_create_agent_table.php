<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTable extends Migration
{
    public function up()
    {
        Schema::create('agent', function (Blueprint $table) {
            $table->id();
            $table->string('agent_code', 45);
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->enum('active', ['Working', 'Retired']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent');
    }
}
