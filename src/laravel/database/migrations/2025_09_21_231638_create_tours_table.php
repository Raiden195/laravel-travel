<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id('ID_tour');
            $table->string('Name_tour', 200);
            $table->text('Description_tour');
            $table->decimal('price', 10, 2);
            $table->integer('Total_number_of_seats');
            $table->integer('Available_seats');
            $table->string('photo', 255)->nullable();
            $table->decimal('Distance_to_the_beach', 8, 2)->nullable();
            $table->decimal('Distance_to_the_airport', 8, 2)->nullable();
            $table->string('Food', 100)->nullable();
            $table->string('Tour_status', 50)->default('active');
            $table->foreignId('ID_tip_tour')->constrained('tour_types', 'ID_tip_tour');
            $table->foreignId('ID_Country')->constrained('countries', 'ID_Country');
            $table->foreignId('ID_hotel_categories')->constrained('hotel_categories', 'ID_hotel_categories');
            $table->foreignId('ID_city')->constrained('cities', 'ID_city');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};