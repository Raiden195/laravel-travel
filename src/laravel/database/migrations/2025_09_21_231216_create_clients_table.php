<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('ID_client');
            $table->string('phone_number', 20);
            $table->string('email', 100)->unique();
            $table->date('registration_date');
            $table->unsignedBigInteger('ID_personnel')->nullable()->constrained('personnel');   
            $table->string('login', 50)->unique();
            $table->string('password');
            $table->foreignId('ID_role')->constrained('roles', 'ID_role');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};