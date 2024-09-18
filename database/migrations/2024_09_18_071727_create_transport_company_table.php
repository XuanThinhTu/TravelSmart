<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('transport_company', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 255);
            $table->foreignId('city_id')->constrained('city')->onDelete('cascade');
            $table->string('HQ_address', 255);
            $table->foreignId('company_type_id')->constrained('company_type')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->enum('active', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transport_company');
    }
}
