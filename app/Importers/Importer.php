<?php 
namespace App\Importers;
use \DB;
class Importer  
{
	public function run($importer, $console)
	{
		$importer = 'App\Importers\\'.ucfirst($importer).'Importer';
		new $importer($console);
	}
}