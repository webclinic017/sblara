<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryFilter;
use App\Instrument;
use App\Library\Parser;
use App\Library\Functions;
use App\Library\Operation;
use App\Library\Logger;
use App\DataBanksEod;


class FilterController extends Controller
{
    //
    private $log;

    protected $parser;
    protected $functions;
    protected $operation;
    //     = new Parser();

    public function __construct(){
      $this->log = new Logger;
    //  $this->log->clear();
      $this->parser = new Parser;
      $this->functions = new Functions;
      $this->operation = new Operation;
    }

    public function index(){
      $technical_filters = CategoryFilter::where('name','technical')->get();
      $fundamental_filters = CategoryFilter::where('name','fundamental')->get();
      $instruments = Instrument::all();

      //print_r($category_filters[0]->name);
      //print_r($category_filters[0]->kind_filters[0]->name);
      //print_r($category_filters[0]->kind_filters[0]->filters[0]->name);
      //print_r($category_filters[0]->kind_filter->);
      //$list_content = $list_content->toArray();

      return view('filter', array('technical_filters' => $technical_filters, 'fundamental_filters' => $fundamental_filters, 'instruments' => $instruments));
    }

    public function prepare($data){

        for($i = 0, $j = count($data) - 1; $i < count($data); $i++, $j--){
          $arr[$i] = $data[$j];
        }
        return $arr;
    }


    public function filter(Request $request)
    {
      //
      $time_start = $this->microtime_float();
      $array_result = array();
      $inputs = $request->all();
      $filter = "";
      foreach ($inputs as $input) {
        if($input != "0" && $input[0] == '{') { $filter = $filter.$input; }
      }
      if($filter == "") {return false;}

      $this->log->insert($filter,"filters",__FUNCTION__.__CLASS__);
      if($request->input('debug')){
        $this->log->clear();
        $this->parser = new Parser(true);
        $this->functions = new Functions(true);
        $this->operation = new Operation(true);
        $instruments = Instrument::where('id', $request->input('instrument'))->get();
      }
      else{
        $instruments = Instrument::get();
      }
      //dd($instruments);
      foreach ($instruments as $instrument) {
        //echo "id: ".$instrument->id."<br>";
        //echo $instrument->id." I<br>";
        $data = DataBanksEod::take(250)->where('instrument_id', $instrument->id)->select('close','high','low','volume', 'date')->orderBy('date', 'desc')->get();

        $this->log->insert("$instrument->id","instrument->id",__FUNCTION__.__CLASS__);
        $this->log->insert("$instrument->instrument_code","instrument->instrument_code",__FUNCTION__.__CLASS__);
        $this->log->insert($data,"data",__FUNCTION__."|".__CLASS__);
        if(empty($data[0]) || count($data) < 250){
        //  echo "empty<br>";
          continue;
        }

        $this->log->insert("","",__FUNCTION__.__CLASS__);

        $data = $this->prepare($data);
        //dd($request->input('debug'));
        if($this->caclulate($data, $filter, $instrument->id)){

          if($request->input('debug')){
            return redirect('filter/debug');
            //echo 'DEBUG<br>';
            return ;

          }
          $array_result[] = $instrument;
          // display
        //  echo $instrument->id." good<br>";
          //break;
        }
        else{
        //  echo $instrument->id." BAD<br>";
        }


      }
      $time_end = $this->microtime_float();
      $time = $time_end - $time_start;
      //echo "Spend time: $time second<br>";
      return response()->json($array_result);
    }

    private function caclulate($data, $filter, $instrument_id){

      $sentence = $this->parser->parse_sentence($filter);
      foreach ($sentence as $word) {
        //$id_query, $comment = "", $result = "", $function = ""
        $this->log->insert("$word","word",__FUNCTION__.__CLASS__);

        $conditions = $this->parser->parse_and($word);
        foreach ($conditions as $condition) {
          $this->log->insert("$condition","condition",__FUNCTION__.__CLASS__);

          $function = $this->parser->parse_function($condition);

          $func = $function[1];  //compare increasing decreasing cross
          $arg = $function[2];
          $this->log->insert($func,"func",__FUNCTION__.__CLASS__);
          $this->log->insert($arg,"arg",__FUNCTION__.__CLASS__);

          $result = $this->operation->$func($data, $arg, $instrument_id);   // true or false
          //dd($result);
          if($result || is_array($result)){     //is_array for candlestick
            $this->log->insert('true',"result",__FUNCTION__.__CLASS__);
          }
          else{
            $this->log->insert('false',"result",__FUNCTION__.__CLASS__);
            return false;

          }
        }
      }

      return true;
    }

    public function debug(){
      $logs = $this->log->all();
      //dd($logs);
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
