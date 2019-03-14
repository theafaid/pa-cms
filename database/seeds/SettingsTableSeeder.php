<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' => 'pa-cms',
            'site_email' => 'cms@cms.com',
            'site_keywords' => 'cms,news,categories',
            'site_description' => 'PA-CMS is a CMS that created as a task',
            'site_open' => true,
            'site_maintenance_message' => 'Site is offline now please try again later.',
        ]);
    }
}
