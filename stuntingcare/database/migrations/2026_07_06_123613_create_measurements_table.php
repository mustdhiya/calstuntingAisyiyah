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
        Schema::create('measurements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('child_name')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->integer('age_months');
            $table->date('birth_date')->nullable();
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->string('status_growth');
            $table->string('city')->nullable();
            $table->enum('asi_eksklusif', ['Ya', 'Tidak'])->default('Ya');
            $table->foreignUuid('kader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
