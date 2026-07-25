<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clean old data
        Schema::disableForeignKeyConstraints();
        Measurement::truncate();
        Article::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // Run separated seeders in correct order
$this->call([
    UserSeeder::class,
    ArticleSeeder::class,
    MeasurementSeeder::class,
    AdminUserSeeder::class,
    FaqSeeder::class,
]);
    }
}
