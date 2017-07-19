<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Note;

class Category extends Model
{
    public function notes()
    {  
    	return $this->hasMany(Note::class);
    }
}
