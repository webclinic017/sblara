<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\InstrumentRepository;
use DB;

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
    public function instrument()
    {
        return $this->belongsTo('App\Instrument');
    }

    public function getDateTimestampAttribute()
    {
        return $this->date->timestamp;
    }

    // $howManyDays can be integer and date
    // simple date. no carbon obj
    public static function getEodByInstrument($instrumentId = 0, $howManyDays = 180, $toDate = null)
    {
        //dd("$howManyDays -> $toDate");
        $now = Carbon::now();
        // Setting today as to_date
        if (is_null($toDate)) {
            $toDate = $now->format('Y-m-d');
        }

        if (is_int($howManyDays)) {
            $d = $now->subDays($howManyDays);
            $fromDate = $d->format('Y-m-d');
        } else {
            $fromDate = $howManyDays;
        }

        return $eodData = static::whereBetween('date', [$fromDate, $toDate])->where('instrument_id', $instrumentId)->orderBy('date', 'desc')->get();

        /* $dataBankallGroup = $eodData->groupBy('market_id');

         $eodData=array();
         //eliminating duplicate if exist (some duplicate data available. We have to prevent this in future)
         foreach ($dataBankallGroup as $eachTradeDate) {
             $volume=0;
             foreach($eachTradeDate as $eachData)  // to eliminate duplicate data. We will take higher volume data
             {

                 if($eachData->volume>$volume)
                 {
                     $data=clone $eachData;
                     $volume=$eachData->volume;
                 }
             }
             $eodData[]=$data;
         }*/

        return collect($eodData);

    }

    public static function getEodForCSV($howManyDays = 180, $toDate = null, $instrumentIdArr = array(), $select = array())
    {
        //dd("$howManyDays -> $toDate");
        $now = Carbon::now();
        // Setting today as to_date
        if (is_null($toDate)) {
            $toDate = $now->format('Y-m-d');
        }

        if (is_int($howManyDays)) {
            $d = $now->subDays($howManyDays);
            $fromDate = $d->format('Y-m-d');
        } else {
            $fromDate = $howManyDays;
        }

        $query = static::whereBetween('date', [$fromDate, $toDate])->orderBy('date', 'desc');

        if (!empty($instrumentIdArr))
            $query->whereIn('instrument_id', $instrumentIdArr);

        if (!empty($select)) {
            $select[] = 'instrument_id';
            $select[] = 'market_id';
            $select[] = 'volume';
            $select[] = 'date';
            $query->select($select);
        }

        $dataBankall = $query->get();
        $dataBankall = $dataBankall->groupBy('instrument_id');

        //eliminating duplicate if exist (some duplicate data available. We have to prevent this in future)

        $eodData = array();
        foreach ($dataBankall as $instrument_id => $dataBankallGroup) {

            $instrumentInfo = InstrumentRepository::getInstrumentsById($instrument_id);
            if (count($instrumentInfo)) {
                $instrument_code = $instrumentInfo->first()->instrument_code;
            } else {
                continue;
            }
            $dataBankallGroup = $dataBankallGroup->groupBy('market_id');
            foreach ($dataBankallGroup as $eachTradeDate) {
                $volume = 0;
                foreach ($eachTradeDate as $eachData)  // to eliminate duplicate data. We will take higher volume data
                {

                    if ($eachData->volume > $volume) {
                        $data = clone $eachData;
                        $data->code = $instrument_code;
                        $data->ndate = $data->date->format('d/m/Y');
                        $volume = $eachData->volume;

                    }
                }
                $eodData[$instrument_id][] = $data;
            }
            // dd($eodData[$instrument_id][0]);
        }


        return $eodData;

    }

    public static function getEodData($instruments)
    {
        $table = 'data_banks_eods';

        $date_e = Carbon::now()->format('Y-m-d');
        $date_b = Carbon::now()->subDays(365)->format('Y-m-d');

        $sql = "SELECT `instrument_id`, `close`,`open`,`high`, `low`, `volume`, `trade`, `date` FROM $table WHERE date between '" . $date_b . "' and '" . $date_e . "' and `instrument_id` in (" . $instruments . ")  order by `instrument_id`  asc, `date` desc";

        return DB::Select($sql);
    }

    public static function getCountDataByGroup($instruments)
    {
        $table = 'data_banks_eods';

        $date_e = Carbon::now()->format('Y-m-d');
        $date_b = Carbon::now()->subDays(365)->format('Y-m-d');

        $sql = "SELECT `instrument_id`, count(*) as count FROM $table WHERE date between '" . $date_b . "' and '" . $date_e . "' and `instrument_id` in (" . $instruments . ")  group by `instrument_id`";
        return DB::Select($sql);
    }


}