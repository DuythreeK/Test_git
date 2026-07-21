<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::factory()->count(10)->create();
        DB::table("users")->insert([
            "name"=> "Tony",
            "email"=> "tony@example.com",
            "password"=> "12345678"
            ]);
    }
}
