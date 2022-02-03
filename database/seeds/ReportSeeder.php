<?php

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 80; $i++) {

            $comment = App\Models\Report::create([
                'comment_id' => rand(1,80),
                'user_id' => rand(1,80),
                'status' => "جارى الفحص",
                'reason' => "تعليق ساخر",
                'result' => "تم الفحص ولا يوجد اى مخالفه"
            ]);

        }
    }
}
