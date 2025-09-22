<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_types', function (Blueprint $table) {
            $table->id('ID_tip_tour');
            $table->string('tip_tour', 100); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_types');
    }
};