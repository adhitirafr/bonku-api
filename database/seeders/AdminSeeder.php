<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
    		'name' => 'Admin',
    		'email' => 'admin@bonku.com',
    		'password' => bcrypt('qwerty'),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);
    }
}
