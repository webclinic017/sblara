<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Exchange extends Model
{
    //
    public function markets()
    {
        return $this->hasMany('App\Market');
    }
    public function instruments()
    {
        return $this->hasMany('App\Instrument');
    }

    /*
    * Tinker sample command
    * php artisan tinker
    * $e=new App\Repositories\ExchangeRepository;
    * $e=new App\Exchange
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
        $tradeDateList = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId,$tradeDate,$limit)  {

            $ex = static::find($exchangeId);
            if(is_null($tradeDate))
            {
                $tradeDateList=$ex->markets()->whereDate('trade_date','<=',DB::raw('CURDATE()'))->where('data_bank_intraday_batch','>',0)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();
            }else
            {
                $tradeDateList=$ex->markets()->whereDate('trade_date','<=',$tradeDate)->where('data_bank_intraday_batch','>',0)->orderBy('trade_date', 'desc')->skip(0)->take($limit)->get();
            }
            return $tradeDateList;

        });

        return $tradeDateList;

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
        $activeTradeDates= self::getActiveDates(1,null,$exchangeId)->first();
        if($now->gte($activeTradeDates->market_started) and $now->lte($activeTradeDates->market_closed))
            return true;
        else
            return false;

    }




}
