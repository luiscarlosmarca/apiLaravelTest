<?php

use Illuminate\Database\Seeder;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//creater notas automaticamente
        $categories = Category::all();

        $notes = factory(Note::class)->times(20)->make();

        foreach ($notes as $note) {

        	$category = categories->random();//agrege una nota aleatoria
        	

        	$category->notes()->save($note);
        }
    }
}