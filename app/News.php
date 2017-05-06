<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $dates = [
        'post_date',

    ];

    public function instrument() {
        return $this->belongsTo('\App\Instrument');
    }

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public static function getWholeDayNews($tradeDate=null,$exchangeId=0)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $m=new Market();
        $activeDate=$m->getActiveDates(1,$tradeDate,$exchangeId)->first();
        $marketId=$activeDate->id;

        $allnews=static::where('market_id',$marketId)->where('is_active',1)->orderBy('post_date', 'desc')->get();

        return $allnews;

    }

    public static function getAllNewsByInstrumentId($instrument_id=0)
    {

        $allNews=static::where('instrument_id',$instrument_id)->where('is_active',1)->orderBy('post_date', 'desc')->get();
        return $allNews;

    }

}
