<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 80; $i++) { 
            $post = [
                'title' => 'عنوان مقال تجريبي ' . $i,
                'image' => "https://picsum.photos/id/".$i . '/200/300',
                'body' => '
                
                    <div class="test">
                        <h1 class="h1">هنا بعض العناوين التجريبيه </h1>
                        <h2 class="h2">هنا بعض العناوين التجريبيه </h2>
                        <h3 class="h3">هنا بعض العناوين التجريبيه </h3>
                        <h4 class="h4">هنا بعض العناوين التجريبيه </h4>
                        <h5 class="h5">هنا بعض العناوين التجريبيه </h5>
                        <h6 class="h6">هنا بعض العناوين التجريبيه </h6>

                        <p>هنا بعض النصوص  التجربيه</p>

                        <ul>
                            <li>اختيار واحد</li>
                            <li>اختيار اتنين</li>
                            <li>اختيار تلاته</li>
                        </ul>

                        <a href="#">رابط</a>
                    </div>
                
                ',
                'excerpt' => 'نبذه عن المقال',
                'admin_id' => 1,
                'views' => rand(1,10000)

            ];
            $post['slug'] = str_replace(" ", "-", $post['title']);
    
            $thepost = App\Models\Post::create($post);
            $model =  App\Models\Post::find($thepost->id);
    
            $model->tags()->attach(rand(1,12));
            $model->categories()->attach(rand(1,13));
        }

    }
}
