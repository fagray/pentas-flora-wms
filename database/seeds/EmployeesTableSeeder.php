<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = 
            [
                'fname'      =>  'Administrator',
                'lname'      =>  'Administrator',
                'email'     =>  'admin@gmail.com',
                'password'  =>  '123456',
                'role'      =>  'administrator'
            
        ];
        $driver =  [
                'fname'      =>  'Driver',
                'license_no' =>  'Test123456',
                'area_id'    =>  1,  
                'lname'      =>  'Driver',
                'email'     =>  'testdriver@gmail.com',
                'password'  =>  '123456',
                'role'      =>  'driver'
        ];

        Employee::create($admin);
        Employee::create($driver);
    }
}
