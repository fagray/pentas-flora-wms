<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::insert([
            [
                'id'    =>  1,
                'name'  =>  'Subcategory 1',
                'category_id'   => 1
            ],
            [
                'id'    =>  2,
                'name'  =>  'Category 2',
                'category_id'   => 2
            ],
            [
                'id'    =>  3,
                'name'  =>  'Category 3',
                'category_id'   => 3
            ]
        ]);
    }
}
