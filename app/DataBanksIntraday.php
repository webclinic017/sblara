<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DataBanksIntraday extends Model {
    /*
     * retrieving data by market id make ensure of a exchange data. Because
     * Market_id is belongs to a exchange. So all data those belongs to market id must belongs to that exchange
     */

    protected $appends = array('price_change', 'price_change_per');

    protected $dates = [
        'lm_date_time',

    ];

    public function getTradeDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function getTradeTimeAttribute($value) {
        return Carbon::parse($value);
    }

    public function market() {
        return $this->belongsTo('App\Market');
    }

    public function getPriceChangeAttribute() {
        $change = $this->close_price - $this->yday_close_price;
        number_format($change, 2, '.', '');
        return (float) number_format($change, 2, '.', '');
    }

    public function getPriceChangePerAttribute() {
        $change = $this->close_price - $this->yday_close_price;
        $per = ($change / $this->yday_close_price) * 100;
        return (float) number_format($per, 2, '.', '');
    }

    public function getClosePriceAttribute($value) {
        $value = $value != 0 ? $value : ($this->pub_last_traded_price != 0 ? $this->pub_last_traded_price : $this->spot_last_traded_price);
        return $value;
    }


    /*
     * Return last minute trade data for all instruments  those have been traded.
     *
     * */

    public static function getLatestTradeDataAll($tradeDate = null, $exchangeId = 0) {
        $m = new Market();
        $activeDate = $m->getActiveDates(1, $tradeDate, $exchangeId)->first();
        $marketId = $activeDate->id;
        $batch = $activeDate->data_bank_intraday_batch;



        $cacheVar = "LatestIntraDataAll$tradeDate$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function () use ($marketId, $batch) {
                    $returnData = static::where('market_id', $marketId)->where('batch', $batch)->get();
                    return $returnData;

                });

        return $returnData;



    }


    /*
     * Return N minute ago trade data for all instruments those have been traded.
     *
     * */

    public static function getMinuteAgoTradeDataAll($tradeDate = null, $minute = 1, $exchangeId = 0) {
        $m = new Market();
        $activeDate = $m->getActiveDates(1, $tradeDate, $exchangeId)->first();
        $marketId = $activeDate->id;
        $batch = $activeDate->data_bank_intraday_batch - $minute;

        $cacheVar = "MinuteAgoIntraDataAll$tradeDate$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function () use ($marketId, $batch) {
                    $returnData = static::where('market_id', $marketId)->where('batch', $batch)->get();
                    return $returnData;

                });

        return $returnData;
    }


    /*
     * $trade_date: null will return last day data
     * $instrumentsIdArr: empty will return all instrument data. It has high probability to fail return data for all instrument at a time
     * $minute=0 will return all batch of the day (240 batch normally)
     * */


    public static function getWholeDayData($instrumentsIdArr=array(),$minute=0,$tradeDate=null,$exchangeId=0)
    {
        $instrumentIdHash=array_sum($instrumentsIdArr);//->sum();

        $cacheVar = "IntraDataByInstrument$tradeDate$exchangeId$instrumentIdHash$minute";

        $returnData = Cache::remember("$cacheVar", 1, function () use ($tradeDate, $exchangeId, $minute, $instrumentsIdArr) {
                    $m = new Market();
                    $activeDate = $m->getActiveDates(1, $tradeDate, $exchangeId)->first();
                    $marketId = $activeDate->id;
                    $query = static::where('market_id', $marketId)->orderBy('lm_date_time', 'desc');

                    if ($minute) {
                        $batch = $activeDate->data_bank_intraday_batch - $minute;
                        $query->where('batch', '>=', $batch);
                    }

                    if (!empty($instrumentsIdArr)) {
                        $query->whereIn('instrument_id', $instrumentsIdArr);
                    }

                    $returnData = $query->get();
                    return $returnData;
                });

        return $returnData;


    }

    /*
     * By default it will return last 1 batch data of previous day
     * */

    public static function getPreviousDayData($instrumentsIdArr=array(),$tradeDate = null, $minute = 1, $exchangeId = 0) {
        $instrumentIdHash=array_sum($instrumentsIdArr);

        $cacheVar = "PreviousDayIntraData$tradeDate$exchangeId$instrumentIdHash$minute";

        $returnData = Cache::remember("$cacheVar", 1, function () use ($tradeDate, $exchangeId, $minute, $instrumentsIdArr) {

                    $m = new Market();
                    $activeDate = $m->getActiveDates(2, $tradeDate, $exchangeId);
                    $marketId = $activeDate[1]->id;

                    $query = static::where('market_id', $marketId)->orderBy('lm_date_time', 'desc');

                    if ($minute) {
                        $batch = $activeDate[1]->data_bank_intraday_batch - ($minute - 1);
                        $query->where('batch', '>=', $batch);
                    }
                    if (!empty($instrumentsIdArr)) {
                        $query->whereIn('instrument_id', $instrumentsIdArr);
                    }

                    $returnData = $query->get();

                    return $returnData;
                });

        return $returnData;
    }

}
