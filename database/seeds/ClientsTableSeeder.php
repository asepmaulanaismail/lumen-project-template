<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bpm_clients')->insert([
            'id' => 1,
            'email' => 'client@bpm.com',
            'password' => sha1('bsp123!!'),
            'name' => "Client",
            'user_id' => 1
        ]);
    }
}
