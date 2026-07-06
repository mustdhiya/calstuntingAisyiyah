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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('author_name');
            $table->date('published_date')->nullable();
            $table->integer('read_time')->default(3);
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->text('references')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('shares')->default(0);
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
