<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrganizationActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organization_activity')->insert([
            ['organization_id' => 1, 'activity_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Рога и Копыта -> Мясная продукция
            ['organization_id' => 1, 'activity_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Рога и Копыта -> Молочная продукция
            ['organization_id' => 2, 'activity_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Иванов -> Грузовые автомобили
            ['organization_id' => 3, 'activity_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Продукты Сибири -> Еда
        ]);
    }
}
