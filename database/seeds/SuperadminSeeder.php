<?php

use Illuminate\Database\Seeder;
use App\Superadmin;
use Carbon\Carbon;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Superadmin::create([
            'name' => 'Super admin',
            'email' => 'worksheetadmin@gmail.com',
            'password' => bcrypt('worksheet@123#admin'), 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
