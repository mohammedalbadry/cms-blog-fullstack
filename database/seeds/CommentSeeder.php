<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=0; $i < 80; $i++) {

            $comment = App\Models\Comment::create([
                'post_id' => rand(1,80),
                'user_id' => rand(1,80),
                'approval' => 1,
                'body' => "تعليق  تجريبي " . $i,
                'parent_id' => 0
            ]);

        }


    }
}
