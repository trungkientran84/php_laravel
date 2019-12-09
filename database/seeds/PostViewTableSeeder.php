<?php

use Illuminate\Database\Seeder;

class PostViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PostView::class, 500)->create();
    }
}
