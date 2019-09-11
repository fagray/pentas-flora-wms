<?php

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'plate_no'  =>  'BAD1023',
            'name'      =>  'Lorry 1'
        ]);
    }
}
