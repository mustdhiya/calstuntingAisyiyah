<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah label status lama agar sesuai dengan format 4 status baru
        DB::table('measurements')->where('status_growth', 'Pendek')->update(['status_growth' => 'Stunting']);
        DB::table('measurements')->where('status_growth', 'Sangat Pendek')->update(['status_growth' => 'Stunting Berat']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke label status lama jika migrasi di-rollback
        DB::table('measurements')->where('status_growth', 'Stunting')->update(['status_growth' => 'Pendek']);
        DB::table('measurements')->where('status_growth', 'Stunting Berat')->update(['status_growth' => 'Sangat Pendek']);
    }
};
