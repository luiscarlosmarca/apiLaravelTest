<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //$this->call(CategoryTableSeeder::class);

          factory('App\Category', 5)->create();
          factory('App\Note', 5)->create();
         // $this->call(NoteTableSeeder::class);
    }
}
