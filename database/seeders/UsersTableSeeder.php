<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminpass'),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'member',
                'email' => 'member@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminpass'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        User::insert($data);
    }
}
