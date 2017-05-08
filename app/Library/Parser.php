<?php

namespace App\Library;
use App\Library\Logger;

class Parser{
  private $log;

  public function __construct($log=false){
    $this->log = new Logger($log);
  }

    //  {}{}{}
    public function parse_sentence($str){
      $str = mb_strtolower($str);
      $str = str_replace(" ","",$str);

      if(preg_match_all("/\{.*?\}/is", $str, $match)){
          return $match[0]; // it's 2 sides array [[],[]]
      }

      return false;
    }

    // &    return array
    public function parse_and($str){
      $str = str_replace("{","",$str);
      $str = str_replace("}","",$str);
      $conditions = explode("&",$str);

      return $conditions;
    }

    // compare
    // increasing
    // decreasing
    // cross
    // func     for excample Hummer
    // divergence
    public function parse_function($str){
      if(preg_match("/([a-z\_]{1,10})\[(.*?)\]/is", $str, $match)){
          return $match;    // 1 - name of function, 2 - arguments
      }
      if(preg_match("/(func)\((.*?)\)/is", $str, $match)){
          return $match;    // 1 - name of function, 2 - arguments
      }

      return false;
    }

    public function parse_divergence($str){
      $c = explode(";", $str);
      $compare['func'] = $c[0];
      $compare['type'] = $c[1];

      return $compare;
    }

    public function parse_compare($str){
      $c = explode(";", $str);
      $compare['func1'] = $c[0];
      $compare['comp_sign'] = $c[1];
      $compare['func2'] = $c[2];
      $compare['factor'] = (isset($c[3]) ? $c[3] : 1);

      return $compare;
    }

    public function parse_cross($str){
      $this->log->insert($str,"str",__FUNCTION__."|".__CLASS__);
      $c = explode(";", $str);
      $cross['func1'] = $c[0];
      $cross['direction'] = $c[1];
      $cross['func2'] = $c[2];
      //$cross['factor'] = (isset($c[3]) ? $c[3] : 1);

      return $cross;
    }

    public function parse_subfunction_and_arg($str){  //ma macd vma

      if(preg_match("/([a-z]{1,10})(\(.*?\))/is", $str, $match)){


          return $match;    // 1 - name of function, 2 - arguments
      }
      return $str;
    }

    public function log(){

    }

}


?>
