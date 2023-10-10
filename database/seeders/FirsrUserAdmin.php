<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FirsrUserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('roles')->insert([
            ['name' => 'manager'],
            ['name' => 'supervisor'],
        ],

        );

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

    }
}
