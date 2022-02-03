<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'اخبار',
            'نتائج',
            'احصائيات',
            'مقالات',
            'الكرة المحلية',
            'الدوريات الاروبية',
            'الكرة الافريقية',
            'الكرة الاروبية',
            
            'الدورى المصرى',
            'دورى ابطال افريقيا',

            'الدورى الانجليزى',
            'الدورى الفرنسي',
            'الدورى الاسبانى',
        ];
        $parent_id = [
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,

            4,
            6,
            5,
            5,
            5
        ];
        foreach($names as $i=>$name){
            $category = App\Models\Category::create([
                'name' => $name,
                'slug' => str_replace(" ", "-", $name),
                'description' => 'هذا القسم مختص فى كلما يتعلق ب' . $name,
                'parent_id' => $parent_id[$i]
            ]);
        }
    }
}
