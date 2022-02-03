<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 80; $i++) {
            $user = App\Models\User::create([
                'name' => 'user ' . $i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => bcrypt(123123),
            ]);
        }


    }
}
