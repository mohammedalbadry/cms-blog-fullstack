<?php

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
        $this->call(LaratrustSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AdminSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(TagSeeder::class);
        $this->call(PageSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(PostSeeder::class);
        //$this->call(CommentSeeder::class);
        //$this->call(ReportSeeder::class);
        //$this->call(ViewsCountersSeeder::class);

    }
}
