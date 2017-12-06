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
		$total =  $this->new('users')->count();
		$skip = 0;
		while ($total > 0) {
			foreach ($this->new('users')->take($this->limit)->skip($skip)->get() as $row) {
				dd($row);
			 } 
			 $total -= $this->limit;
		}
	}

}