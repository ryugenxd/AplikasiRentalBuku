<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        User::create([
            "username"=>"ryugen",
            "password"=>bcrypt("12345678"),
            "address"=>"tokoh buku",
            "status"=>"active",
            "role_id"=>1,
        ]);
        User::create([
            "username"=>"yahhoo",
            "password"=>bcrypt("12345678"),
            "address"=>"test alamat",
            "status"=>"inactive",
            "role_id"=>2,
        ]);
        User::create([
            "username"=>"gen",
            "password"=>bcrypt("12345678"),
            "address"=>"test alamat horee",
            "status"=>"active",
            "role_id"=>2,
        ]);
    }
}
