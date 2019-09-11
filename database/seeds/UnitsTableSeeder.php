<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::insert([
            [
                'name'      =>  'Metric Tons',
                'symbol'      =>  'M/T',
            ],
            [
                'name'      =>  'Liters',
                'symbol'      =>  'L',
            ],
            [
                'name'      =>  'Kilograms',
                'symbol'      =>  'KGS',
            ]
        ]);
    }
}
