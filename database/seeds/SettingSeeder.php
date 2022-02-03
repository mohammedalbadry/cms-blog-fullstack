<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = App\Models\Setting::create([
            'name' => "site name",
            'logo' => 'default.png',
            'icon' => 'default.png',
            'description' => 'test',
            'status' => 'open',
            'alt_text' => 'test',
        ]);
    }
}
