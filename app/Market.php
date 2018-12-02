<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Market extends Model
{
    protected $fillable = ['data_bank_intraday_batch', 'batch_total_trades'];
    protected $dates = [
        'trade_date',
    ];

    public function getMarketStartedAttribute($value) {
        return Carbon::parse($value);
    }

    public function getMarketClosedAttribute($value) {
        return Carbon::parse($value);
    }

    public function exchange()
    {
        return $this->belongsTo('App\Exchange');
    }

    /*
   * Tinker sample command
   * php artisan tinker
   * $e=new App\Repositories\ExchangeRepository;
   * $e=new App\Market
   * $e->getActiveDates(7,'2015-12-24',1)
   *
   * $tradeDate = Null will return market id from today
   * data_bank_intraday_batch > 0 will remove today market_id before trade started. So home page will not show dataless before trade
   * */

    public static function getActiveDates($limit=1,$tradeDate=null,$exchangeId=0)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $cacheVar="tradeDateList$tradeDate$limit$exchangeId";
   
        // Cache::forget("$cacheVar");
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId,$tradeDate,$limit)  {

            if(is_null($tradeDate))
            {

                $returnData = static::whereHas('exchange', function($q) use($exchangeId) {
                    $q->where('exchange_id',$exchangeId);
                })->whereDate('trade_date','<=',DB::raw('CURDATE()'))->where('data_bank_intraday_batch','>',0)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();


            }else
            {
                $returnData = static::whereHas('exchange', function($q) use($exchangeId) {
                    $q->where('exchange_id',$exchangeId);
                })->whereDate('trade_date','<=',$tradeDate)->where('data_bank_intraday_batch','>',0)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();

            }

            return $returnData;

        });
       
        return $returnData;

    }
    public static function getChartActiveDates($limit=1,$tradeDate=null,$exchangeId=0)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $cacheVar="chartTradeDateList$tradeDate$limit$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId,$tradeDate,$limit)  {

            if(is_null($tradeDate))
            {

                $returnData = static::whereHas('exchange', function($q) use($exchangeId) {
                    $q->where('exchange_id',$exchangeId);
                })->whereDate('trade_date','<=',DB::raw('CURDATE()'))->where('data_bank_intraday_batch','>',0)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();
            }else
            {
                $returnData = static::whereHas('exchange', function($q) use($exchangeId) {
                    $q->where('exchange_id',$exchangeId);
                })->whereDate('trade_date','<=',$tradeDate)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();

            }

            return $returnData;

        });


        return $returnData;

    }

    /*
     * This will return last trading day of every month
     * */

    public static function getMonthlyTradeDates($limit=12,$tradeDate=null,$exchangeId=0)
    {
        //We will use session value of active_trade_date as default if exist
        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        if(is_null($tradeDate))
        {
            $tradeDateList=DB::select("SELECT id,MAX(trade_date) as trade_date,market_started,market_closed FROM markets
        WHERE exchange_id=$exchangeId and trade_date<=CURDATE()
        GROUP BY YEAR(trade_date), MONTH(trade_date)
        ORDER BY trade_date DESC LIMIT 0,$limit");

        }else
        {
            $tradeDateList=DB::select("SELECT id,MAX(trade_date) as trade_date,market_started,market_closed FROM markets
        WHERE exchange_id=$exchangeId and trade_date<='$tradeDate'
        GROUP BY YEAR(trade_date), MONTH(trade_date)
        ORDER BY trade_date DESC LIMIT 0,$limit");

        }


        return $tradeDateList;


    }

    public static function getWeeklyTradeDates($limit=12,$tradeDate=null,$exchangeId=0)
    {
        //We will use session value of active_trade_date as default if exist
        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        if(is_null($tradeDate))
        {
            $tradeDateList=DB::select("SELECT id,MAX(trade_date) as trade_date,market_started,market_closed FROM markets
        WHERE exchange_id=$exchangeId and trade_date<=CURDATE()
        GROUP BY YEAR(trade_date), MONTH(trade_date),WEEK(trade_date)
        ORDER BY trade_date DESC LIMIT 0,$limit");

        }else
        {
            $tradeDateList=DB::select("SELECT id,MAX(trade_date) as trade_date,market_started,market_closed FROM markets
        WHERE exchange_id=$exchangeId and trade_date<='$tradeDate'
        GROUP BY YEAR(trade_date), MONTH(trade_date),WEEK(trade_date)
        ORDER BY trade_date DESC LIMIT 0,$limit");

        }
        return $tradeDateList;


    }

    /*
     * Config/App.php we have set 'timezone' => 'Asia/Dhaka'
     * So carbon/php will return time of bd
     *
     * */

    public static function isMarketOpen($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $now = Carbon::now();

        // here condition  where('data_bank_intraday_batch','>',0) is not applicable
        $activeTradeDates = static::whereHas('exchange', function ($q) use ($exchangeId) {
            $q->where('exchange_id', $exchangeId);
        })->whereDate('trade_date', '<=', DB::raw('CURDATE()'))->orderBy('trade_date', 'desc')->skip(0)->take(1)->get()->first();


        // adding 5 minutes with market close time. It is needed to ensure run cron at 2.30 minutes to take latest data
        $activeTradeDates->market_closed=$activeTradeDates->market_closed->addMinutes(5);

        // It was not wise keeping the start_time and end time as time data type. It should be date_time.
        // For this mistake we have to join time with date here

        $market_started=$activeTradeDates->trade_date->format('Y-m-d').' '.$activeTradeDates->market_started->format('H:i');
        $market_started=Carbon::parse($market_started);
        $market_closed=$activeTradeDates->trade_date->format('Y-m-d').' '.$activeTradeDates->market_closed->format('H:i');
        $market_closed=Carbon::parse($market_closed);

       /* dump($now);
        dump($market_started);
        dump($market_closed);*/

        if($now->gte($market_started) and $now->lte($market_closed))
        {
            return true;
        }
        else
        {
            return false;
        }
            //return false;


    }


    /*
     * This function is used in EodIntradayCommand
     * It will return last valid trade date or false
     *
     * */

    public static function validateTradeDate($trade_date_to_validate=null, $exchangeId = 0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if (!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $trade_date_to_validate=Carbon::parse($trade_date_to_validate);
       // $activeTradeDates = self::getActiveDates(1, null, $exchangeId)->first();

        // here condition  where('data_bank_intraday_batch','>',0) is not applicable
        $activeTradeDates = static::whereHas('exchange', function($q) use($exchangeId) {
            $q->where('exchange_id',$exchangeId);
        })->whereDate('trade_date','<=',DB::raw('CURDATE()'))->orderBy('trade_date', 'desc')->skip(0)->take(1)->get()->first();



        if ($trade_date_to_validate->eq($activeTradeDates->trade_date))
            return $activeTradeDates;
        else
            return false;
    }

/*latest market methods. (if holiday then previous) */
    public static function gainerLoserMinuteChart()
    {
        $query = "
                    SELECT *, COUNT(priceChange) as items FROM  (SELECT 
                    IF( (close_price - yday_close_price) > 0, 1, IF( (close_price - yday_close_price) < 0 , -1, 0) ) as priceChange,
                    `trade_time`
                    FROM `data_banks_intradays` WHERE `market_id` = (SELECT id FROM `markets`  
                    where data_bank_intraday_batch != 0
                    ORDER BY `markets`.`trade_date` DESC
                    LIMIT 1) and batch != 0) AS priceChange
                    GROUP BY priceChange, trade_time  
                    ORDER BY `priceChange`.`trade_time`  ASC
        ";
        $data = new \stdClass();
        $data->times = [];
        $data->gainers = [];
        $data->losers = [];
        $data->unchanges = [];
        $rows = \DB::select(\DB::raw($query));
        $prev;
        foreach ($rows as $key => $row) {
            $prev = $row->trade_time;
            $data->times[] = $row->trade_time;
            if($row->priceChange > 0)
            {
                $data->gainers[] = $row->priceChange;
            }else if($row->priceChange < 0)
            {
                $data->losers[] = $row->priceChange;
            }else{
                $data->unchanges[] = $row->priceChange;
            }
        }

        return $data;
    }
/**/

    public static function indexValue()
    {
        return $index = \App\IndexValue::orderBy('date_time', 'desc')->where('instrument_id', 10001)->first();
    }

    public static function upCount()
    {
        $excludedInstruments = join( ', ', excludedInstruments());
        $batch = self::latestBatch();
        $query = "SELECT COUNT(id) as total FROM data_banks_intradays WHERE batch = '$batch' AND instrument_id not in ($excludedInstruments) AND (yday_close_price - close_price) < 0";
        $count =  \DB::select(\DB::raw($query))[0]->total;
        return $count;
    }
    public static function downCount()
    {
        $excludedInstruments = join( ', ', excludedInstruments());
        $batch = self::latestBatch();
        $query = "SELECT COUNT(id) as total FROM data_banks_intradays WHERE batch = '$batch'  AND instrument_id not in ($excludedInstruments) AND (yday_close_price - close_price) > 0";
        $count =  \DB::select(\DB::raw($query))[0]->total;
        return $count;
    }

    public static function latestTradeDate()
    {
        return lastTradeDate();
    }
    public static function latestBatch()
    {
        return lastBatch();
    }

    public static function totalTrade()
    {
         $sql="select * from trades  ORDER by TRD_LM_DATE_TIME desc limit 1";
         $trade = \DB::select($sql)[0]->TRD_TOTAL_TRADES;
         return $trade;
    }
    public static function totalValue()
    {
         $sql="select * from trades  ORDER by TRD_LM_DATE_TIME desc limit 1";
         $trade = \DB::select($sql)[0]->TRD_TOTAL_VALUE;
         return $trade;
    }

}
