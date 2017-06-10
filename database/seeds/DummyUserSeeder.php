<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'login_id' => 'test',
            'password' => 'test',
        ]);
    }
}
