<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'first_name' => Str::random('10'),
                'last_name' => Str::random('10'),
                'email' => 'sample@gmail.com',
                'birthdate' => Date::now(),
                'password' => Hash::make('sample'),
            ],
            [
                'first_name' => Str::random('10'),
                'last_name' => Str::random('10'),
                'email' => 'test@gmail.com',
                'birthdate' => Date::now(),
                'password' => Hash::make('test'),
            ]
        ]);
    }
}
