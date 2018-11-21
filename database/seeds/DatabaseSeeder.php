<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@simple-library.test';
        $admin->password = bcrypt('admin');
        $admin->save();
    }
}
