<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\User([
            'name' => 'Joel',
            'username' => 'joel',
            'email' => 'joel@local.com',
            'password' => bcrypt('password'),
        ]);
        $post->save();

        $post = new \App\User([
            'name' => 'Jame Arthur',
            'username' => 'james',
            'email' => 'joel@localhost.com',
            'password' => bcrypt('password'),
        ]);
        $post->save();
    }
}
