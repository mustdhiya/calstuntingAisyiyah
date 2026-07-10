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
        Schema::table('measurements', function (Blueprint $table) {
            $table->string('risk_level')->nullable()->after('status_growth');
        });

        // Sinkronisasi data lama agar tidak tumpang tindih
        DB::table('measurements')->where('status_growth', 'Normal')->update(['risk_level' => 'normal']);
        DB::table('measurements')->where('status_growth', 'Risiko')->update(['risk_level' => 'sedang']);
        DB::table('measurements')->where('status_growth', 'Stunting')->update(['risk_level' => 'tinggi']);
        DB::table('measurements')->where('status_growth', 'Stunting Berat')->update(['risk_level' => 'sangat_tinggi']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('risk_level');
        });
    }
};
