<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Screener as Scanner;
class Screener extends Model
{
    public function resultCount()
    {
    	$screener = new Scanner($this->query);
    	return $screener->count();
    }
}
