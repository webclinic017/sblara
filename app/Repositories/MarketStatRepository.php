<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\MarketStat;
use App\Meta;
use App\Market;

class MarketStatRepository {
    /*
     * Sample call
     MarketStatRepository::getMarketStatsData(array('cap_equity'),null);  // will return last 2 days data
     MarketStatRepository::getMarketStatsData(array('cap_equity'),'2017-04-05');  // will return 2 days data from 2017-04-05
    MarketStatRepository::getMarketStatsData(array('cap_equity'),4612); // will return only 1 day data of market id 4612


    array:1 [▼
  76 => array:2 [▼
    0 => array:8 [▼
      "id" => 15670
      "market_id" => 4614
      "meta_id" => 76
      "meta_value" => "3226903978826.94"
      "meta_date" => Carbon {#732 ▶}
      "meta_time" => "00:00:00"
      "created" => "2017-04-06 16:30:02"
      "updated" => "2017-04-06 16:30:02"
    ]
    1 => array:8 [▼
      "id" => 15666
      "market_id" => 4613
      "meta_id" => 76
      "meta_value" => "3240584782740.41"
      "meta_date" => Carbon {#746 ▶}
      "meta_time" => "00:00:00"
      "created" => "2017-04-05 16:30:03"
      "updated" => "2017-04-05 16:30:03"
    ]
  ]
]




     * */


    public static function getMarketStatsData($meta = array(),$market=null)
    {

        if (is_int($meta[0])) {
            //Meta id provided
            $metaId = $meta;
            $metaInfo = Meta::getMetaInfoById($metaId);

        } else {
            // metaKey provided

            $metaInfo = Meta::getMetaInfo($meta);
            $metaId = $metaInfo->pluck('id')->toArray();

        }

        if (is_int($market)) {
            // market_id provided

            $marketId[] = $market;

        } else {
            // trade_date provided

            $marketInfo = Market::getActiveDates($limit = 2, $tradeDate = $market, $exchangeId = 0);
            $marketId = $marketInfo->pluck('id')->toArray();

        }
        $groupByMarketId = MarketStat::getData($metaId, $marketId)->groupby('market_id');

        $returnData = array();
      //  dd($metaInfo);
        foreach($groupByMarketId as $market_id=>$market_stat_data)
        {
            foreach($market_stat_data as $row)
            {

                $meta_key = $metaInfo->where('id', $row->meta_id)->first()->meta_key;
                $returnData[$market_id][$meta_key]= $row;
            }

        }


        return collect($returnData);

    }

    /*
     * array:4 [
  0 => array:4 [
    "market_id" => 4784
    "meta_key" => "cap_equity"
    "meta_value" => "3643763076561.99"
    "meta_date" => "2017-11-30"
  ]
  1 => array:4 [
    "market_id" => 4784
    "meta_key" => "cap_mutual_fund"
    "meta_value" => "42658710971.97"
    "meta_date" => "2017-11-30"
  ]
  2 => array:4 [
    "market_id" => 4784
    "meta_key" => "cap_debt_sec"
    "meta_value" => "555074509492"
    "meta_date" => "2017-11-30"
  ]
  3 => array:4 [
    "market_id" => 4784
    "meta_key" => "cap_total"
    "meta_value" => "4241496297026"
    "meta_date" => "2017-11-30"
  ]
]

    It will update if market_id and meta_id same

     * */

    public static function saveMarketStatsData($dataToSave='')
    {
        $all_meta_key=collect($dataToSave)->pluck('meta_key');

        $metaInfo=Meta::getMetaInfo($all_meta_key);

        $dataToSaveNew=array();

        foreach($dataToSave as $data)
        {

            $meta_key=$data['meta_key'];
            $meta_id=$metaInfo[$meta_key]->id;
            $market_id=$data['market_id'];
            $meta_date=$data['meta_date'];
            $meta_value=$data['meta_value'];

            $dataToSaveNew[]=$data;

            MarketStat::updateOrCreate(
                ['meta_id' => $meta_id, 'market_id' => $market_id],
                ['meta_value' => $meta_value, 'meta_date' => $meta_date]
            );
        }


    }


} 