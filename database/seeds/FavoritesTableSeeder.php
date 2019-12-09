<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 10000; $i++) {
            $favorite = factory(App\Favorite::class)->make();
            $count = \App\Favorite::query()->where('user_id', $favorite->user_id)
                ->where('post_id', $favorite->post_id)->count();
            if ($count == 0) {
                $favorite->save();
            }
        }
    }
}
