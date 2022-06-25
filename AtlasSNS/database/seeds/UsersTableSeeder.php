<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //以下を追記
        DB::table('posts')->insert([
            ['username' => 'Miyu'],
            ['password' => 'nm19971019'],
            ['mail' => 'Miyu@lull-inc.com']
        ]);
    }
}
