<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = DB::table('users')
            ->insertGetId([
                'name' => 'User USD',
                'email' => 'user.usd@email.com',
                'password' => \Hash::make('123456')
            ]);

        $user2 = DB::table('users')
            ->insertGetId([
                'name' => 'User EUR',
                'email' => 'user.eur@email.com',
                'password' => \Hash::make('123456')
            ]);

        DB::table('wallets')
            ->insert([
                'user_id' => $user1,
                'uid' => uniqid(),
                'currency' => 'USD'
            ]);

        DB::table('wallets')
            ->insert([
                'user_id' => $user2,
                'uid' => uniqid(),
                'currency' => 'EUR'
            ]);
    }
}
