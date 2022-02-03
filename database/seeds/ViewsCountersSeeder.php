<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ViewsCountersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 1000; $i++) {
            $view = App\Models\ViewsCounters::create([
                'post_id' => rand(1,100),
                'view_name' => 'post',
                'views' => rand(1,100),
                'created_at' =>  Carbon::create(2021, 06, rand(1,30), 0, 0, 0, 'GMT')

            ]);
        }        
    }
}
