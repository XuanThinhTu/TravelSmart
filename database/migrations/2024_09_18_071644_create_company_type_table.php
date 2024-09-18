<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTypeTable extends Migration
{
    public function up()
    {
        Schema::create('company_type', function (Blueprint $table) {
            $table->id();
            $table->string('type_name', 64);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_type');
    }
}
