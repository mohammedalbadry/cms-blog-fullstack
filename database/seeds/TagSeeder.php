<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'الاهلى',
            'الزمالك',
            'ليفربول',
            'مانشستر يونايتد',
            'مان يونايتد',
            'مانشستر سيتى',
            'تشيلسى',
            'ارسنال',
            'توتنهام',
            'ريال مدريد',
            'برشلونه',
            'برشلونة',
        ];

        foreach($names as $name){
            $tag = App\Models\Tag::create([
                'name' => $name,
                'slug' => str_replace(" ", "-", $name),
                'description' => 'كل اخبار ' . $name,
            ]);
        }
        
    }
}
