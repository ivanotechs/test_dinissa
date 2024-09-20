<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        for($i = 0; $i <10; $i++){
            User::create([
                'name' => 'User'.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => 'password',
                'account_number' => 'BANK 2024'.$i,
                'balance' => 10000 + $i*10000,
                'account_id' => 1,
            ]  
            );
        }

        for($i = 0; $i <4; $i++){
            Account::create([
                'name' => 'Premium '.$i +1,
                'minimum_amount' => 200+$i*2500,
                'maximum_amount' => 200+$i*75000
            ]  
            );
        }
    }
}
