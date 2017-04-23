<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\Exchange;

class ExchangeRepository {



    public static function getExchangeInfo($exchangeName='DSE')
    {

        $exchangeDetails=Exchange::where('name','like',"$exchangeName")->get()->first();
        return $exchangeDetails;
    }


} 