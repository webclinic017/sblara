<?php

namespace App\Library;
use App\Log;

class Logger{

    private $enable;

    public function __construct($en=false){
      $this->enable = $en;
    }

    public function insert($comment = "", $result = "", $function = "", $strong = false){
      if($this->enable){
          $log = new Log();

        //  //$log->id_query = $id_query;
          if(is_array($comment)) { $comment = implode('|', $comment); }
          $log->comment = $comment;
          $log->result = $result;
          $log->function = $function;
          $log->save();

      }
    //  $tag1 = $tag2 = '';
    //  if($strong) {$tag1 = "<b>"; $tag2 = "</b>";}
    //  echo "<tr><td><div style='width: 710px;word-wrap: break-word; max-height: 200px; overflow-y: scroll;'>".$tag1.$comment.$tag2."</div></td><td>".$result."</td><td>".$function."</td></tr>";
    }


    public function clear(){
      Log::truncate();
    }


    public function all(){
      return Log::all();
    }
}


?>
