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
        DB::table('users')->insert([
            'username' => 'Miyu',
            'mail' => 'MiyuNakayama@lull-inc.com',
            'password' => 'nm19971019',
            'bio' => 'Miyuです。',
        ]);
    }
}
