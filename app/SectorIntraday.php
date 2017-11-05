<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SectorIntraday extends Model
{

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function getIndexDateAttribute($value) {
        $value=$value.' '.$this->index_time;
        return Carbon::parse($value);
    }

    public static function getWholeDayData($limit=0,$tradeDate=null,$exchangeId=0, $sector_list_id)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="SectoIntraDay$tradeDate$limit$exchangeId";
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId,$tradeDate,$limit, $sector_list_id)  {

            $m=new Market();
            $activeDate=$m->getActiveDates(1,$tradeDate,$exchangeId)->first();
            $marketId=$activeDate->id;
            $query=static::where('market_id',$marketId)->where('sector_list_id', $sector_list_id)->where('volume','>',0)->orderBy('index_time', 'desc')->groupBy('index_time');
            if($limit)
            {
                $query->skip(0)->take($limit);
            }
            $returnData=$query->get();

            return $returnData;

        });


        return $returnData;
    }




}
