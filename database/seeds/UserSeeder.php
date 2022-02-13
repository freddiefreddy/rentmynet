<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
            'name'=>'Admin user',
            'email'=>'admin@gmail.com',
            'password' => Hash::make(123456)  
            ]

        ];
        DB::table('users')->insert($users);
    }
}
