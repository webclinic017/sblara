<?php 
namespace App\Importers;
use \DB;
class Importer  
{
	public function table($table)
	{
		return DB::table($table);
	}
}