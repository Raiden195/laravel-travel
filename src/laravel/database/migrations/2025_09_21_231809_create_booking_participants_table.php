<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_participants', function (Blueprint $table) {
            $table->id('ID_booking_participant');
            $table->foreignId('ID_personnel')->constrained('personnel', 'ID_personnel');
            $table->foreignId('ID_booking')->constrained('bookings', 'ID_booking');
            $table->string('status', 50)->default('confirmed');
            $table->timestamps();
           
            $table->unique(['ID_personnel', 'ID_booking']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_participants');
    }
};