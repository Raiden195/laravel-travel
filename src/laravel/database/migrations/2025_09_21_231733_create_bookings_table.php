<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('ID_booking');
            $table->integer('quantity_people');
            $table->date('booking_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('booking_number', 50)->unique();
            $table->foreignId('ID_client')->constrained('clients', 'ID_client');
            $table->foreignId('ID_our')->constrained('tours', 'ID_tour');
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};