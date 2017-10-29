<?php

use Illuminate\Database\Seeder;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Category([
            'cat_title' => 'News Update',
            'slug' => 'news-update'
        ]);
        $post->save();

        $post = new \App\Category([
            'cat_title' => 'Blog Articles',
            'slug' => 'blog-articles'
        ]);
        $post->save();
    }
}
