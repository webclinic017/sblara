<?php
namespace App\Http\Controllers;
use App\Instrument;
use App\Portfolio;
use Illuminate\Http\Request;
use App\News;
use App\Repositories\FundamentalRepository;
use App\Repositories\InstrumentRepository;
use DB;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
    }


    function search(Request $request, $type, $search) {
         return $this->{$request->type}($search); 
    }

    public function company($search)
    {   
      /*  $data = Instrument::where('instrument_code', 'like', ''.$search.'%')
                            ->select('instrument_code', 'instruments.id', 'pub_last_traded_price', 'spot_last_traded_price', 'high_price', 'low_price', 'yday_close_price')
                             ->leftJoin('data_banks_intradays', function ($join)
                                            {
                                                $join->on('instruments.batch_id', '=', 'data_banks_intradays.batch');
                                                $join->on('instruments.id', '=', 'data_banks_intradays.instrument_id');
                                            }
                                        )
                                        ->whereNotNull('data_banks_intradays.id')
                                        ->take(10)
                                       ->get();
*/


        $sql="select
data_banks_intradays.instrument_id  ,
instruments.instrument_code ,
sector_lists.full_name as sector,
data_banks_intradays.quote_bases,
data_banks_intradays.yday_close_price,
data_banks_intradays.close_price,
data_banks_intradays.high_price,
data_banks_intradays.low_price,
data_banks_intradays.open_price,
data_banks_intradays.total_volume,
DATE_FORMAT(data_banks_intradays.lm_date_time,'%h:%i- %D %b') as last_traded
from
data_banks_intradays,instruments,sector_lists
WHERE
(instruments.instrument_code like '%$search%')  and
data_banks_intradays.batch=instruments.batch_id AND
data_banks_intradays.instrument_id=instruments.id AND
instruments.sector_list_id=sector_lists.id
";

        $data = DB::select($sql);

        //Cache::forget("annualized_eps_all_instruments");
        $epsData = Cache::remember("annualized_eps_top_search_fundamental", 300, function (){
            $instrument_arr=InstrumentRepository::getInstrumentsScripOnly()->pluck('id');
            $epsData = FundamentalRepository::getAnnualizedEPS($instrument_arr);
            return $epsData;
        });


        $fundamental = Cache::remember("top_search_fundamental", 5, function () {

        $sql = "SELECT fundamentals.instrument_id,metas.meta_key, fundamentals.meta_value, fundamentals.meta_date
        FROM
        metas,fundamentals
        WHERE
        metas.id = fundamentals.meta_id AND
        fundamentals.is_latest=1 AND
        (
            metas.meta_key like 'paid_up_capital' OR
            metas.meta_key like 'total_no_securities' OR
            metas.meta_key like 'net_asset_val_per_share' OR
            metas.meta_key like 'share_percentage_institute' OR
            metas.meta_key like 'share_percentage_public'

        )

        ";

            $fundamental = DB::select($sql);

            $fundamental = collect($fundamental)->groupBy('instrument_id');
            return $fundamental;
        });





        $return_data=array();
        foreach($data as $instrument)
        {
            $fund_data=$fundamental[$instrument->instrument_id];
            foreach($fund_data as $row)
            {
                $field= $row->meta_key;
                $instrument->$field= $row->meta_value;
            }

            $annualized_eps=isset($epsData[$instrument->instrument_id])?$epsData[$instrument->instrument_id]['annualized_eps']:0;
            $annualized_eps_text= isset($epsData[$instrument->instrument_id])?$epsData[$instrument->instrument_id]['text']:'';
            $earning_per_share= isset($epsData[$instrument->instrument_id]) ?$epsData[$instrument->instrument_id]['meta_value']:0;

            $instrument->category=category($instrument);
            $instrument->annualized_eps= $annualized_eps;
            $instrument->annualized_eps_text= $annualized_eps_text;
            $instrument->earning_per_share= $earning_per_share;
            $return_data[]= $instrument;

        }


        return response()->json($return_data);
        //return response()->json($data);
    }

    public function news($search)
    {   
        $data = News::where('instrument_code', 'like', ''.$search.'%')->with('data_banks_intraday')->paginate(10);
        return response()->json($data);
    }

}
