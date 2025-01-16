<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PhonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phones')->insert([
            ['organization_id' => 1, 'phone_number' => '2-222-222', 'created_at' => now(), 'updated_at' => now()],
            ['organization_id' => 1, 'phone_number' => '3-333-333', 'created_at' => now(), 'updated_at' => now()],
            ['organization_id' => 2, 'phone_number' => '8-923-666-13-13', 'created_at' => now(), 'updated_at' => now()],
            ['organization_id' => 3, 'phone_number' => '8-800-555-35-35', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
