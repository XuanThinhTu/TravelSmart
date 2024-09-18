<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade');
            $table->foreignId('agent_id')->constrained('agent')->onDelete('cascade');
            $table->timestamp('time_signed')->useCurrent();
            $table->decimal('total_price', 10, 2);
            $table->date('payment_date');
            $table->enum('paid_status', ['Paid', 'Not Paid']);
            $table->timestamp('payment_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
