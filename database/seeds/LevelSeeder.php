<?php

use Illuminate\Database\Seeder;
use App\Level;
use Carbon\Carbon;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 50) as $number) {
            Level::create([
                'level' => 'Level '.$number,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
