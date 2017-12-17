<?php 
namespace App\Importers;
use Illuminate\Console\Command;
use \DB;
class BaseImporter  
{
	/* old database connection*/
	protected $oldDB = 'old';
	protected $limit = '1000';
	protected $instruments = false;
	public $console;
	function __construct($console)
	{
		$this->console = $console;
		$this->handle();
	}

	public function new($table)
	{
		return DB::table($table);
	}

	public function old($table)
	{
		return DB::connection($this->oldDB)->table($table);
	}

	//form table and to table.
	public function oneToOne($form, $to)
	{
		$total =  $this->old($form)->count();
		$skip = 0;
		$this->new($to)->truncate();
		while ($total > 0) {
			$data = [];
			foreach ($this->old($form)->take($this->limit)->skip($skip)->get() as $row) {
				$newRow = [];
				foreach ($row as $key => $value) {
					if(!array_key_exists($key, $this->oneToOneMap($to)))
					{
						continue;
					}
					$key = $this->oneToOneMap($to)[$key];
					$exploded = explode('|', $key);
					if(count($exploded) > 1){
						$function = $exploded[0].ucfirst($exploded[1]); 
						$key = $exploded[0];
						$value = $this->$function($value);
						/*additional filter if neseccery*/
					}
					/*Resolve the instrument id*/
					if($key == 'instrument_id' /* || additional column name check here*/){
						$value = $this->newInstrumentId($value);
						$hasInstrument_id = true;
					}
					/*Resolve the instrument id*/
					  $newRow[$key] =	$value;
				}

				if(isset($hasInstrument_id) && !isset($newRow['instrument_id']))
				{
					continue;
					dd($newRow);
					throw new \Exception("Mismatch instrument found", 1);
					
				}	
					// dd($newRow);
				$data[] = $newRow;
			 }
			 $skip += $this->limit;
			 $total -= $this->limit;
			 // store to new table
			 $this->new($to)->insert($data);
		}		

	}

	public function oneToOneMap($table)
	{
		foreach ($this->oneToOneMap as $key => $value) {
			if(is_array($value))
			{
				return $this->oneToOneMap[$table];
			}	
			break;
		}
		return $this->oneToOneMap;
	}

	public function newInstrumentId($old_id)
	{
		$data = [];
		if(!$this->instruments)
		{
			$this->instruments = DB::select(DB::raw("SELECT instruments.id as instrument_id, symbols.id as symbol_id FROM `instruments` LEFT JOIN symbols on symbols.dse_code = instruments.instrument_code  WHERE symbols.id is NOT null "));
		}
		foreach ( $this->instruments as  $value) {
					if($value->symbol_id == $old_id)
					{
						return $value->instrument_id;
					}
		}	
	}

	public function buying_dateFilter($value)
	{
		 return \Carbon\Carbon::createFromTimestamp($value);

	}
}