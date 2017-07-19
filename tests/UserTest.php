<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

	use DatabaseTransactions;
   
    function testExample()
    {
    	//pasa algo y no se crea. lo hice manualmente y funciona la priueba.
    	factory(\App\User::class)->create(['name'=>'luis']);//con este factory voy a crear el nuevo usuario "luis"
        $this->get('name')//llamar la url name
        	 ->assertResponseOk();//pagina carga bien
        $this->seeText('luis');//esta pagina muestra este nombre
    }
}
