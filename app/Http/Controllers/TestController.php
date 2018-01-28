<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FundamentalRepository;
use App\Repositories\MarketStatRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\UserRepository;
use App\Navigation;

class TestController extends Controller
{
    public function funtest()
    {


        MarketStatRepository::getMarketStatsData(array('cap_equity'),4612);

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
