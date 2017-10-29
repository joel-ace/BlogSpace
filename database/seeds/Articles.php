<?php

use Illuminate\Database\Seeder;

class Articles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Article([
            'title' => 'How I became so awesome',
            'content' => 'I became awesome by doing a lot of awesome things',
            'type' => 'post',
            'cat_id' => 1,
            'user_id' => 1,
            'status' => 2,
            'last_modified_by' => 1,
            'slug' => 'how-i-became-awesome'
        ]);
        $post->save();

        $post = new \App\Article([
            'title' => 'A new post',
            'content' => 'A very new post for you my people',
            'type' => 'post',
            'cat_id' => 2,
            'user_id' => 1,
            'status' => 1,
            'last_modified_by' => 1,
            'slug' => 'a-new-post'
        ]);
        $post->save();
    }
}
