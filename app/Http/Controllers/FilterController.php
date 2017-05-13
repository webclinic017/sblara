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
use DB;


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
      //echo "instrument_id: $instrument_id ||| count: $cur_count<br>";
      if($cur_count  >= $limit){
        //echo "true<br>";
        return $offset;
      }
      return -1;
    }

    public function parce_data($data, $group_count, $need_instruments, $filter, $limit = 250){
      //dd($group_count);
      $counter = 0;
      $array_result = array();

      foreach($need_instruments as $instrument){

      //  dd($instrument);
        //if($counter < 100) {$counter++; continue;}
        $new_data = array();
        $offset = $this->get_index_data($instrument->id, $group_count, $limit);
        if($offset == -1) { /*echo "ERROR $offset <br>";*/ continue;}

        //echo "<p>";
        //echo 'instrument_id: '.$instrument->id."<br>";
        ////echo '$i: '.$i."<br>";
        //echo '$offset: '.$offset."<br>";
        //echo '$limit: '.$limit."<br>";
        //echo '$counter: '.$counter."<br>";
        for($i = $offset + $limit - 1, $j = 0; $i >= $offset; $i--, $j++){
          //$new_data[$j] = $data[$i];
          try{

          $new_data[$j]['instrument_id'] = $data[$i]->instrument_id;
          $new_data[$j]['date'] = $data[$i]->date;
          $new_data[$j]['open'] = $data[$i]->open;
          $new_data[$j]['close'] = $data[$i]->close;
          $new_data[$j]['high'] = $data[$i]->high;
          $new_data[$j]['low'] = $data[$i]->low;
          }
          catch(Exception $e){


            //return;
          }
        }
        $counter++;

        // filter
        //echo "counter: $counter<br>";
        if($this->caclulate($new_data, $filter, $instrument->id)){
        //  echo "asfsd<br>";
      //    if($request->input('debug')){
      //      return redirect('filter/debug');
      //      //echo 'DEBUG<br>';
      //      return ;

      //    }
          $array_result[] = $instrument;
          // display
        //  echo $instrument->id." good<br>";
          //break;
        }
        else{
          //echo $instrument->id." BAD<br>";
        }
      }
      return $array_result;
    }

    public function parce_data_bakck($data, $group_count, $need_instruments, $filter, $limit = 250){
      //dd($group_count);
      $counter = 0;
      $array_result = array();

      foreach($need_instruments as $instrument){

      //  dd($instrument);
        //if($counter < 100) {$counter++; continue;}
        $new_data = array();
        $offset = 0;
        $found = false;

        foreach($group_count as $gc){
        //  print_r($gc['instrument_id']);
        //  echo ($gc['instrument_id']);
          if($gc['instrument_id'] == $instrument->id) {
            $found = true;
            if($gc['count'] < $limit) {
              $offset == -1;
            }
            break;
          }
          /*
          if($gc->count < $limit) {
            $offset == -1;
            echo $gc->instrument_id." <b>".$gc->count." <$limit</b><br>";
            break;
          }
          */
          $offset = $offset + $gc['count'];
        }

        if(!$found) {echo "NOT FOUND!"; continue;}
        if($offset == -1) {echo "EROR instrument_id: $instrument<br>"; continue;}

        echo "<p>";
        echo 'instrument_id: '.$instrument->id."<br>";
        //echo '$i: '.$i."<br>";
        echo '$offset: '.$offset."<br>";
        echo '$limit: '.$limit."<br>";
        echo '$counter: '.$counter."<br>";
        for($i = $offset + $limit - 1, $j = 0; $i >= $offset; $i--, $j++){
          //$new_data[$j] = $data[$i];
          try{

          $new_data[$j]['instrument_id'] = $data[$i]->instrument_id;
          $new_data[$j]['date'] = $data[$i]->date;
          $new_data[$j]['open'] = $data[$i]->open;
          $new_data[$j]['close'] = $data[$i]->close;
          $new_data[$j]['high'] = $data[$i]->high;
          $new_data[$j]['low'] = $data[$i]->low;
          }
          catch(Exception $e){


            //return;
          }
        }
        $counter++;

        // filter
        echo "counter: $counter<br>";
        if($this->caclulate($new_data, $filter, $instrument->id)){
          echo "asfsd<br>";
      //    if($request->input('debug')){
      //      return redirect('filter/debug');
      //      //echo 'DEBUG<br>';
      //      return ;

      //    }
          $array_result[] = $instrument;
          // display
          echo $instrument->id." good<br>";
          //break;
        }
        else{
          echo $instrument->id." BAD<br>";
        }
      }
      return $array_result;
    }

    public function filter(Request $request)
    {
      //
      $table = 'data_banks_eods';
      $limit=250;
      $date_b="2016-04-12";
      $date_e="2017-04-20";

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
        //$instruments = Instrument::where('id', $request->input('instrument'))->get();
      }

      ////
      ////
      //$sql = "select * from `instruments` where exists (select * from `sector_lists` where `instruments`.`sector_list_id` = `sector_lists`.`id` and `exchange_id` = '1' and `name` not like 'Index' and `name` not like 'Debenture' and `name` not like 'Treasury Bond') and `active` = '1' order by `id` asc";
      $sql = "select `id` ,`instrument_code` from `instruments` where exists (select * from `sector_lists` where `instruments`.`sector_list_id` = `sector_lists`.`id` and `exchange_id` = '1' and `name` not like 'Index' and `name` not like 'Debenture' and `name` not like 'Treasury Bond') and `active` = '1' order by `id` asc";
      $need_instruments = DB::Select($sql);

      $str = "";
      foreach ($need_instruments as $instrument){
        $str = $str.$instrument->id.",";
      }
      $str = substr ($str, 0, strlen($str)-2);
      //echo $str."<br>";
      $sql = "SELECT `instrument_id`, `close`,`open`,`high`, `low`, `date` FROM $table WHERE date between '".$date_b."' and '".$date_e."' and `instrument_id` in (".$str.")  order by `instrument_id`  asc, `date` desc";
      $datas = DB::Select($sql);
      //dd($datas);
      $sql = "SELECT `instrument_id`, count(*) as count FROM $table WHERE date between '".$date_b."' and '".$date_e."' and `instrument_id` in (".$str.")  group by `instrument_id`";
      $group_index = DB::Select($sql);

    //  dd($group_index);
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

      //print_r($group_count);
      //dd($group_index);
      $array_result = $this->parce_data($datas, $group_count, $need_instruments, $filter, $limit);

      ////
      ////
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
