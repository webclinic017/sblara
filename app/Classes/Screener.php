<?php 
namespace App\Classes;
/**
* StockBangladesh Screener
* @author Selim
*/
class Screener{
	/*
	//regex 
	(\[([a-zA-Z]+)\((.*?)\)?.? (=|>|<|!=|is)?.+?([0-9].+?[.]?)\])
	 */
	const KEYWORDS = ['OPEN', 'HIGH', 'LOW', 'CLOSE', 'VOLUME'];
	const OPERATORS = [ 'IS', "NOT", "<=",  ">=",  '=', '!=', '>',  "<", "X>", "X<" ];
	const BOOLEANS = [ "CANDLEPATTERN" ];
	
	protected $query;
	protected $conditions = [];
	protected $methods = [];
	protected $keywords = [];
	protected $instruments = [];
	protected $data = [];
	protected $ldata = [];
	protected $targetN = 0;
	protected $targetType = "BEFORE";
	protected $dataTarget = "D";
	protected $real = 1;
	
	function __construct($query = null)
	{
		// $query = "[ MACD(26, 12, 9, CLOSE, SIGNAL) X< MACD(26, 12, 9, CLOSE, MACD) WITHIN 2 ]";
		require_once __DIR__."/trader.php";
		$this->query = strtoupper($query);
		$this->parse($this->query);
	}

	/**
	 * Parse query to single statement
	 */
	protected function parse($query)
	{
		preg_match_all("/\[(.*?)\]/", $query, $matches);
		if(!isset($matches[1][0])){die('syntax error');}
		if(!isset($matches[1][0])){throw new \Exception("Invalid syntax", 1);}
		$this->conditions = $matches[1];
		$this->parseConditions();
	}

	/**
	 * parse all statements
	 */
	public function parseConditions()
	{
		//sql query here 
		$this->instruments = \App\Instrument::whereNotIn('sector_list_id', ['22', '24', '4', '5'])->where('active', 1)->pluck('id')->toArray(); // addition filter will be apply here with the same query.. pe, fundamental info, category etc.
		foreach ($this->conditions as  $value) {
			//reset the data target to adjusted eod
			$this->dataTarget = "D";

			preg_match_all("((.*[^".join(self::OPERATORS, '')."])( ".join(self::OPERATORS, '|')." )(.*))", $value, $matches);
				// dump($this->conditions);
				// continue;
			$v1 = $matches[1][0];
			$v2 = $matches[3][0];
			// pluck the target candle
			// dd($v2);
			if(preg_match_all("/(.*) (BEFORE|WITHIN) ([0-9].)/", $v2, $res)){			
				$v2 = $res[1][0];
				$this->targetType = $res[2][0];
				$this->targetN = (int) $res[3][0];
			}
			// pluck the target candle
			$operator = $matches[2][0];
			$this->currentOperator = $operator;
			$this->condition = trim($value);
			$this->leftOperent = trim($v1);
			$this->rightOperent = trim($v2);
			//validation here
			$this->executeCondition($v1, $operator, $v2);
		// dump(count($this->instruments));
		// dump(join($this->instruments, ','));
		}
		// dump($this->data);
	}

	/**
	 * execute the condition
	 */
	public function executeCondition($v1, $operator, $v2)
	{
		foreach ($this->instruments as $key => $value) {
			$this->instrument_id = $value;
			if(!$this->compare($this->compileValue($v1), $operator, $this->compileValue($v2)))
			{
				unset($this->instruments[$key]);			
				unset($this->data[$this->instrument_id]);
			}
		}
	}

	/**
	 * Compile parameters
	 */
	public function compileParams($params)
	{
		$this->dataTarget = trim($params[count($params) - 1]);
		foreach ($params as $key => $value) {
			if(preg_match_all("/".join(self::KEYWORDS, '|')."/", $value, $matches))
			{
				preg_match_all("/".join(self::KEYWORDS, '|')."/", $value, $matches);
				if(!isset($matches[0][0])){throw new \Exception("Invalid parameter passed =>".$value, 1);}
				$params[$key] = $this->{strtolower($matches[0][0]).'Array'};
			}
		}

		return $params;
	}

	/**
	 * Compile values on condition
	 */
	public function compileValue($value)
	{
		$type = $this->getCompareValueType($value);
		switch ($type) {
			case 'function':
			return $this->compileFunction($value);
				break;
			case 'math':
			//if bollean match return true
			if(in_array(trim($value), self::BOOLEANS)){ return $this->generateGreedyArray(true); }
			return $this->compileMath($value);
				break;
		}
	}

