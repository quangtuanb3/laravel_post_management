<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            ['name' => 'QA'],
            ['name' => 'QC'],
            ['name' => 'DEV'],
            ['name' => 'DESIGNER'],
            ['name' => 'OTHER'],
        ]);
    }
}
