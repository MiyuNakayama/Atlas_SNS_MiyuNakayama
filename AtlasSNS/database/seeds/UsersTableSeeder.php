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
            ['ID' => ''],
            ['username' => 'Miyu'],
            ['mail' => 'Miyu@lull-inc.com'],
            ['password' => 'nm19971019'],
            ['bio' => ''],
            ['images' => ''],
            ['created_at' => ''],
            ['update_at' => '']
        ]);
    }
}
