<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filter;

class ParcerController extends Controller
{
  //
  public function index($save = 0){
    echo "save = $save<p>";
    $filters = Filter::whereIn('id_kindfilter', array(1, 2, 7,8,13,14,19,20,25))->get();
    //1, 2, 7,8,13,14,19,20
    $type = "ema";
    echo "<table border='1'>";
    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $patterns = array();
      $patterns[0] = '/([A-Z]{2,5})([0-9]{0,5}) (below|above) ([A-Z]{2,5})([0-9]{0,5})/is';
      $patterns[1] = '/(Price) ([0-9]{0,5})% (below|above) ([A-Z]{2,5})([0-9]{0,5})/is';
      $patterns[2] = '/([A-Z]{2,5})([0-9]{0,5}) crossed ([A-Z]{2,5})([0-9]{0,5})(.below|.above|$)?/is';
      $patterns[3] = '/([A-Z]{2,5})([0-9]{0,5}) (increasing|decreasing) for ([0-9]{1,5})/is';

      $patterns[4] = '/([A-Z]{2,5})([0-9]{0,5}) crossed ([A-Z]{2,5})([0-9]{0,5})(.below|.above) ([0-9]{1,3}) day[s]{0,1} ago/is';

      $replacements = array();
      //$replacements[0] = 'compare[func(\1\2),<,func(\3,\4)]';
/*
*/
      $type="ma";
      $period = 20;
      $replace = preg_replace_callback_array(
        [
          $patterns[0] => function ($m, $v = '', $sign = ">")use ($type, $period){
            if( !empty($m[2]) ) { $v = ','.$m[2];}
            if($m[3] == "below") { $sign = "<"; }

            if(empty($m[5])) {$m[5] = $period;}
            return 'compare[func('.$m[1].$v.');'.$sign.';func('.$m[4].','.$m[5].')]';
          },

          $patterns[1] => function ($m, $v = '', $sign = ">")use ($type, $period){
            if( !empty($m[2]) ) { $v = ';'.$m[2];}
            $ratio = 0.01;
            if($m[3] == "below") {
              $sign = "<";
              $ratio = -0.01;
            }

            if(empty($m[5])) {$m[5] = $period;}
            return 'compare[func('.$m[1].');'.$sign.';func('.$m[4].','.$m[5].','.($m[2] * $ratio).')]';
          },


          $patterns[4] => function ($m, $v = '', $direct = "down_to_up")use ($type, $period){
            if( !empty($m[2]) ) { $v = ','.$m[2];}
            else {$v = ',20, 0,'.$m[6].',2';}
            //echo "M5: ".$m[5]."<br>";
            if(empty($m[5])) { $direct = "any"; }
            elseif($m[5] == " below") { $direct = "up_to_down"; }
            if(empty($m[4])) {$m[4] = $period;}
            //  print_r($m);
            return 'cross[func('.$m[1].$v.');'.$direct.';func('.$m[3].','.$m[4].', 0,'.$m[6].',2)]';
          },



          $patterns[3] => function ($m, $v = '') use ($type, $period) {
            if( !empty($m[2]) ) { $v = ','.$m[2]; }
            $ret = $m[3].'[func('.$m[1].','.$period.',0,0,'.$m[4].')]';

            return $ret;
          },
          $patterns[2] => function ($m, $v = '', $direct = "down_to_up")use ($type, $period){
            if( !empty($m[2]) ) { $v = ','.$m[2];}
            //echo "M5: ".$m[5]."<br>";
            if(empty($m[5])) { $direct = "any"; }
            elseif($m[5] == " below") { $direct = "up_to_down"; }

            if(empty($m[3])) {$m[3] = $period;}
            //print_r($m);
            return 'cross[func('.$m[1].$v.');'.$direct.';func('.$m[3].','.$m[4].')]';
          },

        ]
      , $filters[$i]->name);

      $replace= str_replace('days','',$replace);
      $replace= str_replace('day','',$replace);

    //  echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($replace).'}';
      if($save == 1) {
        echo "save<br>";
        $filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='50'>".$replace."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }


  //
  public function index2($save = 0){ //mfi  Stochastic 15



    $type = "cci";
    $TYPE = "CCI";
    $id = 9;

    $type = "rsi";
    $TYPE = "RSI";
    $id = 3;

    $type = "mfi";
    $TYPE = "MFI";
    $id = 15;

    $type = "lstochastic";
    $TYPE = "Slow Stochastic";
    $id = 27;

    $type = "fstochastic";
    $TYPE = "Fast Stochastic";
    $id = 21;
/*





    */

    $period = 14;

    //$filters = Filter::whereIn('id_kindfilter', array($id))->get();
    $filters = Filter::whereIn('id_kindfilter', array(9,3,15,27,21))->get();

    echo "<table border='1'>";
    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $name = mb_strtolower($filters[$i]->name);;
      $res = "";
      if(preg_match("/(rsi|cci|mfi|fast stochastic|slow stochastic)(?:.below|.above|$)? (<|>)([\-0-9 ]{1,4})/is",            $name, $m)){
        $period = '14';
        if(mb_strtolower($m[1]) == 'fast stochastic'){ $period = '14.3';}
        if(mb_strtolower($m[1]) == 'slow stochastic'){ $period = '14.3.3';}
        $res = 'compare[func('.$m[1].','.$period.');'.$m[2].';'.$m[3].']';

      }

      if(preg_match("/(rsi|cci|mfi|fast stochastic|slow stochastic) just entered into \((<|>)([\-0-9]{1,4})\)/is",            $filters[$i]->name, $m)){

        if($m[2] == ">"){
          $c1 = "<";
          $c2 = ">";
        }

        if($m[2] == "<"){
          $c1 = ">";
          $c2 = "<";
        }
        $period = '14';
        if(mb_strtolower($m[1]) == 'fast stochastic'){ $period = '14.3';}
        if(mb_strtolower($m[1]) == 'slow stochastic'){ $period = '14.3.3';}
        $res = 'compare[func('.$m[1].','.$period.',0,1,1);'.$c1.';'.$m[3].']&compare[func('.$m[1].','.$period.');'.$c2.';'.$m[3].']';

      }

      if(preg_match("/(rsi|cci|mfi|fast stochastic|slow stochastic) (decreasing|increasing) for ([0-9]{1,4}) day/is",            $filters[$i]->name, $m)){
        $period = '14';
        if(mb_strtolower($m[1]) == 'fast stochastic'){ $period = '14.3';}
        if(mb_strtolower($m[1]) == 'slow stochastic'){ $period = '14.3.3';}
        $res = $m[2].'[func('.$m[1].','.$period.',0,0,'.$m[3].')]';

      }
      if(preg_match("/(rsi|cci|mfi|fast stochastic|slow stochastic) (<|>)([\-0-9]{1,4}) \& (decreasing|increasing) for ([0-3]{1,3}) day/is",            $filters[$i]->name, $m)){
        $period = '14';
        if(mb_strtolower($m[1]) == 'fast stochastic'){ $period = '14.3';}
        if(mb_strtolower($m[1]) == 'slow stochastic'){ $period = '14.3.3';}
        $res = 'compare[func('.$m[1].','.$period.');'.$m[2].';'.$m[3].']&'.$m[4].'[func('.$m[1].','.$period.',0,0,'.$m[5].')]';

      }
      if(preg_match("/(rsi|cci|mfi|fast stochastic|slow stochastic) just crossed (below|above) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){

        if($m[2] == ">"){
          $c1 = "<";
          $c2 = ">";
        }

        if($m[2] == "<"){
          $c1 = ">";
          $c2 = "<";
        }

        $period = '14';
        if(mb_strtolower($m[1]) == 'fast stochastic'){ $period = '14.3';}
        if(mb_strtolower($m[1]) == 'slow stochastic'){ $period = '14.3.3';}

        $res = 'compare[func('.$m[1].','.$period.',0,1,1));'.$c1.';'.$m[3].']&compare[func('.$m[1].','.$period.');'.$c2.';'.$m[3].']';

      }


      //echo $res;
  //    echo "<br>$replace<br>";
   $res  = mb_strtolower(str_replace(' ','', $res));
   $res = str_replace('faststochastic','fstochastic', $res);
   $res = str_replace('slowstochastic','lstochastic', $res);
      $filters[$i]->value = '{'.$res.'}';
    if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$name."</textarea>$i<br>";


    }
    echo "</table>";
  }


  public function adx($save = 0){ //ADX


    $type = "adx";
    $type2 = "di_plus";
    $type3 = "di_minus";
    $TYPE = "ADX";
    $TYPE2 = "\+DI";
    $TYPE3 = "\-DI";
    $id = 4;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();
    //1, 2, 7,8,13,14,19,20

    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $res = "";
      if(preg_match("/$TYPE (<|>) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){

        $res = 'compare[func('.$type.',14);'.$m[1].';'.$m[2].']';

      }
      //              +DI < 20
      if(preg_match("/$TYPE2 (<|>) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){

        $res = 'compare[func('.$type2.',14);'.$m[1].';'.$m[2].']';

      }
      if(preg_match("/$TYPE3 (<|>) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){

        $res = 'compare[func('.$type3.',14);'.$m[1].';'.$m[2].']';

      }
      if(preg_match("/$TYPE (<|>) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){

        $res = 'compare[func('.$type.',14);'.$m[1].';'.$m[2].']';

      }

      if(preg_match("/$TYPE just crossed (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                if($m[1] == "above"){
                  $c1 = "<";
                  $c2 = ">";
                }

                if($m[1] == "below"){
                  $c1 = ">";
                  $c2 = "<";
                }

        $res = 'compare[func('.$type.',14,0,1,1));'.$c1.';'.$m[2].']&compare[func('.$type.',14));'.$c2.';'.$m[2].']';

      }


      if(preg_match("/\+DI just crossed (above|below) \-DI/is",            $filters[$i]->name, $m)){

        if($m[1] == "above"){
              $c1 = "<";
              $c2 = ">";
        }

        if($m[1] == "below"){
              $c1 = ">";
              $c2 = "<";
        }

        $res = 'compare[func(di_plus,14,0,1,1));'.$c1.';func(di_minus,14,0,1,1)]&func(di_plus,14));'.$c1.';func(di_minus,14)]';

      }

      if(preg_match("/\+DI just crossed (above|below) ADX/is",            $filters[$i]->name, $m)){

        if($m[1] == "above"){
              $c1 = "<";
              $c2 = ">";
        }

        if($m[1] == "below"){
              $c1 = ">";
              $c2 = "<";
        }

        $res = 'compare[func(di_plus,14,0,1,1));'.$c1.';func(adx,14,0,1,1)]&func(di_plus,14));'.$c1.';func(adx,14)]';
      }

      if(preg_match("/\-DI just crossed (above|below) ADX/is",            $filters[$i]->name, $m)){

        if($m[1] == "above"){
              $c1 = "<";
              $c2 = ">";
        }

        if($m[1] == "below"){
              $c1 = ">";
              $c2 = "<";
        }

        $res = 'compare[func(di_minus,14,0,1,1));'.$c1.';func(adx,14,0,1,1)]&func(di_minus,14));'.$c1.';func(adx,14)]';
      }

      if(preg_match("/$TYPE2 just crossed (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                      if($m[1] == "above"){
                        $c1 = "<";
                        $c2 = ">";
                      }

                      if($m[1] == "below"){
                        $c1 = ">";
                        $c2 = "<";
                      }

              $res = 'compare[func('.$type2.',14,0,1,1));'.$c1.';'.$m[2].']&compare[func('.$type2.',14));'.$c2.';'.$m[2].']';

      }


      if(preg_match("/$TYPE3 just crossed (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                      if($m[1] == "above"){
                        $c1 = "<";
                        $c2 = ">";
                      }

                      if($m[1] == "below"){
                        $c1 = ">";
                        $c2 = "<";
                      }

            $res = 'compare[func('.$type3.',14,0,1,1));'.$c1.';'.$m[2].']&compare[func('.$type3.',14));'.$c2.';'.$m[2].']';
      }



      if(preg_match("/$TYPE just crossed (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                      if($m[1] == "above"){
                        $c1 = "<";
                        $c2 = ">";
                      }

                      if($m[1] == "below"){
                        $c1 = ">";
                        $c2 = "<";
                      }

              $res = 'compare[func('.$type.',14,0,1,1));'.$c1.';'.$m[2].']&compare[func('.$type.',14));'.$c2.';'.$m[2].']';

      }


      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function atr($save = 0){ //ADX


    $type = "atr";
    $id = 10;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();
    //1, 2, 7,8,13,14,19,20

    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $res = "";
      if(preg_match("/(Over|Under) ([0-9\.]{1,5})/is",            $filters[$i]->name, $m)){
        if($m[1] == "Over"){
          $c= ">";
        }
        else{
          $c= "<";
        }
        $res = 'compare[func('.$type.',10);'.$c.';'.$m[2].']';

      }


      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function volume($save = 0){ //ADX


    $type = "volume";
    $id = 5;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();
    //1, 2, 7,8,13,14,19,20

    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $res = "";
      if(preg_match("/Volume (more|less) than yesterday/is",            $filters[$i]->name, $m)){
        if($m[1] == "more"){
          $c= ">";
        }
        else{
          $c= "<";
        }
        $res = 'compare[func(volume,0,0,0,1);'.$c.';func(volume,0,0,1,1)]';

      }

      if(preg_match("/Volume (increasing|decreasing) for ([0-9]{1,5})/is",            $filters[$i]->name, $m)){

        $res = $m[1].'[func(volume,0,0,0,'.$m[2].')]';

      }

      if(preg_match("/Volume ([0-9]{1,3}) time[s]{0,1} (higher|less) than yesterday/is",            $filters[$i]->name, $m)){

        if($m[2] == "higher"){
          $c= ">";
        }
        else{
          $c= "<";
        }
        //$res = $m[1].'compare[func(volume,0,0,0,1),'.$c.',func(volume,0,0,1,1)*'.$m[1].']';
        $res = 'compare[func(volume,0,0,0,1);'.$c.';func(volume,0,0,1,1,'.$m[1].')]';

      }

      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function vma($save = 0){ //ADX


    $type = "vma";
    $period = 20;
    $id = 11;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();
    //1, 2, 7,8,13,14,19,20

    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $res = "";


      if(preg_match("/VMA (increasing|decreasing) for ([0-9]{1,5})/is",            $filters[$i]->name, $m)){

        $res = $m[1].'[func(vma,20,0,0,'.($m[2]).')]';

      }
      if(preg_match("/Volume ([0-9]{1,3}) time[s]{0,1} (higher|less) than VMA/is",            $filters[$i]->name, $m)){

        if(mb_strtolower($m[2]) == "higher"){
          $c= ">";
        }
        else{
          $c= "<";
        }
        $res = 'compare[func(volume);'.$c.';func(vma,20,0,1,1,'.$m[1].')]';

      }


      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function obv($save = 0){ //ADX


    $type = "ovb";
    $period = 20;
    $id = 17;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();
    //1, 2, 7,8,13,14,19,20

    $func = "([a-zA-Z0-9]{2,10})";
    for($i = 0; $i < count($filters); $i++){
      $res = "";

      if(preg_match("/OBV (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                      if($m[1] == "above"){
                        $c1 = "<";
                        $c2 = ">";
                      }

                      if($m[1] == "below"){
                        $c1 = ">";
                        $c2 = "<";
                      }

            $res = 'compare[func(obv);'.$c1.';'.$m[2].']';
      }
      if(preg_match("/OBV Crossed (above|below) ([0-9]{1,3})/is",            $filters[$i]->name, $m)){


                      if($m[1] == "above"){
                        $c1 = "<";
                        $c2 = ">";
                      }

                      if($m[1] == "below"){
                        $c1 = ">";
                        $c2 = "<";
                      }

            $res = 'compare[func(obv,0,0,1,1));'.$c1.';'.$m[2].']&compare[func(obv);'.$c2.';'.$m[2].']';
      }
      if(preg_match("/OBV (increasing|decreasing) for at least ([0-9]{1,5})/is",            $filters[$i]->name, $m)){

        $res = $m[1].'[func(obv,0,0,0,'.$m[2].')';

      }
      if(preg_match("/OBV Reached a New ([0-9]{1,4}) (Month|Year) (High|Low)/is",            $filters[$i]->name, $m)){
        if($m[3] == 'Year'){
          $m[1] = $m[1] * 12 * 22;
        }
        else{
          $m[1] = $m[1] * 22;
        }
        if($m[1] == "above"){
          $c1 = "<";
          $c2 = ">";
        }

        if($m[1] == "below"){
          $c1 = ">";
          $c2 = "<";
        }
        $res = 'compare[func(obv);'.$c2.';func(hilo,'.$m[1].')]';

      }




      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function price_change1($save = 0){ //ADX
    $type = "price";
    $period = 20;
    $id = 23;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();

    for($i = 0; $i < count($filters); $i++){
      $res = "";

      if(preg_match("/Price (Up|Down)( [0-9]{1,2}\%|$)/is",            $filters[$i]->name, $m)){

        $percent = 0;
        if(!empty($m[2])){
          $percent = $m[2] * 0.01;
        }
                      if($m[1] == "Up"){
                        $c1 = ">";
                        $c2 = "<";

                      }

                      if($m[1] == "Down"){
                        $c1 = "<";
                        $c2 = ">";
                        $percent = -1 * $percent;
                      }

            $res = 'compare[func(price);'.$c1.';func(price,"",'.$percent.',1,1)]';
      }



      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='80'>".$res."</textarea><textarea>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }

  public function price_change2($save = 0){ //ADX
    $type = "price";
    $period = 20;
    $id = 29;



    $filters = Filter::whereIn('id_kindfilter', array($id))->get();

    for($i = 0; $i < count($filters); $i++){
      $res = "";

      if(preg_match("/([0-9]{1,2}) days Channel (up|down)/is",            $filters[$i]->name, $m)){

            $res = 'func(change_price2,'.$m[1].','.$m[2].')';
      }

      if(preg_match("/([0-9]{1,2}) days Channel (up|down) & (?:price close|price) (to upper|to lower|bounced off upper|bounced off lower)/is",            $filters[$i]->name, $m)){

            $res = 'func(change_price2,'.$m[1].','.$m[2].')&func(price,'.$m[3].')';
      }

      //echo $res;
  //    echo "<br>$replace<br>";
      $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
    echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$filters[$i]->name."</textarea>$i<br>";


    }
    echo "</table>";
  }


    public function HiLo($save = 0){ //ADX
      $type = "price";
      $period = 20;
      //$id = 29;



      $filters = Filter::whereIn('id_kindfilter', array(6,12,18,24,30,34))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        if(preg_match("/price is (above|below) previous (weekly|monthly|quarterly) (high|low)/is",            $name, $m)){
            if($m[1] == "above"){
              $c = ">";
            }
            if($m[1] == "below"){
              $c = "<";
            }

            $res = 'compare[func(price);'.$c.';func(hilo,'.$m[2].','.$m[3].',0,previous)]';
        }

        if(preg_match("/price just crossed (above|below) previous (weekly|monthly|quarterly) (high|low)/is",            $filters[$i]->name, $m)){

              if(empty($m[1])) { $direct = "any"; }
              elseif($m[1] == "below") { $direct = "up_to_down"; }
              elseif($m[1] == "above") { $direct = "down_to_up"; }

              //  print_r($m);
              $res = 'cross[func(price,0,0,0,2);'.$direct.';func(hilo,'.$m[2].','.$m[3].',0,previous)]';
              //$res = 'func(HiLo,'.$m[1].','.$m[2].',cross)';
        }

        if(preg_match("/price just created new (daily|weekly|monthly) (high|low)/is",            $filters[$i]->name, $m)){

            if(mb_strtolower($m[2]) == "high") { $c = ">"; }
            if(mb_strtolower($m[2]) == "low") { $c = "<"; }

              $res = 'compare[func(price);'.$c.';func(hilo,'.$m[1].','.$m[2].')]';
        }


        if(preg_match("/new (low|high) in last (\d{0,3}) days/is",            $filters[$i]->name, $m)){
          if($m[1] == "high") { $c = ">"; }
          if($m[1] == "low") { $c = "<"; }
              $res = 'compare[func(price);'.$c.';func(hilo,'.$m[2].','.$m[1].')]';
        }

        if(preg_match("/0\-(\d{0,3})\% (below|above) (\d{0,3}) days (low|high)/is",            $filters[$i]->name, $m)){
            if($m[2] == "above"){
              $c = ">";
            }
            if($m[2] == "below"){
              $c = "<";
            }
            $percent = $m[1];
            if($m[2] == 'below'){
              $percent = -1 * $percent;
            }
            $percent = 0.01 * $percent;
            $res = 'compare[func(price);'.$c.';func(hilo,'.$m[3].','.$m[4].','.$percent.')]';
        }

        if(preg_match("/price (historical|5 years|1 year|6 months|3 months|1 months) (high|low)/is",            $filters[$i]->name, $m)){
            $c = ">";
            if($m[2]=='low') {$c = "<";}
            $res = 'compare[func(price);'.$c.';func(hilo,'.$m[1].','.$m[2].')]';
        }


        if(preg_match("/price 0\-(\d{0,3})\% (below|above) (historical|5 years|1 year[s]{0,1}|6 months|3 months|1 months) (high|low)/is",            $filters[$i]->name, $m)){
            $percent = $m[1];
            if($m[2] == "above"){
              $c = ">";
            }
            if($m[2] == "below"){
              $c = "<";
            }
            if($m[2] == 'below'){
              $percent = -1 * $percent;
            }
            $percent = 0.01 * $percent;
            $res = 'compare[func(price);'.$c.';func(hilo,'.$m[3].','.$m[4].','.$percent.')]';
        }
        //echo $res;
    //    echo "<br>$replace<br>";
        $res = mb_strtolower($res);
        $filters[$i]->value = '{'.$res.'}';
        if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }

    public function supres($save = 0){ //ADX
      $type = "price";
      $period = 20;
      $id = 33;



      $filters = Filter::whereIn('id_kindfilter', array($id))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        if(preg_match("/0\-(\d{0,3})\% (below|above) (\d{0,4}) days (resistance|support) line/is",            $filters[$i]->name, $m)){
            if($m[2] == "above"){
              $c = ">";
            }
            if($m[2] == "below"){
              $c = "<";
            }
            $percent = $m[1];
            if($m[2] == 'below'){
              $percent = -1 * $percent;
            }
            $percent = 0.01 * $percent;
            $res = 'compare[func(price);'.$c.';func(supres,'.$m[3].','.$m[4].','.$percent.')]';
        }
    //    echo "<br>$replace<br>";
        $filters[$i]->value = '{'.mb_strtolower($res).'}';
        if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }

    public function macd($save = 0){ //ADX
      $type = "price";
      $period = 20;
      $id = 16;



      $filters = Filter::whereIn('id_kindfilter', array($id))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        if(preg_match("/macd (bullish|bearish) crossover( ([0-9]{1,3}) days ago|$)/is",            $filters[$i]->name, $m)){
          /*
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'divergence[func(macd,26.12.9,'.$m[1].$v.')';
          */

          $v = ',0,0,2,1,1';
          if(!empty($m[3])){
            $v = ',0,'.$m[3].',2,1,1';
          }
          $res = 'divergence[func(macd,26.12.9'.$v.');'.$m[1].']';
        }
        if(preg_match("/macd (slow|fast) line (above|below) (<|>)\d{1,2}/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[1].$v.')';
        }

        if(preg_match("/macd (bearish|bullish) crossover \& macd (slow|fast) line (above|below) (<|>)\d{1,2}/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[0].')';
        }

        if(preg_match("/macd (fast|slow) line (decreasing|increasing) for (\d+) day[s]{0,1}/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[1].$v.')';
        }

        if(preg_match("/macd (slow|fast) line (<|>)(\d+) \& (decreasing|increasing) for (\d+) day[s]{0,1}/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[0].')';
        }
        if(preg_match("/macd (converging|diverging)/is",            $filters[$i]->name, $m)){
          /*
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[0].')';
          */


          $v = ',0,0,2,1,1';
          if(!empty($m[3])){
            $v = ',0,'.$m[3].',2,1,1';
          }
          $res = 'divergence[func(macd,26.12.9'.$v.');'.$m[1].']';
        }
        if(preg_match("/macd (converging|diverging) \& macd (slow|fast) line (<|>)\d{1,2}/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(macd,26.12.9,'.$m[0].')';
        }


    //    echo "<br>$replace<br>";
        $filters[$i]->value = '{'.mb_strtolower($res).'}';
        if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }

    public function bb($save = 0){ //ADX
      $type = "price";
      $period = 20;
      $id = 22;



      $filters = Filter::whereIn('id_kindfilter', array($id))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        if(preg_match("/price (above|below) (upper|lower) bollinger band/is",            $filters[$i]->name, $m)){
          if($m[1] == "above"){
            $c = ">";
          }
          if($m[1] == "below"){
            $c = "<";
          }

          $res = 'compare[func(price);'.$c.';func(bb,20.2,'.$m[2].')]';
        }
        if(preg_match("/price crossed (above|below) (upper|lower) bollinger band/is",            $filters[$i]->name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}

          if($m[1] == "below") { $direct = "down_to_up"; }
          else {$direct = "up_to_down";}

        //  $res = 'func(bb,20.2,'.$m[0].$v.')';
          $res = 'cross[func(price);'.$direct.';func(bb,20.2,'.$m[2].')]';
        }

        if(preg_match("/price (\d+)\% near (upper|lower) bollinger band/is",            $filters[$i]->name, $m)){

          $percent = 0.01 * $m[1];
          //  $res = 'func(bb,20.2,'.$m[0].','.$percent.')';
          $res = 'compare[func(price);<;func(bb,20.2,'.$m[2].','.$percent.')]&compare[func(price);>;func(bb,20.2,'.$m[2].','.(-1*$percent).')]';
        }

        if(preg_match("/upper \& lower bollinger bands are (converging|diverging)/is",            $filters[$i]->name, $m)){
          $v = '';

          $res = 'func(bb,20.2,'.$m[1].')';
        }

        if(preg_match("/Price bounced off (upper) bollinger band/is",            $filters[$i]->name, $m)){
          $v = '';

          $res = 'compare[func(price,0,2,1);<;func(bb,20.2,'.$m[1].',0,2)]&'.
                  'compare[func(price,0,1,1);>;func(bb,20.2,'.$m[1].',0,1)&'.
                  'compare[func(price);<;func(bb,20.2,'.$m[1].')';
        }
        if(preg_match("/Price bounced off (lower) bollinger band/is",            $filters[$i]->name, $m)){
          $v = '';

          $res = 'compare[func(price,0,2,1);>;func(bb,20.2,'.$m[1].',0,2)]&'.
                  'compare[func(price,0,1,1);<;func(bb,20.2,'.$m[1].',0,1)&'.
                  'compare[func(price);>;func(bb,20.2,'.$m[1].')';
        }

    //    echo "<br>$replace<br>";
        $filters[$i]->value = '{'.mb_strtolower($res).'}';
      if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }


        public function william($save = 0){ //ADX

          $id = 31;



          $filters = Filter::whereIn('id_kindfilter', array($id))->get();

          for($i = 0; $i < count($filters); $i++){
            $res = "";

            $name = mb_strtolower($filters[$i]->name);
            if(preg_match("/william \%r (<|>)([\-0-9 ]{1,4})/is",           $name, $m)){
              $v = '';
              if(!empty($m[2])){$v = ','.$m[2];}
              $res = 'compare[func(william,14);'.$m[1].';'.$m[2].']';
            }
            if(preg_match("/william \%r (decreasing|increasing) for ([0-9]{1,4}) day/is",            $filters[$i]->name, $m)){

              $res = $m[1].'[func(william,14,0,0,'.$m[2].')]';

            }
            if(preg_match("/william \%r just entered into \((<|>)([\-0-9]{1,4})\)/is",            $filters[$i]->name, $m)){


              if($m[1] == ">"){
                $c1 = "<";
                $c2 = ">";
              }

              if($m[1] == "<"){
                $c1 = ">";
                $c2 = "<";
              }
              //echo $m[1].' c1:'.$c1.' c2:'.$c2;
              $res = 'compare[func(william,14,0,1,1);'.$c1.';'.$m[2].']&compare[func(william,14);'.$c2.';'.$m[2].']';

            }

            if(preg_match("/william \%r (<|>)([\-0-9 ]{1,4}) \& (decreasing|increasing) for ([0-9]{1,4}) day/is",           $name, $m)){
              $v = '';
              if(!empty($m[2])){$v = ','.$m[2];}
              $res = 'compare[func(william,14);'.$m[1].';'.$m[2].']&'.$m[3].'[func(william,14,0,0,'.$m[4].')]';
            }

        //    echo "<br>$replace<br>";
        $res = str_replace(' ','', $res);
            $filters[$i]->value = '{'.mb_strtolower($res).'}';
            if($save == 1) {$filters[$i]->save();}
          echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


          }
          echo "</table>";
        }

    public function divergence($save = 0){ //ADX

      $id = 28;



      $filters = Filter::whereIn('id_kindfilter', array($id))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        /*
        if(preg_match("/(macd|rsi|cci|slow stochastic|fast stochastic|mfi|adx)( strong|) (bullish|bearish) divergence( in last (\d+) day[s]{0,1}|$)/is",           $name, $m)){
          $v = '';
          if(!empty($m[2])){$v = ','.$m[2];}
          $res = 'func(divergence,20.2,'.$m[0].')';
        }
        */

        if(preg_match("/macd (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = ',0,0,2,1,1';
          if(isset($m[4])){
            $v = ',0,'.$m[4].',2,1,1';
          }
          $res = 'divergence[func(macd,26.12.9'.$v.');'.$m[1].']';
        }
        if(preg_match("/rsi (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = '';
          if(isset($m[4])){
            $v = ',0,0,'.$m[4];
          }
          $res = 'divergence[func(rsi,14'.$v.');'.$m[1].']';
        }
        if(preg_match("/cci (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = '';
          if(isset($m[4])){
            $v = ',0,0,'.$m[4];
          }
          $res = 'divergence[func(cci,14'.$v.');'.$m[1].']';
        }
        if(preg_match("/mfi (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = '';
          if(isset($m[4])){
            $v = ',0,0,'.$m[4];
          }
          $res = 'divergence[func(mfi,14'.$v.');'.$m[1].']';
        }
        if(preg_match("/adx (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = '';
          if(isset($m[4])){
            $v = ',0,0,'.$m[4];
          }
          $res = 'divergence[func(adx,14'.$v.');'.$m[1].']';
        }
        if(preg_match("/fast stochastic (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = ',0,0,2,1,1';
          if(isset($m[4])){
            $v = ',0,'.$m[4].',2,1,1';
          }

          $res = 'divergence[func(fstochastic,14.3'.$v.');'.$m[1].']';
        }
        if(preg_match("/slow stochastic (bullish|bearish|strong bullish|strong bearish) (converging|divergence)( in last (\d+) day[s]{0,1}|$)/is",            $filters[$i]->name, $m)){
          $v = ',0,0,2,1,1';
          if(isset($m[4])){
            $v = ',0,'.$m[4].',2,1,1';
          }
          $res = 'divergence[func(lstochastic,14.3.3'.$v.');'.$m[1].']';
        }
    //    echo "<br>$replace<br>";
        $filters[$i]->value = '{'.mb_strtolower($res).'}';
        if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }

    public function candlestick($save=0){ //ADX

      $id = 32;



      $filters = Filter::whereIn('id_kindfilter', array($id))->get();

      for($i = 0; $i < count($filters); $i++){
        $res = "";

        $name = mb_strtolower($filters[$i]->name);
        $patterns = array();
        $patterns[0] = '/bearish engulfing/is';
        $patterns[1] = '/bearish harami/is';
        $patterns[2] = '/bullish engulfing/is';
        $patterns[3] = '/bullish harami/is';
        $patterns[4] = '/dark cloud cover/is';

        $patterns[5] = '/dragonfly doji/is';
        $patterns[6] = '/evening star/is';
        $patterns[7] = '/falling three methods/is';
        $patterns[8] = '/filled black candles/is';
        $patterns[9] = '/gravestone doji/is';
        $patterns[10] = '/hammer/is';
        $patterns[11] = '/morning doji star/is';
        $patterns[12] = '/piercing line/is';
        $patterns[13] = '/shooting star/is';
        $patterns[14] = '/three black crows/is';
        $patterns[15] = '/three white soldiers/is';
        $patterns[16] = '/rising three methods/is';
        $patterns[17] = '/hollow red candles/is';





        $replacements = array();
        $replacements[0] = 'func(bearish_trader_cdlengulfing)';
        $replacements[1] = 'func(bearish_trader_cdlharami)';
        $replacements[2] = 'func(bullish_trader_cdlengulfing)';
        $replacements[3] = 'func(bullish_trader_cdlharami)';
        $replacements[4] = 'func(trader_cdldarkcloudcover)';
        $replacements[5] = 'func(trader_cdldragonflydoji)';
        $replacements[6] = 'func(trader_cdleveningstar)';
        $replacements[7] = 'func(trader_cdlrisefall3methods)';
        $replacements[8] = 'func(trader_cdl_filled_black_candles)';
        $replacements[9] = 'func(trader_cdlgravestonedoji)';
        $replacements[10] = 'func(trader_cdlhammer)';
        $replacements[11] = 'func(trader_cdlmorningdojistar)';
        $replacements[12] = 'func(trader_cdlpiercing)';
        $replacements[13] = 'func(trader_cdlshootingstar)';
        $replacements[14] = 'func(trader_cdl3blackcrows)';
        $replacements[15] = 'func(trader_cdl_three_white_soldiers)';
        $replacements[16] = 'func(trader_cdlrisefall3methods)';
        $replacements[17] = 'func(trader_cdl_hollow_red_candles)';

        $res = preg_replace($patterns, $replacements, $name);
    //    echo "<br>$replace<br>";
        $filters[$i]->value = '{'.mb_strtolower($res).'}';
        if($save == 1) {$filters[$i]->save();}
      echo $filters[$i]->id_kindfilter."<textarea cols='70'>".$res."</textarea><textarea cols='60'>".$name."</textarea>$i<br>";


      }
      echo "</table>";
    }
}
