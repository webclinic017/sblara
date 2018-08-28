<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fundamental extends Model
{
    protected  $fillable = ['is_latest', 'instrument_id', 'meta_id', 'meta_value', 'meta_date'];
    public function getMetaDateAttribute($value) {
        return Carbon::parse($value);
    }

    public function meta()
    {
        return $this->belongsTo('App\Meta','meta_id');
    }

    public function instrument()
    {
        return $this->belongsTo('App\Instrument');
    }


    // will return all data
    public static function getData($metaId=array(),$instrumentId=array())
    {
        $query=self::whereIn('meta_id',$metaId);

        if(!empty($instrumentId)){
                    $query->whereIn('instrument_id',$instrumentId);
            }else{

                    $query->whereIn('instrument_id', \App\Repositories\InstrumentRepository::getInstrumentsAll());
                }


        $returnData=$query->orderby('meta_date','desc')->get();
        return  $returnData;
    }

    //will return where is_latest=1
    public static function getDataLatest($metaId=array(),$instrumentId=array())
    {
        $query=self::whereIn('meta_id',$metaId);

        if(!empty($instrumentId))
        $query->whereIn('instrument_id',$instrumentId);
        $query->where('is_latest',1);

        $returnData=$query->orderby('meta_date','desc')->get();

        
        return  $returnData;
    }

    public static function deleteFundamental($meta_ids = array())
    {
        $deletedRows = self::whereIn('meta_id', $meta_ids)->delete();
        return true;
    }

    
    public function storeMeta()
    {

    }

    public static function allTogetherPE()
    {
        // 225 => q1_eps_cont_op
        // 434 => half_year_eps_cont_op
        // 308 => q3_nine_months_eps
        // 201 => earning_per_share
         $array = \Cache::remember('all_together_pe', 5, function ()
        {
      $data = [];
        $result = self::whereIn('meta_id', ['201','434','225','308'])->where('is_latest', 1)->orderBy('fundamentals.meta_date', 'desc')
        ->leftJoin('instruments', 'instruments.id', 'fundamentals.instrument_id')
        ->leftJoin('data_banks_intradays', function ($join)
        {
            $join->on('data_banks_intradays.instrument_id', 'fundamentals.instrument_id');
            $join->on('data_banks_intradays.batch', "instruments.batch_id");
        })->get();
        foreach ($result as $row) {
            if(isset($data[$row->instrument_id]))
            {
                continue;
            }
            $row->meta_value = (float) $row->meta_value;
            switch ($row->meta_id) {
                case '225':
                $eps = ($row->meta_value * 12)/3;
                    break;
                case '434':
                $eps = ($row->meta_value * 12)/6;
                    break;
                case '308':
                $eps = ($row->meta_value * 12)/9;
                    break;
                case '201':
                $eps = $row->meta_value;
                    break;
            }
            $val = @ $row->close_price/$eps;
            $data[$row->instrument_id] =  round($val, 2) ;
        }
        return $data;       
        });
         return $array;
    }  

    public function allTogetherCategory()
      {
            return \Cache::remember('allTogetherCategory', 60, function ()
            {
                $result = \DB::table('instruments')->leftJoin('data_banks_intradays', function ($join)
                {
                    $join->on('instruments.id', 'data_banks_intradays.instrument_id');
                    $join->on('instruments.batch_id', 'data_banks_intradays.batch');
                })->get();

                foreach ($result as $row) {
                    $data[$row->instrument_id] = $row->quote_bases[0];
                }
                return $data;
            });

      } 

    public static function allTogetherSector()
      {
            return \Cache::remember('allTogetherSector', 60, function ()
            {
                $result = \DB::table('instruments')->select('sector_lists.name', 'sector_list_id', 'sector_lists.id', 'instruments.id as instrument_id')->leftJoin('sector_lists', function ($join)
                {
                    $join->on('instruments.sector_list_id', 'sector_lists.id');
                })->get();
                foreach ($result as $row) {
                    $data[$row->instrument_id] = $row->name;
                }
                return $data;
            });

      }
    public static function allTogetherShareHolding($meta, $year=false, $month=false)
      {
        switch ($month) {
            case 'JAN':
            $month = "01";
                break;
            case 'FEB':
            $month = "02";
                break;
            case 'MAR':
            $month = "03";
                break;
            case 'APR':
            $month = "04";
                break;
            case 'MAY':
            $month = "05";
                break;
            case 'JUN':
            $month = "06";
                break;
            case 'JUL':
            $month = "07";
                break;
            case 'AUG':
            $month = "08";
                break;
            case 'SEP':
            $month = "09";
                break;
            case 'OCT':
            $month = 10;
                break;
            case 'NOV':
            $month = 11;
                break;
            case 'DEC':
            $month = 12;
                break;
        }
        switch ($meta) {
            case 'DIRECTOR':
            $meta = 18;
                break;
            case 'GOVT':
            $meta = 19;
                break;
            case 'INSTITUTE':
            $meta = 20;
                break;
            case 'FOREIGN':
            $meta = 21;
                break;
            case 'PUBLIC':
            $meta = 22;
                break;
        }
        // "share_percentage_director", 18
        // "share_percentage_govt", 19
        // "share_percentage_institute", 20
        // "share_percentage_foreign", 21
        // "share_percentage_public" 22  
        // \Cache::forget('allTogetherShareHolding_'.$meta.$year.$month);
            return \Cache::remember('allTogetherShareHolding_'.$meta.$year.$month, 60, function ()use($meta, $year, $month)
            {
                $data = [];
                $result = self::where('meta_id', $meta);

                if($year){
                   $result =  $result->where('meta_date', 'like', "$year-$month-%");
                }
                

                $result = $result->orderBy('meta_date', 'desc')->leftJoin('instruments', 'instruments.id', 'fundamentals.instrument_id')->get();
                foreach ($result as $row) {
                    if(isset($data[$row->instrument_id]))
                    {
                        continue;
                    }
                    $row->meta_value = (float) $row->meta_value;

                    $data[$row->instrument_id] =  $row->meta_value ;
                }
                // dd($data);
                return $data;     
            });

      }  

      public static function allTogetherNav($year)
      {
        // dd(\Cache::forget("allTogetherNav_$year"));
                return \Cache::remember("allTogetherNav_$year", 60, function () use ($year)
                {
                    // net_asset_val_per_share 205
                    $result = self::where('meta_id', 205)->where('meta_date', 'like', "$year%")->orderBy('meta_date', 'desc')->get();
                    $data = [];
                        foreach ($result as $row) {
                            if(isset($data[$row->instrument_id]))
                            {
                                continue;
                            }
                            $row->meta_value = (float) $row->meta_value;

                            $data[$row->instrument_id] =  $row->meta_value ;
                        }
                        return $data;                             
                });

      }

      public static function allTogetherPaidUp()
      {
        // \Cache::forget("allTogetherPaidUp_$year");die('df');
        // (\Cache::forget("allTogetherPaidUp"));
                return \Cache::remember("allTogetherPaidUp", 60, function ()
                {
                    // paid_up_capital 256
                    $result = self::where('meta_id', 256)->where('is_latest',  "1")->orderBy('meta_date', 'desc')->get();
                    $data = [];
                        foreach ($result as $row) {
                            if(isset($data[$row->instrument_id]))
                            {
                                continue;
                            }
                            $row->meta_value = (float) $row->meta_value;

                            $data[$row->instrument_id] =  $row->meta_value ;
                        }
                        // dd($data);
                        return $data;                             
                });

      }


    public static function allTogetherEps($year, $month)
    {

            // 225 => q1_eps_cont_op
            // 434 => half_year_eps_cont_op
            // 308 => q3_nine_months_eps
            // 201 => earning_per_share
                switch ($month) {
                    case 'JAN':
                    $month = "01";
                        break;
                    case 'FEB':
                    $month = "02";
                        break;
                    case 'MAR':
                    $month = "03";
                        break;
                    case 'APR':
                    $month = "04";
                        break;
                    case 'MAY':
                    $month = "05";
                        break;
                    case 'JUN':
                    $month = "06";
                        break;
                    case 'JUL':
                    $month = "07";
                        break;
                    case 'AUG':
                    $month = "08";
                        break;
                    case 'SEP':
                    $month = "09";
                        break;
                    case 'OCT':
                    $month = 10;
                        break;
                    case 'NOV':
                    $month = 11;
                        break;
                    case 'DEC':
                    $month = 12;
                        break;
                }     

             $array = \Cache::remember('all_together_eps_'.$year.$month, 5, function () use($year, $month)
            {
          $data = [];
            $result = self::whereIn('meta_id', ['201','434','225','308'])
            ->where('meta_date', "like", "$year-$month%")
            ->orderBy('fundamentals.meta_date', 'desc')
            ->leftJoin('instruments', 'instruments.id', 'fundamentals.instrument_id')
            ->leftJoin('data_banks_intradays', function ($join)
            {
                $join->on('data_banks_intradays.instrument_id', 'fundamentals.instrument_id');
                $join->on('data_banks_intradays.batch', "instruments.batch_id");
            })->get();
            foreach ($result as $row) {
                if(isset($data[$row->instrument_id]))
                {
                    continue;
                }
                $row->meta_value = (float) $row->meta_value;
                switch ($row->meta_id) {
                    case '225':
                    $eps = ($row->meta_value * 12)/3;
                        break;
                    case '434':
                    $eps = ($row->meta_value * 12)/6;
                        break;
                    case '308':
                    $eps = ($row->meta_value * 12)/9;
                        break;
                    case '201':
                    $eps = $row->meta_value;
                        break;
                }
                $val = $eps;
                $data[$row->instrument_id] =  round($val, 2) ;
            }
            return $data;       
            });
             return $array;
        }      

        public static function allTogetherYearEnd()
          {

            $data =  \Cache::remember('allTogetherYearEnd', 60, function ()
            {
                
            // year_end 435
            $data = [];
            $result = self::where('meta_id', 435)->where('is_latest', 1)->orderBy('meta_date', 'desc')->get();
                        foreach ($result as $row) {
                            if(isset($data[$row->instrument_id]))
                            {
                                continue;
                            }
                            $row->meta_value =  $row->meta_value;

                            $data[$row->instrument_id] =  $row->meta_value ;
                        }           
                        return $data;
            });
            return $data;
          }  

          public static function allTogetherDividend($type, $year)
          {
                    // "stock_dividend" 211
                    // "cash_dividend"   212

                switch ($type) {
                    case 'STOCK':
                    $meta_id =  211;
                        break;
                    case 'CASH':
                    $meta_id =  245;
                        break;
                }
                // dd(\Cache::forget('allTogetherDividend_'.$meta_id.$year));
                $data =  \Cache::remember('allTogetherDividend_'.$meta_id.$year, 60, function () use ($meta_id, $year)
                {
                    
                    $data = [];
                    $result = self::where('meta_id', $meta_id)->where('meta_date', 'like', "$year%")->where('is_latest', 1)->orderBy('meta_date', 'desc')->get();
                                foreach ($result as $row) {
                                    if(isset($data[$row->instrument_id]))
                                    {
                                        continue;
                                    }
                                    $row->meta_value =  $row->meta_value;

                                    $data[$row->instrument_id] =  $row->meta_value ;
                                }           
                                return $data;
                });
                return $data;            
          }
}

//  dividend , year end
//
//march june sep dec
//(net_asset_val_per_share)
 