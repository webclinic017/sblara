<?php

namespace App\Library;
use App\Library\Parser;
use App\Library\Functions;
use App\Library\Logger;

class Operation{
  private $log;

  protected $parser;
  protected $functions;

  public function __construct($log=false){
    $this->log = new Logger($log);
  //  $this->log->clear();
    $this->parser = new Parser($log);
    $this->functions = new Functions($log);
  }

  public function compare($data, $str, $id_instrument){
    //$this->log->insert($str,"str",__FUNCTION__.__CLASS__);
    $compare = $this->parser->parse_compare($str);

  //  dd($compare);
  //  $this->log->insert($compare,"compare",__FUNCTION__.__CLASS__);
    $function1 = $this->parser->parse_subfunction_and_arg($compare['func1']);
    $func1 = $function1[1];
    $arg1 = $function1[2];
    $this->log->insert($func1,"func1",__FUNCTION__.__CLASS__);
    $this->log->insert($arg1,"arg1",__FUNCTION__.__CLASS__);
    $result1 = $this->$func1($data,$arg1,$id_instrument);
    if(is_array($result1)) {$result1 = $result1[0];}
    $this->log->insert($result1,"result1",__FUNCTION__.__CLASS__, true);


    $function2 = $this->parser->parse_subfunction_and_arg($compare['func2']);
    //$this->log->insert($function2,"function2",__FUNCTION__.__CLASS__);
    if(!is_numeric($function2)){
      $func2 = $function2[1];
      $this->log->insert($func2,"func2",__FUNCTION__.__CLASS__);

      $arg2 = $function2[2];
      $this->log->insert($arg2,"arg2",__FUNCTION__.__CLASS__);
      $result2 = $this->$func2($data,$arg2,$id_instrument);
    }
    else{
      $result2 = $function2;
    }
    if(is_array($result2)) {$result2 = $result2[0];}
    $this->log->insert($result2,"result2",__FUNCTION__.__CLASS__, true);

    $compare_sign = $compare['comp_sign'];

    $this->log->insert($compare_sign,"compare_sign",__FUNCTION__.__CLASS__);
    $this->log->insert($result1.$compare_sign.$result2,"compare_sign",__FUNCTION__.__CLASS__);

    if($compare_sign == ">"){
      if($result1 > $result2){
        return true;
      }
      else{
        return false;
      }
    }
    if($compare_sign == "<"){
      if($result1 < $result2){
        return true;
      }
      else{
        return false;
      }
    }
    $this->log->insert('adsffsdafsfsdfsdfasadfsdf',"SFJ:SDFLDSDS",__FUNCTION__.__CLASS__);
    //$compare['func1'] = $c[0];
    //$compare['comp_sign'] = $c[1];
    //$compare['func2'] = $c[2];
    //$compare['factor'] = (isset($c[3]) ? $c[3] : 1);
  }

  public function func($data, $arg, $id_instrument=0){
    $arg = str_replace('(','', $arg);
    $arg = str_replace(')', '', $arg);
    //$this->log->insert($arg,"arg",__FUNCTION__.__CLASS__);
    return $this->functions->func($data, explode(',',$arg), $id_instrument);
  }


  public function increasing($data, $str){
    $this->log->insert($str,"str",__FUNCTION__.__CLASS__);

    $function1 = $this->parser->parse_subfunction_and_arg($str);
    $func1 = $function1[1];
    $arg1 = $function1[2];
    $arg1_ = explode(',',$arg1);
    $arg1 = $arg1_[0].','.$arg1_[1].','.$arg1_[2].','.$arg1_[2].','.($arg1_[4]+1);

    $this->log->insert($func1,"func1",__FUNCTION__.__CLASS__);
    $this->log->insert($arg1,"arg1",__FUNCTION__.__CLASS__);
    $result1 = $this->$func1($data,$arg1);
    $this->log->insert($result1,"result1",__FUNCTION__.__CLASS__);

    for($i = 0; $i < count($result1) - 1; $i++) {
      if($result1[$i]<$result1[$i+1]){
        continue;
      }
      return false;
    }
    return true;
  }

  public function decreasing($data, $str){

    $function1 = $this->parser->parse_subfunction_and_arg($str);
    $func1 = $function1[1];
    $arg1 = $function1[2];
    $arg1_ = explode(',',$arg1);
    $arg1 = $arg1_[0].','.$arg1_[1].','.$arg1_[2].','.$arg1_[2].','.($arg1_[4]+1);

    $this->log->insert($func1,"func1",__FUNCTION__.__CLASS__);
    $this->log->insert($arg1,"arg1",__FUNCTION__.__CLASS__);
    $result1 = $this->$func1($data,$arg1);
    $this->log->insert($result1,"result1",__FUNCTION__.__CLASS__);
    for($i = 0; $i < count($result1) - 1; $i++) {
      if($result1[$i]>$result1[$i+1]){

        continue;
      }
      return false;
    }
    return true;
  }

