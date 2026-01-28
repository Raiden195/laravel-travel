<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_categories', function (Blueprint $table) {
            $table->id('ID_hotel_categories');
            $table->string('hotel_categories', 50); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_categories');
    }
};
