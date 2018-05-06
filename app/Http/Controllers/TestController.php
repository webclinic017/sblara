<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FundamentalRepository;
use App\Repositories\InstrumentRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\UserRepository;
use App\DataBanksEod;

class TestController extends Controller
{


    public function funtest()
    {

        $sql = "SELECT instrument_id,lm_date_time,close_price,new_volume  FROM data_banks_intradays WHERE lm_date_time > '2018-04-30 10:00:00' and id>114736000";
        $rawdata = \DB::select($sql);

        // return $rawdata;

        $returnData = array();
        $i = 0;
        foreach ($rawdata as $data) {

            $i++;

            dd($data);
                        /*  return $data;
              exit;
              if ($data->new_volume < 0)  // skip some negative value specially for dsex
                  continue;

              $temp = array();
              //$temp['instrument_id']=$instrument_id;
              $temp['lm_date_time'] = date(strtotime($data->lm_date_time), 'd/m/Y H:i');
              $temp['close'] = $data->close_price;
              $temp['volume'] = $data->new_volume;

              $returnData[$data->instrument_id][] = $temp;*/
        }


        $all=\DB::select("select * from index_values where instrument_id = 10003 and index_date > '2018-01-11' ORDER by date_time asc");
        $all =collect($all)->groupBy('index_date');

$market= \DB::select("select * from markets where trade_date<'2018-04-30' and trade_date > '2018-01-10'");

        $market=collect($market)->keyBy('trade_date');


        $instrument_id= 10003;
        $eod=array();
        foreach($all as $collect)
        {
            $index_ohlc=array();
           // $collect = collect($day);

            $first = $collect->first();
            $index_ohlc[$instrument_id]['open'] = $first->capital_value;

            $index_ohlc[$instrument_id]['high'] = $collect->max('capital_value');
            $index_ohlc[$instrument_id]['low'] = $collect->min('capital_value');

            $last = $collect->last();
            $market_id = $market[$last->index_date]->id;
            $index_ohlc[$instrument_id]['close'] = $last->capital_value;
            $index_ohlc[$instrument_id]['date'] = $last->index_date;
            $index_ohlc[$instrument_id]['market_id'] = $market_id;
            dump($index_ohlc);





            $eod = DataBanksEod::updateOrCreate(
                ['market_id' => $market_id, 'instrument_id' => $instrument_id],
                [
                    'open' => $index_ohlc[$instrument_id]['open'],
                    'high' => $index_ohlc[$instrument_id]['high'],
                    'low' => $index_ohlc[$instrument_id]['low'],
                    'close' => $index_ohlc[$instrument_id]['close'],
                    'volume' => 0,
                    'trade' => 0,
                    'tradevalues' => 0,
                    'updated' => date('Y-m-d H:i:s'),
                    'date' => $last->index_date
                ]
            );


        }



     /*   DB::table('users')->insert([
            ['email' => 'taylor@example.com', 'votes' => 0],
            ['email' => 'dayle@example.com', 'votes' => 0]
        ]);*/
exit;



        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array(13,211),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array(12,13))->toArray());
        dd(FundamentalRepository::getFundamentalData(array(13,211),array(12,13))->toArray());

        dd(UserRepository::getUserInfo(array('market_monitor_settings'),5));
        dd(UserRepository::saveUserInfo(array('market_monitor_settings'),'cccc'));

        dd(DataBanksIntradayRepository::getYdayMinuteData(array(),15,'close_price')->toArray());

        $data=FundamentalRepository::getFundamentalData(array('stock_dividend','total_no_securities'),array('ABBANK','ACI'));
        dump($data);
        $data=FundamentalRepository::getFundamentalDataById(array(13,211),array(12,13));
        dd($data);
    }

    public function testAK(){
        return view('test.ak');
    }
}