  public function divergence($data, $str){
    $this->log->insert($str,"str",__FUNCTION__.__CLASS__);
    $divergence = $this->parser->parse_divergence($str);
    $this->log->insert($divergence,"divergence",__FUNCTION__.__CLASS__);
    $function1 = $this->parser->parse_subfunction_and_arg($divergence['func']);
    $this->log->insert($function1,"function1",__FUNCTION__.__CLASS__);
    $func1 = $function1[1];
    $arg1 = $function1[2];
    $arg1_ = explode(',',$arg1);
    //$arg1 = $arg1_[0].','.$arg1_[1].','.$arg1_[2].','.$arg1_[2].','.($arg1_[4]+1);

    $this->log->insert($func1,"func1",__FUNCTION__.__CLASS__);
    $this->log->insert($arg1,"arg1",__FUNCTION__.__CLASS__);
    $array = $this->$func1($data,$arg1);

    $this->log->insert($array[0],"array[0]",__FUNCTION__.__CLASS__);
    $this->log->insert($array[1],"array[1]",__FUNCTION__.__CLASS__);
    $this->log->insert($divergence['type'],"type",__FUNCTION__.__CLASS__);

    $this->log->insert($array[0][count($array[0]) - 2].'<br>'.$array[1][count($array[0]) - 2],"array[0][count(array[0]) - 2]<br>array[1][count(array[0]) - 2]",__FUNCTION__.__CLASS__);
    $this->log->insert($array[0][count($array[0]) - 1].'<br>'.$array[1][count($array[0]) - 1],"array[0][count(array[0]) - 1]<br>array[1][count(array[0]) - 1]",__FUNCTION__.__CLASS__);
    if($divergence['type'] == 'bullish'){
      if($array[0][count($array[0]) - 2] < $array[1][count($array[0]) - 2] && $array[0][count($array[0]) - 1] > $array[1][count($array[0]) - 1]){
        return true;
      }
      return false;
    }
    if($divergence['type'] == 'bearish]'){
      if($array[0][count($array[0]) - 2] > $array[1][count($array[0]) - 2] && $array[0][count($array[0]) - 1] < $array[1][count($array[0]) - 1]){
        return true;
      }
      return false;
    }

    if($divergence['type'] == 'strongbullish'){
      if($array[0][count($array[0]) - 2] < $array[1][count($array[0]) - 2] && $array[0][count($array[0]) - 1] > $array[1][count($array[0]) - 1] &&
          $array[0][count($array[0]) - 2] < 0 &&  $array[1][count($array[0]) - 2] < 0 && $array[0][count($array[0]) - 1] < 0 && $array[1][count($array[0]) - 1] < 0){
        return true;
      }
      return false;
    }
    if($divergence['type'] == 'strongbearish]'){
      if($array[0][count($array[0]) - 2] > $array[1][count($array[0]) - 2] && $array[0][count($array[0]) - 1] < $array[1][count($array[0]) - 1] &&
          $array[0][count($array[0]) - 2] > 0 &&  $array[1][count($array[0]) - 2] > 0 && $array[0][count($array[0]) - 1] > 0 && $array[1][count($array[0]) - 1] > 0){
        return true;
      }
      return false;
    }
    if($divergence['type'] == 'converging'){
      if(abs($array[2][count($array[2]) - 1]) - abs($array[2][count($array[2]) - 2]) < 0){
        return true;
      }
      return false;

    }
    if($divergence['type'] == 'diverging'){
      if(abs($array[2][count($array[2]) - 1]) - abs($array[2][count($array[2]) - 2]) > 0){
        return true;
      }
      return false;

    }
    //dd($result1);
  }

  public function cross($data,$str, $id_instrument){
    $cross = $this->parser->parse_cross($str);

    $function1 = $this->parser->parse_subfunction_and_arg($cross['func1']);
    if(is_array($function1)){

      $func1 = $function1[1];
      $arg1 = $function1[2];

      if(count(explode(',',$arg1)) == 1){ $arg1 = str_replace(")",'',$arg1); $arg1 = $arg1.',0,0,0,2)'; }
      if(count(explode(',',$arg1)) == 2){ $arg1 = str_replace(")",'',$arg1); $arg1 = $arg1.',0,0,2)'; }
      $this->log->insert($arg1,'arg1',__FUNCTION__.__CLASS__);
      $result1 = $this->$func1($data,$arg1,$id_instrument);
      //$result1 = $func1($arg1);
    }
    else{
      $result1 = $function1;
    }
    $function2 = $this->parser->parse_subfunction_and_arg($cross['func2']);
    if(is_array($function2)){
      $func2 = $function2[1];
      $arg2 = $function2[2];
      if(count(explode(',',$arg2)) == 1){ $arg2 = str_replace(")",'',$arg2); $arg2 = $arg2.',0,0,0,2)'; }
      if(count(explode(',',$arg2)) == 2){ $arg2 = str_replace(")",'',$arg2); $arg2 = $arg2.',0,0,2)'; }
      //$result2 = $func1($arg2);
      $result2_ = $this->$func2($data,$arg2,$id_instrument);
      if(!is_array($result2_)){
        $this->log->insert($result2_,"result2",__FUNCTION__.__CLASS__);
        $result2[0] = $result2_;
        $result2[1] = $result2_;
      }
      else{
        $result2 = $result2_;
      }
      $this->log->insert($result2,"result2",__FUNCTION__.__CLASS__);
    }
    else{
      $result2 = $function2;
    }

    $direction = $cross['direction'];

    $this->log->insert($direction,'direction',__FUNCTION__.__CLASS__);
    $this->log->insert($result1,'result1',__FUNCTION__.__CLASS__);
    $this->log->insert($result2,'result2',__FUNCTION__.__CLASS__);

    if($direction == "up_to_down"){ // снизу вврех down to up
      if($result1[1] < $result2[1] && $result1[0] > $result2[0]){
        return true;
      }
      else{
        return false;
      }
    }
    if($direction == "down_to_up"){// cвреху вниз up to down
      if($result1[1] > $result2[1] && $result1[0] < $result2[0]){
        return true;
      }
      else{
        return false;
      }
    }
    if($direction == "any"){// cвреху вниз up to down
      if(($result1[1] > $result2[1] && $result1[0] < $result2[0])||($result1[1] < $result2[1] && $result1[0] > $result2[0])){
        return true;
      }
      else{
        return false;
      }
    }
  }

  public function namefunction($str){   // Hummer  Candlestick //sup res
    return $str;
  }
}


?>
