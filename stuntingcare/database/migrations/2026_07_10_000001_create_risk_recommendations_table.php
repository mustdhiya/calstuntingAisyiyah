<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('risk_recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('status_key')->unique();
            $table->string('status_label');
            $table->json('factors')->nullable();
            $table->json('recommendations')->nullable();
            $table->text('custom_note')->nullable();
            $table->unsignedTinyInteger('score')->nullable(); // Ditambahkan langsung di sini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_recommendations');
    }
};
