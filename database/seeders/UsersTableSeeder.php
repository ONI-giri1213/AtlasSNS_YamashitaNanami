<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'Atlas一郎',
            'email' => 'aaaa@mail.com',
            'password' => '1111',],
            ['username' => 'Atlas二郎',
            'email' => 'bbbb@mail.com',
            'password' => '2222',],
            ['username' => 'Atlas三郎',
            'email' => 'cccc@mail.com',
            'password' => '3333',]
        ]);
    }
}
