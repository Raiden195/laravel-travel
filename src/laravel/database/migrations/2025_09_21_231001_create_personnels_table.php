<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personnel', function (Blueprint $table) {
            $table->id('ID_personnel');
            $table->string('passport_series', 10);
            $table->string('passport_number', 20);
            $table->date('passport_issue_date');
            $table->string('passport_issued_who', 200);
            $table->string('FIO', 200); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
};