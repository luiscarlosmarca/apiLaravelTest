<?php

use Illuminate\Database\Seeder;
Use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        Category::create('name'=>'Laravel');
        Category::create('name'=>'Vue js'); 
           
    }
}
