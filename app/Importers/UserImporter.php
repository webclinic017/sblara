<?php 
namespace App\Importers;
class UserImporter extends BaseImporter
{
	function __construct($console)
	{
		parent::__construct( $console );
	}

	public function handle()
	{
		$this->new('users');
	}

}