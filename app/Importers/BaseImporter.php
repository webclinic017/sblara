<?php 
namespace App\Importers;
use Illuminate\Console\Command;
use \DB;
class BaseImporter  
{
	/* old database connection*/
	protected $oldDB = 'old';
	public $console;
	function __construct($console)
	{
		$this->console = $console;
		$this->handle();
	}

	public function table($table)
	{
		return DB::table($table);
	}


	public function oldTable($table)
	{
		return DB::connection($this->oldDB)->table($table);
	}
}