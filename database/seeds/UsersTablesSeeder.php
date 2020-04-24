<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Camilus',
            'email'    => 'camiya@gmail.com',
            'password'   =>  Hash::make('password'),
            'remember_token' =>  Str::random(10),
        ]);
    }
}
