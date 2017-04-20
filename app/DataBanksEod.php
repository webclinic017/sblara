<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DataBanksEod extends Model
{
    protected $appends = array('date_timestamp');
    protected $dates = [
        'date',
    ];


    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function getDateTimestampAttribute()
    {
        return $this->date->timestamp;
    }

    // $howManyDays can be integer and date
    // simple date. no carbon obj
    public static function getEodByInstrument($instrumentId=0,$toDate=null,$howManyDays=180)
    {
        $now = Carbon::now();

        // Setting today as to_date
        if(is_null($toDate))
        {
            $toDate=$now->format('Y-m-d');
        }

        if(is_int($howManyDays)) {
            $d = $now->subDays($howManyDays);
            $fromDate = $d->format('Y-m-d');
        }else
        {
            $fromDate=$howManyDays;
        }

        return static::whereBetween('date', [$fromDate, $toDate])->where('instrument_id',$instrumentId)->orderBy('date', 'desc')->get();

    }


}
