<?php

namespace Database\Seeders;

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
        for ($i = 1; $i <= \App\Models\User::all('id')->max()->id; $i++) {
            \App\Models\Post::factory(rand(1,5))->create(["user_id"=>$i]);
          }
        
    }
}
