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


    }
}