	/**
	 * Compare two value
	 */
	public function compare($val1, $operator, $val2)
	{
		if(!isset($val2[0]))
		{
			return false;
		}
		// dump($this->instrument_id);
		$i = $this->targetN;
		if($this->targetType == 'WITHIN')
		{
			$i = 0;
		}
		$matched = false;
		while(true)
		{	
			if(!isset($val1[$i])){ return false;}
			$v1 = $val1[$i];
			$v2 = $val2[$i];
			switch ($operator) {
				case '=':
					$matched = $v1 == $v2;
					break;
				case '>':
					$matched = $v1 > $v2;
					break;
				case '<':
					$matched = $v1 < $v2;
					break;
				case '!=':
					$matched = $v1 != $v2;
					break;
				case '>=':
					$matched = $v1 >= $v2;
					break;
				case '<=':
					$matched = $v1 <= $v2;
					break;
				case 'X<':
					if($v1 > $v2)
					{
						$matched = false;	
						break;
					}			
					if(property_exists($this, $this->instrument_id.$this->getLeftOperent()."_prev")) {
						$v1 = $this->{$this->instrument_id.$this->getLeftOperent()."_prev"}[$i];
					}
					if(property_exists($this, $this->instrument_id.$this->getRightOperent()."_prev")) {
						$v2 = $this->{$this->instrument_id.$this->getRightOperent()."_prev"}[$i];
					}
					$matched = $v1 > $v2;
					break ; 
				case 'X>':
					if($v1 < $v2)
					{
						$matched = false;	
						break ;
					}	

					if(property_exists($this, $this->instrument_id.$this->getLeftOperent()."_prev")) {
						$v1 = $this->{$this->instrument_id.$this->getLeftOperent()."_prev"}[$i];
					}
					if(property_exists($this, $this->instrument_id.$this->getRightOperent()."_prev")) {
						$v2 = $this->{$this->instrument_id.$this->getRightOperent()."_prev"}[$i];
					}

					$matched = $v1 < $v2;
					break;
			}
			if($i == $this->targetN || $matched)
			{
				break;
				//stop loop	
			}
			$i++;
		}
		//store the n for nth candle
		if($matched)
		{
			$this->ldata[$this->instrument_id][trim($this->condition)] = $i;
		}

		 return $matched;
		throw new \Exception("Invalid operator used", 1);
	}

	public function getFileData($instrument_id, $prop, $type = 'D')
	{
		switch ($type) {
			case '5M':
			return \App\Repositories\FileDataRepository::get5MinutesUnadjustedData($instrument_id, $prop[0], $this->real);
				break;
			
			case '15M':
			return \App\Repositories\FileDataRepository::get15MinutesUnadjustedData($instrument_id, $prop[0], $this->real);
				break;
			
			case 'ND':
			return \App\Repositories\FileDataRepository::getUnAdjustedEod($instrument_id, $prop[0], $this->real);
				break;
			case '30M':
			return \App\Repositories\FileDataRepository::get30MinutesUnadjustedData($instrument_id, $prop[0], $this->real);
				break;
			case '1H':
			return \App\Repositories\FileDataRepository::get60MinutesUnadjustedData($instrument_id, $prop[0], $this->real);
				break;
			case 'W':
			return \App\Repositories\FileDataRepository::getAdjustedWeeklyData($instrument_id, $prop[0], $this->real);
				break;
			case 'M':
			return \App\Repositories\FileDataRepository::getAdjustedMonthlyData($instrument_id, $prop[0], $this->real);
				break;
			
			default:
			return \App\Repositories\FileDataRepository::getAdjustedEod($instrument_id, $prop[0], $this->real);
				break;
		}

	}

	/**
	 * getter for getting props value
	 */
	public function __get($prop)
	{
		$data = $this->getFileData($this->instrument_id, $prop[0], $this->dataTarget);

		if(preg_match("/[A|a]rray/", $prop))
		{		
			return array_reverse($data);
		}
		return array_slice($data, 0, $this->targetN + 1);
	}

	/**
	 * Compile function
	 */
	public function compileFunction($value)
	{
		//if function
			preg_match_all("/([A-Za-z].*)\((.*)\)/", $value, $matches);
			$function = $matches[1][0];
			$params = explode(',', $matches[2][0]);
			//CHECK IF ALREADY CALCULATED
			$index = trim($value);
			$this->currentColumn = $index;
		
			if(!isset($this->data[$this->instrument_id][$index]))
			{
				$value = $this->callFunction($function, $params);

					$i = 0;
				if(is_array($value)){ 
					$data = $value;
					reset($data);
					end($data);

					//loop start for within n days
					for ($i; $i <= $this->targetN; $i++) { 
						$value = current($data);
						$this->data[$this->instrument_id][$index]['values'][$i] = $value;
						if($this->getOperator()[0] == 'X')
						{
							if(!isset($this->{$this->instrument_id.$index.'_prev'}))
							{
								$this->{$this->instrument_id.$index.'_prev'} = [];
							}
							$this->{$this->instrument_id.$index.'_prev'}[$i] = prev($data);
						}else{
							prev($data);
						}					
					}

				}
					//loop end for within n days
			}

			return isset($this->data[$this->instrument_id][$index]['values'])?$this->data[$this->instrument_id][$index]['values']:[];
			// if function				
	}

