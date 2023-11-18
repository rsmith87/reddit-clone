<?php

namespace Database\Seeders;

use App\Models\PostStatistics;
use Illuminate\Database\Seeder;

class PostStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostStatistics::factory()->count(10)->createQuietly();
    }
}
