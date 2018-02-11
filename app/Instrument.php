<?php

namespace App;
use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use DB;

class Instrument extends Model
{
    /**
     * Get the latest data bank intraday associated with the instrument.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */


   /* // Category model
    public function latestEod()
    {
        return $this->hasOne('App\DataBanksEod')->latest('date')->take(1);
        //return $this->hasOne(Measure::class)->latest()->first();
    }


    public function data_banks_eods()
    {
        return $this->hasMany('App\DataBanksEod', 'instrument_id');
    }*/


    public function data_banks_eods()
    {
        return $this->hasMany(DataBanksEod::class);
    }


    public function dataBanksEods()
    {
        return $this->hasMany(DataBanksEod::class);
    }

    public function latestDataBanksEod()
    {
        return $this->hasOne(DataBanksEod::class)->latest('date');
    }

    public function data_banks_intraday()
    {
        return $this->hasOne(DataBanksIntraday::class)->where('batch', $this->batch_id);
    }
    public function data_banks_intradays()
    {
        return $this->hasOne(DataBanksIntraday::class)->take(1)->orderBy('id', 'desc');
    }

 


   /* public function data_banks_eod()
    {
        return $this->hasMany(DataBanksEod::class)
                    ->latest('date');
    }*/

    public function sector_list()
    {
        return $this->belongsTo('App\SectorList','sector_list_id');
    }

    public static function getInstrumentsBySectorName($sectorName='Bank',$exchangeId=0)
    {
        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $returnData = static::whereHas('sector_list', function($q) use($sectorName,$exchangeId) {
            $q->where('name', 'like', "$sectorName");
            $q->where('exchange_id', $exchangeId);
        })->where('active','1')->orderBy('instrument_code', 'asc')->get();


        return $returnData;

    }


    public static function getInstrumentsAll($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }


        $cacheVar="InstrumentList$exchangeId";
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {
            $returnData=static::where('exchange_id',$exchangeId)->where('active',"1")->orderBy('instrument_code', 'asc')->get();
            return $returnData;

        });

        return $returnData;
    }



    /*
     * It will avoid index.
     * */
    public static function getInstrumentsScripOnly($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="InstrumentsScripOnly$exchangeId";
        //Cache::forget("$cacheVar");
        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {

            $returnData = static::whereHas('sector_list', function($q) use($exchangeId) {
                $q->where('exchange_id', $exchangeId);
                $q->where('name', 'not like', "Index");
                $q->where('name', 'not like', "custom_index");
                $q->where('name', 'not like', "Debenture");
                $q->where('name', 'not like', "Treasury Bond");
               // $q->where('name', 'not like', "Corporate Bond");
            })->where('active','1')->orderBy('instrument_code', 'asc')->get();

            return $returnData;
        });

        return $returnData;


    }

    public static function getInstrumentsScripOnlyByDB($exchangeId=0){
      if(!$exchangeId) {
          $exchangeId = session('active_exchange_id', 1);
      }

      $sql = "select `id` ,`instrument_code` from `instruments` where exists (select * from `sector_lists` where `instruments`.`sector_list_id` = `sector_lists`.`id` and `exchange_id` = '".$exchangeId."' and `name` not like 'Index' and `name` not like 'Debenture' and `name` not like 'Treasury Bond') and `active` = '1' order by `id` asc";
      $instruments = DB::Select($sql);

      return $instruments;
    }

    public static function getInstrumentsScripWithIndex($exchangeId=0)
    {

        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $cacheVar="InstrumentsScripWithIndex$exchangeId";

        $returnData = Cache::remember("$cacheVar", 1, function ()  use ($exchangeId)  {

            $returnData = static::whereHas('sector_list', function($q) use($exchangeId) {
                $q->where('exchange_id', $exchangeId);
                $q->where('name', 'not like', "Debenture");
                $q->where('name', 'not like', "Treasury Bond");
            })->where('active','1')->orderBy('instrument_code', 'asc')->get();

            return $returnData;
        });

        return $returnData;


    }

    public static function queryInstruments($query,$exchangeId=0)
    {
        $instrumentList=self::getInstrumentsScripWithIndex($exchangeId);
        $result = $instrumentList->filter(function ($value, $key) use ($query) {
            // select this row if strstr is true
            return strstr($value->instrument_code,$query);
        });

        return $result;

    }

    /*
    * This will return last traded data for all shares of $instrumentIDs regardless date.
    * Some share may not be traded for last 2/3 days. DataBanksIntradayRepository::getLatestTradeDataAll() will return only last day data without those instruments
    * So for this reason we are writing this method
    *
    * $instrumentIDs= array of instruments id
    * $tradeDate =  If set/not null, it will count data before that day
    *
    * We dont need exchange_id here as instruments_id are coming from desired exchange
    *
    * */


    public static function getDateLessTradeData($instrumentIDs = array())
    {
        /*We will use session value of active_trade_date as default if exist*/
        $tradeDate = session('active_trade_date', null);

        if (is_null($tradeDate)) {

        /*    $lastTradedDataAllInstruments = Instrument::whereIn('id', $instrumentIDs)
                ->with(['data_banks_eod' => function ($q) {
                    $q->latest('date')->take(1);
                }])
                ->get();*/

            $lastTradedDataAllInstruments = Instrument::with(['data_banks_eod' => function ($q) {
                    $q->latest('date')->take(1);
                }])
                ->get();


        } else {
            $lastTradedDataAllInstruments = Instrument::whereIn('id', $instrumentIDs)
                ->with(['data_banks_eod' => function ($q, $tradeDate) {
                    $q->whereDate('date', '<=', $tradeDate)->latest('date')->take(1);
                }])
                ->get();
        }
        //  dump($instrumentIDs);
        //   dd($lastTradedDataAllInstruments->toArray());

        return $lastTradedDataAllInstruments;


    }

    public function corporateActionsChartData()
    {
  
        $data = $this->dataBanksEods()->select('date', 'close')->latest('date')->take(800)->get()->toArray();
       $data = array_map(function ($value)
        {
            $value = [ Carbon::parse($value['date']), $value['close']];

            return $value;
        }, $data);
       // dd($data);
       return json_encode($data);
    }

    public function getYearEndAttribute()
    {
        return (\App\Repositories\FundamentalRepository::getFundamentalData(['year_end', "q1_eps_cont_op","half_year_eps_cont_op","q3_nine_months_eps","earning_per_share"], [$this->id]));
        // return $this
    }

    public function epsHistory()
    {
        $yearEnd = $this->yearEnd;
        $data = [];
        $data['category'] = [];
        $data['q1_eps_cont_op'] = [];
        $data['earning_per_share'] = [];
        $data['q3_nine_months_eps'] = [];
        $data['half_year_eps_cont_op'] = [];


        return $data;
    }

    public function dseSharePercentage()
    {
        return $this->hasOne(DseSharePercentage::class)        ;
    }

}
