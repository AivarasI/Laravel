<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::insert([
            ['code'=>'G1', 'name'=>'Programuotojai', 'created_at' => now(), 'updated_at' => now()],
            ['code'=>'G2', 'name'=>'Dizaineriai', 'created_at' => now(), 'updated_at' => now()],
            ['code'=>'G3', 'name'=>'Testuotojai', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}