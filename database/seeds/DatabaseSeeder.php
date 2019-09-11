<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreasTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(VehiclesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
    }
}
