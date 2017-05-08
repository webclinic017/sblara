<?php

namespace App\Library;
use App\Library\Logger;
use App\Market;
use App\DataBanksEod;

class Functions{

    private $log;

    public function __construct($log=false){
      $this->log = new Logger($log);
    }

    public function func($data, $params, $instrument = 0){

      $this->log->insert($params,"params",__FUNCTION__."|".__CLASS__);

      $type = (isset($params[0]) ? $params[0] : 'sma');
      $period = (isset($params[1]) ? $params[1] : 20);
      $percent = (isset($params[2]) ? ($params[2]) : 0);
      $times_ago = (isset($params[3]) ? $params[3] : 0);
      $count = (isset($params[4]) ? $params[4] : 1);
      $factor = (isset($params[5]) ? $params[5] : 1);
      $divergence = (isset($params[6]) ? $params[6] : 0);

      $this->log->insert('type:'.$type.' period:'.$period.' percent:'.$percent.' times_ago:'.$times_ago.' count:'.$count.' factor:'.$factor
                            .' divergence:'.$divergence,"params",__FUNCTION__."|".__CLASS__);

      if($type=="sma") { $array = trader_sma($this->prepare_data($data, 'close'), $period); }
      if($type=="ema") { $array = trader_ema($this->prepare_data($data, 'close'), $period); }
      if($type=="vma") { $array = trader_ma($this->prepare_data($data, 'volume'), $period); }
      if($type=="ma")  { $array = trader_ma($this->prepare_data($data, 'close'), $period);  }

      if($type=="william") { $array = trader_willr($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }
      if($type=="rsi") { $array = trader_rsi($this->prepare_data($data, 'close', $period)); }
      if($type=="mfi") { $array = trader_mfi ($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $this->prepare_data($data, 'volume'), $period); }

      if($type=="adx") { $array = trader_adx($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }
      if($type=="di_minus") { $array = trader_minus_di ($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }
      if($type=="di_plus") { $array = trader_plus_di($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }

      if($type=="atr") { $array = trader_atr($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }
      if($type=="cci") { $array = trader_cci($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'), $period); }
      if($type=="obv") { $array = trader_obv ($this->prepare_data($data, 'close'), $this->prepare_data($data, 'volume')); }

      if($type=="price") { $array = $this->prepare_data($data, 'close'); }
      if($type=="volume") { $array = $this->prepare_data($data, 'volume', $period); }

      if($type=="bb") { return $this->bb(trader_bbands($this->prepare_data($data, 'close'), 14,  explode(".",$period)[0],explode(".",$period)[1]), $params); }

      if($type=="hilo") { return $this->hilo($data, $params,$instrument); }
      if($type=="supres") { return $this->supres($data, $params,$instrument); }

      if($type=="change_price2") {
        // This category isn't imnplemented, because TA-Lib isn't support Channel, Chanel line
      }

      if($type=="fstochastic") {
        $array = trader_stochf($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'),
                          explode(".",$period)[0],explode(".",$period)[1]);

        if($divergence == 0){
          $array = $array[0];
        }
        else{
          $arr[0] = $this->get_data($this->remove_offset($array[0]), $times_ago, $count, $percent);
          $arr[1] = $this->get_data($this->remove_offset($array[1]), $times_ago, $count, $percent);

          $this->log->insert($a[0],"a[0][]",__FUNCTION__."|".__CLASS__, true);
          $this->log->insert($a[1],"a[1][]",__FUNCTION__."|".__CLASS__, true);

          return $arr;
        }

      }
      if($type=="lstochastic") {
        $array = trader_stoch($this->prepare_data($data, 'high'),$this->prepare_data($data, 'low'),$this->prepare_data($data, 'close'),
                          explode(".",$period)[0],explode(".",$period)[1],explode(".",$period)[2]);
        if($divergence == 0){
          $array = $array[0];
        }
        else{
          $arr[0] = $this->get_data($this->remove_offset($array[0]), $times_ago, $count, $percent);
          $arr[1] = $this->get_data($this->remove_offset($array[1]), $times_ago, $count, $percent);

          return $arr;
        }
      }
      if($type=="macd") {
        $array = trader_macd($this->prepare_data($data, 'close'), explode(".",$period)[0],explode(".",$period)[1],explode(".",$period)[2]);

        if($divergence == 0){
          // here will need implement functional of get Slow and Fast lines.
          return false;
        }
        else{
          $arr[0] = $this->get_data($this->remove_offset($array[0]), $times_ago, $count, $percent);
          $arr[1] = $this->get_data($this->remove_offset($array[1]), $times_ago, $count, $percent);
          $arr[2] = $this->get_data($this->remove_offset($array[2]), $times_ago, $count, $percent);

          return $arr;
        }
      }
      if(preg_match("/.*?trader_cdl.*?/is", $type)){
        $open = $this->prepare_data($data, 'open');
        $high = $this->prepare_data($data, 'high');
        $low = $this->prepare_data($data, 'low');
        $close = $this->prepare_data($data, 'close');
        $length = count($open);

        if($type == "trader_cdl_three_white_soldiers"){
          if($open[$length-3] < $open[$length-2] && $open[$length-2] < $open[$length-1] && $close[$length-3] < $close[$length-2] && $close[$length-2] < $close[$length-1]) {
            return true;
          }

          return false;
        }

        if($type == "trader_cdl_hollow_red_candles"){
          // didn't find function in TA-Lib

          return false;
        }

        if($type == "trader_cdl_filled_black_candles"){
          if($open[$length-1] > $close[$length-1] && $open[$length-1] == $hight[$length-1] && $close[$length-1] == $low[$length-1]) {
            return true;
          }

          return false;
        }

        if($type == "bearish_trader_cdlengulfing"){
          if($open[$length-1] > $close[$length-1]) {
            if(trader_cdlengulfing($open,$high,$low,$close)) { return true;}
          }

          return false;
        }

        if($type == "bullish_trader_cdlengulfing"){
          if($open[$length-1] < $close[$length-1]) {
            if(trader_cdlengulfing($open,$high,$low,$close)) { return true;}
          }
          return false;
        }

        if($type == "bearish_trader_cdlharami"){
          if($open[$length-1] > $close[$length-1]) {
            if(trader_cdlharami($open,$high,$low,$close)) { return true;}
          }
          return false;
        }

        if($type == "bullish_trader_cdlharami"){
          if($open[$length-1] < $close[$length-1]) {
            if(trader_cdlharami($open,$high,$low,$close)) { return true;}
          }

          return false;
        }

        $array = $type($open,$high,$low,$close);
        return $array;
      }

    //  if(!isset($array)) {return false;}
    //  if(!empty($array)) {return false;}

      return $this->get_data($this->remove_offset($array,$factor), $times_ago, $count, $percent);


    }

    private function hilo($data, $params, $id_instrument){
      $this->log->insert($params,"params",__FUNCTION__."|".__CLASS__, true);
      $this->log->insert($id_instrument,"id_instrument",__FUNCTION__."|".__CLASS__, true);

      $percent = (isset($params[3]) ? ($params[3]) : 0);
      if(isset($params[1]) && isset($params[2])){
        $period = $params[1];
        $column = $params[2];
      }
      else {
        return false;
      }

      if(is_numeric($period))
      {
        $data = $this->prepare_data($data, $column, $period);
        if($column == 'high'){
            $max = max($data);
            $this->log->insert($max,"max",__FUNCTION__."|".__CLASS__, true);
            return $max + $percent * $max;
        }
        if($column == 'low'){
            $min = min($data);
            $this->log->insert($min,"min",__FUNCTION__."|".__CLASS__, true);
            return $min + $percent * $min;
        }
      }
      else{
        $this->log->insert($data,"NOT NUMERIC",__FUNCTION__."|".__CLASS__, true);
        if($period == 'weekly') { $ids = Market::getWeeklyTradeDates(); }
        if($period == 'monthly') { $ids = Market::getMonthlyTradeDates(); }
        if($period == 'quarterly') { $ids = Market::getQuarterlyTradeDates(); }

        // Functional don't full implemented, because don't correct work Market
        // *********
        if($period == 'daily') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }
        if($period == 'historical') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }

        if($period == '5years') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }

        if($period == '1year') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }

        if($period == '6months') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }
        if($period == '1months') {
          $value = DataBanksEod::where('instrument_id', $id_instrument)->ofMaxMin($column);

          return $value + $percent * $value;
        }
        // ***** end

        if($period == 'years') { $ids = Market::getYearsTradeDates(); }

        $count = $ids[0]->id - $ids[1]->id;
        if(isset($params[4])) { // means look previous week|day|month and other
          return DataBanksEod::where('market_id','>=', $ids[1]->id)->where('market_id','<', ($ids[1]->id + $count))->where('instrument_id', $id_instrument)->ofMaxMin($column);
        }
        else{                   // means loook current week|day|month and other
          return DataBanksEod::where('market_id','>=', $ids[0]->id)->where('market_id','<', ($ids[0]->id + $count))->where('instrument_id', $id_instrument)->ofMaxMin($column);
        }
      }
    }

    private function supres($data, $params, $id_instrument){
      //$ids = Market::getMonthlyTradeDates();//->pluck('id');
      $this->log->insert($params,"params",__FUNCTION__."|".__CLASS__, true);
      $this->log->insert($id_instrument,"id_instrument",__FUNCTION__."|".__CLASS__, true);
      $percent = (isset($params[3]) ? ($params[3]) : 0);
      if(isset($params[1]) && isset($params[2])){
        $period = $params[1];
        $column = $params[2];
      }
      else {
        return false;
      }

      if(is_numeric($period))
      {
        if($column == 'resistance'){
            $max = max($this->prepare_data($data, 'high', $period));
            $this->log->insert($max,"max",__FUNCTION__."|".__CLASS__, true);
            return $max + $percent * $max;
        }
        if($column == 'support'){
            $min = min($this->prepare_data($data, 'low', $period));
            $this->log->insert($min,"min",__FUNCTION__."|".__CLASS__, true);
            return $min + $percent * $min;
        }
      }
    }

    private function bb($array, $arg){
      $this->log->insert($arg,"arg",__FUNCTION__."|".__CLASS__);
      $this->log->insert($array[0],"array[0]",__FUNCTION__."|".__CLASS__);
      $this->log->insert($array[2],"array[2]",__FUNCTION__."|".__CLASS__);
      // upper $array[0]
      // central line $array[1]
      // lower $array[2]
      $days_ago = (isset($arg[4]) ? $arg[4] : 0);
      $percent = 0;
      $bounced = "";
      if(isset($arg[3])){
        if(is_numeric($arg[3])) {$percent = $arg[3];}
        $bounced = $arg[3];
      }

      if(isset($arg[2])){  //type bullish bearish slowline fastline converging diverging

        if($arg[2] == 'upper'){
          return $array[0][count($array[0]) - 1 - $days_ago] + $percent * $array[0][count($array[0]) - 1 - $days_ago];
        }
        if($arg[2] == 'lower'){
          return $array[2][count($array[0]) - 1 - $days_ago] + $percent *$array[2][count($array[2]) - 1 - $days_ago];
        }
        if($arg[2] == 'converging'){
          $res = abs($array[0][count($array[0]) - 1 - $days_ago] - $array[2][count($array[2]) - 1 - $days_ago]) - abs($array[2][count($array[2]) - 1 - $days_ago] - $array[2][count($array[2]) - 1 - $days_ago]);
          if($res > 0){
            return true;
          }
          else{
            return false;
          }
        }
        if($arg[2] == 'diverging'){
          $res = abs($array[0][count($array[0]) - 1 - $days_ago] - $array[2][count($array[2]) - 1 - $days_ago])- abs($array[2][count($array[2]) - 1 - $days_ago] - $array[2][count($array[2]) - 1 - $days_ago]);
          if($res < 0){
            return true;
          }
          else{
            return false;
          }
        }

        if($arg[2] == 'upper' && $bounced == 'bounced'){

        }
        if($arg[2] == 'lower' && $bounced == 'bounced'){

        }
      }
      return false;
    }

    private function get_data($data, $times_ago = 0, $count = 1, $percent = 0){

      $arr = array();
      for($i = $count - 1; $i >= 0; $i--)
      {
        $arr[] = $data[count($data)- $i - $times_ago - 1];
      }

      return $arr;
    }

    private function prepare_data($data, $column, $count=0){
      $response = array();
      if($count == 0) { $count = count($data); }
      for($i = count($data) - $count; $i < count($data); $i++){
        if(isset($data[$i][$column])){
          $response[count($data) - $i - 1] = $data[$i][$column];
        }

      }
      return $response;
    }

    private function remove_offset($data, $factor = 1){
      $arr = array();

      foreach ($data as $arr1) { $arr[] = $arr1 * $factor; }

      return $arr;
    }

}

?>
