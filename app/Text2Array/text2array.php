<?php
/**
 * Text2Array class version 0.8
 * 22 October 2004
 * Convert tabular data text to array
 * Author: huda m elmatsani
 * Email : justhuda ## netscape ## net
 *
 *  syntax
 *  $data = new Text2Array;
 *  $data->setTextFile(string text file name); or $data->setTextData(string input data);
 *  $data->setSeparator(string delimeter, string newline);
 *  $data->getArrayData();
 *
 *  example
 *  convert text file to array
 *	$data = new Text2Array;
 *	$data->setTextFile("phrdp1.txt");
 *  $data->setSeparator("\t","\n"); optionally
 *	$data->getArrayData();
 *
 *
 *  convert input string to array
 *  $data = new Text2Array;
 *	$data->setTextData($_POST['string']);
 *	$data->getArrayData();
 *
 *
 *
 *
 */

Class Text2Array {

	var $delimetered=0;
	var $first_separator;
	var $second_separator;
	var $text_data;


    public function __construct()
    {
        // Constructor's functionality here, if you have any.
    }


	function text2array() {
        // PHP4-style constructor.
        // This will NOT be invoked, unless a sub-class that extends `foo` calls it.
        // In that case, call the new-style constructor to keep compatibility.
        self::__construct();
	}

	//prepare text file
	function setTextFile($filename) {
		if(file_exists($filename)) {

			$this->filename = str_replace('\\', '/', $filename);

		} else {
			//die(FILE_NOT_FOUND);
			$this->filename = $filename;
		}
	}

	function readTextFile() {
		
		$fd = fopen ($this->filename, "r");
		//$this->text_data = fread ($fd, filesize ($this->filename));
		
		$this->text_data=file_get_contents($this->filename);
		
		if(!$this->text_data)
		{
		sleep(15);
		$this->text_data=file_get_contents($this->filename);
		}
		
		if(!$this->text_data)
		{
		sleep(15);
		$this->text_data=file_get_contents($this->filename);
		}
		
		fclose ($fd);
	}

	function setTextData($string) {
		$this->text_data = $string;
	}

	function readTextData() {
		if(!$this->text_data) $this->readTextFile();
		return $this->text_data;
	}

	function setSeparator($first_separator, $second_separator) {
		$this->delimetered = 1;
		$this->first_separator = $first_separator;
		$this->second_separator = $second_separator;
	}

	//convert text data to array
	function string2Array() {

		if(!$this->delimetered) $this->setSeparator("\t","\n");
		$separator_1 = $this->first_separator;
		$separator_2 = $this->second_separator;
		$string      = $this->readTextData();

		//register each line as array values
		$array = explode($separator_2, $string);

		for ($i=0; $i < sizeof($array); $i++){
			$fields = substr_count($array[$i], $separator_1);
			if($fields>0){
				//2nd dimension array
				$array[$i] = explode($separator_1, $array[$i]);
			}
		}

		return $array;
	}

	function getArrayData() {
		return $this->string2Array();
	}


}
?>