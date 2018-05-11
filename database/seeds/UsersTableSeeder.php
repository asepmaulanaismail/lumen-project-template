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
        DB::table('bpm_users')->insert([
            'id' => 1,
            'email' => 'admin@bpm.com',
            'password' => sha1('bsp123!!'),
            'name' => "Administrator",
            'isAdmin' => true
        ]);
    }
}
