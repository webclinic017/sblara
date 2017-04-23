<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FundamentalRepository;
use App\Repositories\DataBanksIntradayRepository;

class TestController extends Controller
{
    public function funtest()
    {
        dd(DataBanksIntradayRepository::getYdayMinuteData(array(),15,'close_price')->toArray());

        $data=FundamentalRepository::getFundamentalData(array('stock_dividend','no_of_securities'),array('ABBANK','ACI'));
        dump($data);
        $data=FundamentalRepository::getFundamentalDataById(array(13,211),array(12,13));
        dd($data);
    }
}
