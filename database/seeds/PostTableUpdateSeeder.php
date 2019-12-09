<?php

use App\Rating;
use Illuminate\Database\Seeder;

class PostTableUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::all()->each(
            function ($post) {
                $post->total_comments = \App\Comment::where('post_id', $post->id)->count();
                $post->total_views = \App\PostView::where('post_id', $post->id)->count();
                $post->total_ratings= \App\Rating::where('post_id', $post->id)->count();
                $post->avg_rating = \App\Rating::where('post_id', 1)->avg('rating');
                $post->save();
            }
        );
    }
}
