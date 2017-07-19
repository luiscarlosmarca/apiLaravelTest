<?php

use App\Note;
use App\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiNoteTest extends TestCase
{
 
 use DatabaseTransactions;

 function test_list_notes ()

    {
    	$category = factory(Category::class)->create();//crear una categoria
    	
    	$notes = factory(Note::class)->times(2)->create([

    		'category_id' => $category->id,
    		'note'		  => 'Esta es una nota new, que nota'

    	]);

       $this->get('api/v1/notes')
	       	->assertResponseOk()//200 
	       	->seeJsonEquals(Note::all()->toArray());
    }

function test_can_create_a_note()

	 {
	 	$category = factory(Category::class)->create();//creamos categoria, y en esta parte  probamos que el sistema pueda crear una nueva nota.

	 	$this->post('api/v1/notes',[//petición post en esta ruta para crear una nota

	 		'note'  	   => 'this is new a note',
	 		'category_id'  =>  $category->id,

	 		]);

	 	$this->seeInDatabase('notes',[

	 		'note' 			=> 'this is new a note',
	 		'category_id'   => $category->id,

	 	]);//podamos ver en la base de datos el pichu registro

	 	$this->seeJsonEquals([

	 		'success'	=> true, //propiedad, que retorna para saber q todo salio bien
	 		'note'  	=> Note::first()->toArray(),

	 		]);

	 }

 function test_validation_when_creating_a_note()
 	{

	 	$category = factory(Category::class)->create();//creamos una categoria llamando el archivo modelfactory.php

	 	$this->post('api/v1/notes',[//este metodo post, es propio de la prueba para simular un post :v

	 		'note'	=>	'',
	 		'category_id' => '34536'


	 		],['Accept' => 'application/json']); //tercer argumento que especifica el usuo de json

		$this->dontSeeInDatabase('notes',[

			'note' 	 => '',
		

		]);//NO esperamos ver esto en la base de datos

		// $this->seeJsonEquals([
 
		// 	'success'	=> 'false',
		// 	'errors'	=>  [
		// 		'The note field is required.',
		// 		'The selected category id is invalid.',
		// 		]

		// 	]);
 	}


 	function test_can_update_a_note()

	 {
	 	$text = 'update note';

	 	$category = factory(Category::class)->create();
	 	$anotherCategory = factory(Category::class)->create();

	 	$note = factory(Note::class)->make();

	 	$category->notes()->save($note);

	 	$this->put('api/v1/notes/'.$note->id,[
	 		'note'  	   => $text,
	 		'category_id'  => $anotherCategory->id,

	 		]);

	 	$this->seeInDatabase('notes',[

	 		'note' 			=> $text,
	 		'category_id'   => $anotherCategory->id,

	 	]);

	 	$this->seeJsonEquals([

	 		'success'	=> true, 
	 		'note'  	=> [

	 					'id'    	  => $note->id,
	 					'note' 		  => $text,
	 					'category_id' => $anotherCategory->id,
	 			],

	 		]);

	 }


	function test_validation_when_updating_a_note()
 	
 	{
		 	$category = factory(Category::class)->create();

		 	$note = factory(Note::class)->make();

		 	$category->notes()->save($note);

		 	$this->put('api/v1/notes'.$note->id,[

		 		'note'	=>	'',
		 		'category_id' => '34536'


		 		],['Accept' => 'application/json']); 

			$this->dontSeeInDatabase('notes',[

				'id'  => $note->id,
				'note' 	 => '', 
			]);

			 // $this->seeJsonEquals([
	 
			// 	'success'	=> 'false',
			// 	'errors'	=>  [
			// 		'The note field is required.',
			// 		'The selected category id is invalid.',
			// 		]

			// 	]);
 	}

    function test_can_delete_a_note()
    {
    	$note = factory(Note::class)->create();

    	$this->delete('api/v1/notes/'.$note->id,[], ['Accept' =>'application/json']);

    	$this->dontSeeInDatabase('notes',[

    		'id'	=> $note->id

    	]);

    	$this->seeJsonEquals([

    		'success' => true

    	]);

    }

}
