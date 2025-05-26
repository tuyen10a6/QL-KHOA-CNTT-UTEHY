<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vai_tro')->insert([
            ['ten_vai_tro' => 'admin', 'quyen' => 'all'],
            ['ten_vai_tro' => 'subAdmin', 'quyen' => 'manage'],
            ['ten_vai_tro' => 'lecturer', 'quyen' => 'teach'],
            ['ten_vai_tro' => 'student', 'quyen' => 'learn'],
        ]);
    }
}
