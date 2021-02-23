<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=\App\Models\Admin::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('123456789'),
        ]);
    }
}
