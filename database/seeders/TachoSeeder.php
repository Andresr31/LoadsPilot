<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tacho;

class TachoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tacho = new Tacho;
        $tacho->number = 1;
        $tacho->description = 'Tacho #1';
        $tacho->save();

        $tacho = new Tacho;
        $tacho->number = 2;
        $tacho->description = 'Tacho #2';
        $tacho->save();
    }
}
