<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FundamentalRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\UserRepository;
use App\Navigation;

class TestController extends Controller
{
    public function funtest()
    {

        $items = Navigation::tree();

        dd($items);

        $menu = View::make('layouts.home.index')->withItems($items);


        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array(13,211),array('ABBANK','ACI'))->toArray());
        dump(FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array(12,13))->toArray());
        dd(FundamentalRepository::getFundamentalData(array(13,211),array(12,13))->toArray());

        dd(UserRepository::getUserInfo(array('market_monitor_settings'),5));
        dd(UserRepository::saveUserInfo(array('market_monitor_settings'),'cccc'));

        dd(DataBanksIntradayRepository::getYdayMinuteData(array(),15,'close_price')->toArray());

        $data=FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array('ABBANK','ACI'));
        dump($data);
        $data=FundamentalRepository::getFundamentalDataById(array(13,211),array(12,13));
        dd($data);
    }
}
