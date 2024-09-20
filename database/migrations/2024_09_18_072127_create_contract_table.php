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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Reference to users
            $table->foreignId('agent_id')->constrained('agent')->onDelete('cascade'); // Ensure the agents table exists
            $table->foreignId('hotel_service_id')->nullable()->constrained('hotel_service')->onDelete('cascade'); // Link to hotel_service
            $table->foreignId('transport_service_id')->nullable()->constrained('transport_services')->onDelete('cascade'); // Link to transport_services
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
