<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Changed to user_id
            $table->foreignId('agent_id')->constrained('agent')->onDelete('cascade'); // Ensure the agents table exists
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
        Schema::dropIfExists('contracts'); // Match the table name here
    }
}
