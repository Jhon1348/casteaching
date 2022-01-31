<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        create_default_user();

        create_superadmin_user();

        create_regular_user();

        create_video_manager_user();

        create_user_manager_user();

        create_default_videos();

        create_sample_videos();

        create_permissions();

        create_sample_series();

    }
}
