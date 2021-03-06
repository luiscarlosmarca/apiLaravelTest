<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\validator;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;



      /**
     * Format the validation errors to be returned.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function  formatValidationErrors(Validator $validator)
    {
        return [
        	'errors' => $validator->errors()->all(),
        	'success' =>  false, 
        	];
    }//para que el mensaje del error devuelva un json
}