	public function getOperator()
	{
		if(!isset($this->currentOperator))
		{
			return "";
		}
		return $this->currentOperator;
	}

	/**
	 * get compare value type
	 */
	public function getCompareValueType($value)
	{
		if(preg_match("/[a-zA-Z3] *?\(/", $value))
		{
			return 'function';
		}
		return 'math';
	}

	/**
	 * Compile math
	 */
	public function compileMath($value)
	{
		$index = trim($value);
		// fill all array pocket for complare n days ago
		if(is_numeric($index))
		{
			$dataArray = $this->generateGreedyArray($index);
			return 	$this->data[$this->instrument_id][$index]['values'] = $dataArray;
		}
		//if function
			preg_match_all("/(".join(self::KEYWORDS, '|').")/", $value, $matches);
			$keywords = $matches[1];
				$values = [];
				$keywordData = [];
			foreach ($keywords as $keyword) {
					if(isset($keywordData[$keyword])){continue;}
					$keywordData[$keyword] = $this->{strtolower($keyword)};
			 };
			foreach ($keywordData as $key => $data) {
				$i = 0;
				foreach ($data as  $val) {
					$values[$i] = str_replace($key, $keywordData[$key][$i], isset($values[$i])?$values[$i]:$value);
					$i ++;
				}
			 };

				foreach ($values as $value) {
				if(preg_match("/[a-zA-Z]/", $value)){throw new \Exception("Syntax error uexpected character found during calculation \"".$value."\"", 1);
				}
					$output[] =  (eval("return ".$value.";"));
			}	

			if(!isset($this->data[$this->instrument_id][$index]))
			{
						$this->data[$this->instrument_id][$index]['values'] = $output;
			}		 
			return $this->data[$this->instrument_id][$index]['values'];		

		
			if(!isset($this->data[$this->instrument_id][$index]))
			{
				$value = $this->callFunction($function, $params);
					$i = 0;
			}

	}

	public function results()
	{
		return $this->instruments;
	}

	public function getInstruments()
	{
		if(count($this->results()))
		{
			return \App\Repositories\DataBanksIntradayRepository::getAvailableLTP($this->results());
			
		}
		return [];
	}

	
	public function getColumns()
	{
		$data = current($this->data);
		if(!$data){return [];}
		return array_keys($data);
	}
	
	public function getData($instrument_id, $column)
	{
		//get matched candleNo
		if(!isset($this->colspan))
		{
			$this->colspan = 0;
		}

		reset($this->ldata[$instrument_id]);
		$key = key($this->ldata[$instrument_id]);
		$matchedCandle = @$this->ldata[$instrument_id][$key];
		// dump('-key-'.$key);
		// dump($matchedCandle);
		// dump('colspan-'.$this->colspan);
		$this->colspan++;
		if($this->colspan == 2)
		{
			unset($this->ldata[$instrument_id][$key]);
			$this->colspan = 0;
		}

		$data = @$this->data[$instrument_id][$column]['values'][$matchedCandle];
		$data = "<strong>$data</strong>";
		if (strpos($key, 'WITHIN') !== false ) {
			// $data .= " ($matchedCandle candle ago)";
			$data .= " (".$this->getDate($instrument_id, $matchedCandle).")";
		}
		return $data;
	}

	public function getLeftOperent()
	{
		return $this->leftOperent;
	}

	public function getRightOperent()
	{
		return $this->rightOperent;
	}

	public function callFunction($function, $params = [])
	{
		// if($this->instrument_id == 20){
		// 	dump($this->compileParams($params));
		// 	dd(call_user_func_array("sb_".strtolower($function), $this->compileParams($params)));
		// }
		return call_user_func_array("sb_".strtolower($function), $this->compileParams($params));		
	}

	public function count()
	{
		return count($this->instruments);
	}

	public function getCondition()
	{
		return $this->condition;
	}

	public function getDate($instrument_id, $nCandleAgo)
	{
		$data = \App\Repositories\FIleDataRepository::getAdjustedEod($instrument_id, 'd');
		        return date('d M Y', strtotime($data[$nCandleAgo]));	
	}
	public function generateGreedyArray($value)
	{
			for ($i=0; $i <= $this->targetN; $i++) { 
				$dataArray[] = $value;
			}		
			return $dataArray;
	}

}