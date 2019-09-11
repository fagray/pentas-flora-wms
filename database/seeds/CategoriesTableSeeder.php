<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'id'    =>  1,
                'name'  =>  'Category 1'
            ],
            [
                'id'    =>  2,
                'name'  =>  'Category 2'
            ],
            [
                'id'    =>  3,
                'name'  =>  'Category 3'
            ]
        ]);
    }
}
