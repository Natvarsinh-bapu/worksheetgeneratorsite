<?php

use Illuminate\Database\Seeder;
use App\Medium;
use Carbon\Carbon;

class MediumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mediums = ['Gujarati', 'Hindi', 'English'];

        foreach ($mediums as $medium) {
            Medium::create([
                'medium' => $medium,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
