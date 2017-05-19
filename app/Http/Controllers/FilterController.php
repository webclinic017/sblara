<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryFilter;
use App\Instrument;
use App\Library\Parser;
use App\Library\Functions;
use App\Library\Operation;
use App\DataBanksEod;


class FilterController extends Controller
{
    protected $parser;
    protected $functions;
    protected $operation;

    public function __construct(){
      $this->parser = new Parser;
      $this->functions = new Functions;
      $this->operation = new Operation;
    }

    public function index(){
      $technical_filters = CategoryFilter::where('name','technical')->get();
      $fundamental_filters = CategoryFilter::where('name','fundamental')->get();
      $instruments = Instrument::all();

      return view('filter', array('technical_filters' => $technical_filters, 'fundamental_filters' => $fundamental_filters, 'instruments' => $instruments));
    }

    public function prepare($data){

        for($i = 0, $j = count($data) - 1; $i < count($data); $i++, $j--){
          $arr[$i] = $data[$j];
        }
        return $arr;
    }

    public function get_index_data($instrument_id, $group_count, $limit){
      $offset = 0;
      $cur_count = 0;
      foreach ($group_count as $gc) {
        if($gc['instrument_id'] == $instrument_id){
          $cur_count = $gc['count'];
          break;
        }
        $offset = $offset + $gc['count'];
      }
      if($cur_count  >= $limit){
        return $offset;
      }
      return -1;
    }

    public function parce_data($data, $group_count, $need_instruments, $filter, $limit = 210, $debug = false){
      $counter = 0;
      $k = 0;
      $array_result = array();

      foreach($need_instruments as $instrument){
        $new_data = array();
        $offset = $this->get_index_data($instrument->id, $group_count, $limit);

        if($offset == -1) { /*echo "ERROR $offset <br>";*/ continue;}

        for($i = $offset + $limit - 1, $j = 0; $i >= $offset; $i--, $j++){
          $new_data[$j]['instrument_id'] = $data[$i]->instrument_id;
          $new_data[$j]['date'] = $data[$i]->date;
          $new_data[$j]['open'] = $data[$i]->open;
          $new_data[$j]['close'] = $data[$i]->close;
          $new_data[$j]['high'] = $data[$i]->high;
          $new_data[$j]['low'] = $data[$i]->low;
          $new_data[$j]['volume'] = $data[$i]->volume;
          $new_data[$j]['trade'] = $data[$i]->trade;
        }
        $counter++;

        if($this->caclulate($new_data, $filter, $instrument->id)){
          if($debug){
            return $this->debug();
          }
          $index = count($new_data) - 1;
          $array_result[$k]['n'] = $k + 1;
          $array_result[$k]['instrument_code'] = $instrument->instrument_code;
          $array_result[$k]['m'] = "1M";
          $array_result[$k]['open'] = $new_data[$index]['open'];
          $array_result[$k]['high'] = $new_data[$index]['high'];
          $array_result[$k]['low'] = $new_data[$index]['low'];
          $array_result[$k]['close'] = $new_data[$index]['close'];
          $array_result[$k]['trade'] = $new_data[$index]['trade'];
          $array_result[$k]['volume'] = $new_data[$index]['volume'];
          $array_result[$k]['change'] = $new_data[$index]['open'] - $new_data[$index - 1]['open'];
          $array_result[$k]['change_p'] = 100 - $new_data[$index - 1]['open'] * 100 / $new_data[$index]['open'];

          $k++;
        }
        else{
        }
      }
      return $array_result;
    }

    public function save_filter(Request $request){
      $inputs = $request->all();

      $filter = "";
      foreach ($inputs as $key => $input) {
        if($input != "0" && $input[0] == '{') { $filter = $filter.$key.':'.$input."\r\n"; }
      }
      $filter = preg_replace("/\s*\r+/", '', $filter);
      $myName = "filter.flt";
      $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $myName)];

      return \Response::make($filter, 200, $headers);
    }

    public function filter(Request $request)
    {
      $debug = false;
      $limit=220;


      $time_start = $this->microtime_float();
      $array_result = array();
      $inputs = $request->all();
      $filter = "";
      foreach ($inputs as $input) {
        if($input != "0" && $input[0] == '{') { $filter = $filter.$input; }
      }
      if($filter == "") {return;}

      if($request->input('debug')){
        $this->log = new Logger(true);
        $this->log->clear();
        $this->parser = new Parser(true);
        $this->functions = new Functions(true);
        $this->operation = new Operation(true);

        $need_instruments = Instrument::where('id', $request->input('instrument'))->get();
        $debug = true;
      }
      else {
        $need_instruments = Instrument::getInstrumentsScripOnlyByDB();
      }
      $instr = "";
      foreach ($need_instruments as $instrument){

        $instr = $instr.$instrument->id.",";

      }
      $instr = substr ($instr, 0, strlen($instr)-1);
      $datas = DataBanksEod::getEodData($instr);
      $group_index = DataBanksEod::getCountDataByGroup($instr);

      $group_count = array();
      $i = 0;
      foreach ($need_instruments as $instrument) {
        $group_count[$i] = array('instrument_id' => $instrument->id, 'count' => 0);
        foreach ($group_index as $gi) {
          if($gi->instrument_id == $instrument->id){
            $group_count[$i] = array('instrument_id' => $instrument->id, 'count' => $gi->count);
          }
        }
        $i++;
      }

      $array_result = $this->parce_data($datas, $group_count, $need_instruments, $filter, $limit, $debug);

      $time_end = $this->microtime_float();
      $time = $time_end - $time_start;

      if(!$debug){
        return response()->json($array_result);
      }

    }

    private function caclulate($data, $filter, $instrument_id){

      $sentence = $this->parser->parse_sentence($filter);
      foreach ($sentence as $word) {
        $conditions = $this->parser->parse_and($word);
        foreach ($conditions as $condition) {
          $function = $this->parser->parse_function($condition);

          $func = $function[1];  //compare increasing decreasing cross
          $arg = $function[2];

          $result = $this->operation->$func($data, $arg, $instrument_id);   // true or false
          if($result || is_array($result)){     //is_array for candlestick
          }
          else{
            return false;
          }
        }
      }

      return true;
    }

    public function debug(){
      $logs = $this->log->all();
      echo "<table border='1'>";
      foreach($logs as $log){
        echo "<tr><td><div style='width: 710px;word-wrap: break-word; max-height: 200px; overflow-y: scroll;'>".$log->comment."</div></td><td>".$log->result."</td><td>".$log->function."</td></tr>";
      }
      echo "</table>";
    }

    private function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
