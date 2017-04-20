<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trade extends Model
{
    protected $dates = [
        'TRD_LM_DATE_TIME',
    ];

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function getTradeDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function getTradeTimeAttribute($value) {
        return Carbon::parse($value);
    }

    public static function getWholeDayData($limit=0,$trade_date=null,$exchangeId=0)
    {
        $m=new Market();
        $activeDate=$m->getActiveDates(1,$trade_date,$exchangeId)->first();
        $marketId=$activeDate->id;
        $query=static::where('market_id',$marketId)->orderBy('TRD_LM_DATE_TIME', 'desc');

        if($limit)
            $query->skip(0)->take($limit);

        $result=$query->get();
        $allVolume=$result->pluck('TRD_TOTAL_VALUE')->toArray();
        $allVolume=self::calculate_difference($allVolume);
        $result->put('trade_value_diff', $allVolume);
        return $result;
    }

    public static function getPreviousDayData($limit=1,$trade_date=null,$exchangeId=0)
    {
        $m=new Market();
        $activeDate=$m->getActiveDates(2,$trade_date,$exchangeId);
        $marketId=$activeDate[1]->id;
        $query=static::where('market_id',$marketId)->orderBy('TRD_LM_DATE_TIME', 'desc');

        if($limit)
            $query->skip(0)->take($limit);

        $result=$query->get();
        $allVolume=$result->pluck('TRD_TOTAL_VALUE')->toArray();
        $allVolume=self::calculate_difference($allVolume);
        $result->put('trade_value_diff', $allVolume);

        return $result;
    }

    /*
    * Calculate differences between two adjacent elements and return array of differences
    * $data Param assumes that it is in descending order by time
    * */
    public static function calculate_difference($data = array())
    {
        $shiftedData = $data;
        array_shift($shiftedData);
        array_push($shiftedData, 0);
        $sub = function ($a, $b) {
            $change=$a - $b;
            return (float) number_format($change, 2, '.', '');
        };
        $differenceArray = array_map($sub, $data, $shiftedData);
        return $differenceArray;
    }

}
