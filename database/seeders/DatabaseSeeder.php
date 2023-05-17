<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
        [
            'id' => 1,
            'name' => 'CodeLean',
            'email' => 'CodeLean@gmail.com',
            'password' => Hash::make('123456'),
            'avatar' => 'avatar-0.png',
            'level' => 2,
            'description' => 'Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in ',
            'company_name' =>'MLA',
            'country' =>'Viet Nam',
            'street_address' =>'Vĩnh Khúc Văn Giang Hưng Yên',
            'postcode_zip' =>'10000',
            'town_city' =>'Hưng Yên',
            'phone' =>'0376697126',
        ],
    ]);
    }
}

