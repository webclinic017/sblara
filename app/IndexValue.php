<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class IndexValue extends Model
{
    protected $dates = [
        'date_time',

    ];

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function getIndexDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function getIndexTimeAttribute($value) {
        return Carbon::parse($value);
    }


    public static function getWholeDayData($limit=0,$tradeDate=null,$exchangeId=0)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="IndexValue$tradeDate$limit$exchangeId";
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId,$tradeDate,$limit)  {

            $m=new Market();
            $activeDate=$m->getActiveDates(1,$tradeDate,$exchangeId)->first();
            $marketId=$activeDate->id;
            $query=static::where('market_id',$marketId)->where('deviation','!=',0)->orderBy('date_time', 'desc');
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
