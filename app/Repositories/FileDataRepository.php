<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\DataBanksEod;
use App\Market;
use Carbon\Carbon;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use Illuminate\Support\Facades\Cache;
use DB;
use Illuminate\Support\Facades\Storage;
class FileDataRepository {


    public static function getAdjustedEod($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/eod/adjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data

            if($latest)
            {
                if($last_update_date!=date('Y-m-d'))
                {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()

                    switch ($field) {
                        case 'o':
                            $latest_index=0;
                            break;

                        case 'h':
                            $latest_index=1;
                            break;

                        case 'l':
                            $latest_index=2;
                            break;

                        case 'c':
                            $latest_index=3;
                            break;

                        case 'v':
                            $latest_index=4;
                            break;

                        case 'd':
                            $latest_index=5;

                            break;
                        default:
                            $latest_index=3;
                    }

                    $latest_data_file = "data/$instrument_id/eod/latest.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);     
                    }else{
                        $today_data=[];  
                    }


                    if(isset($today_data[5]) and $today_data[5]!=$last_update_date)
                    {
                        // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday

                        $latest_data=$today_data[$latest_index];
                        array_unshift($contents, $latest_data);   //adding latest data

                    }


                }



            }

        }
        return $contents;
    }

    public static function getUnAdjustedEod($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/eod/unadjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {

                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    switch ($field) {
                        case 'o':
                            $db_field = 'open_price';
                            $latest_index = 0;
                            break;

                        case 'h':
                            $db_field = 'high_price';
                            $latest_index = 1;
                            break;

                        case 'l':
                            $db_field = 'low_price';
                            $latest_index = 2;
                            break;

                        case 'c':
                            $db_field = 'close_price';
                            $latest_index = 3;
                            break;

                        case 'v':
                            $db_field = 'total_volume';
                            $latest_index = 4;
                            break;

                        case 'd':
                            $db_field = 'lm_date_time';
                            $latest_index = 5;

                            break;
                        default:
                            $db_field = 'close_price';
                            $latest_index = 3;
                    }

                    $latest_data_file = "data/$instrument_id/eod/latest.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);     
                    }else{
                        $today_data=[];  
                    }

                    if(isset($today_data[5]) and $today_data[5]!=$last_update_date)
                    {
                        // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday

                        $latest_data=$today_data[$latest_index];
                        array_unshift($contents, $latest_data);   //adding latest data

                    }




                }
            }

        }


        return $contents;
    }
    public static function getAdjustedWeeklyData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/weekly/adjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {
                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    switch ($field) {
                        case 'o':
                            $db_field = 'open_price';
                            $latest_index = 0;
                            break;

                        case 'h':
                            $db_field = 'high_price';
                            $latest_index = 1;
                            break;

                        case 'l':
                            $db_field = 'low_price';
                            $latest_index = 2;
                            break;

                        case 'c':
                            $db_field = 'close_price';
                            $latest_index = 3;
                            break;

                        case 'v':
                            $db_field = 'total_volume';
                            $latest_index = 4;
                            break;

                        case 'd':
                            $db_field = 'lm_date_time';
                            $latest_index = 5;

                            break;
                        default:
                            $db_field = 'close_price';
                            $latest_index = 3;
                    }


                    $latest_data_file = "data/$instrument_id/eod/latest.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);     
                    }else{
                        $today_data=[];  
                    }

                    if(isset($today_data[5]) and $today_data[5]!=$last_update_date)
                    {
                        //if it is new week , we have to add new element

                        $last_trade_date_week_number = date('W', strtotime($last_update_date) + 24 * 60 * 60);
                        $today_week_number = date('W', strtotime($today_data[5]) + 24 * 60 * 60);

                        if ($last_trade_date_week_number == $today_week_number)
                            $new_week = 0;
                        else
                            $new_week = 1;

                        if ($new_week) {
                            $latest_data = $today_data[$latest_index];
                            array_unshift($contents, $latest_data);


                        } else {
                            // open remain unchanged

                            if ($field == 'h') {
                                $latest_data = $today_data[$latest_index];
                                //if new high
                                if ($latest_data > $contents[0])
                                    $contents[0] = $latest_data;

                            }

                            if ($field == 'l') {
                                $latest_data = $today_data[$latest_index];
                                //if new low
                                if ($latest_data < $contents[0])
                                    $contents[0] = $latest_data;

                            }
                            if ($field == 'c') {
                                $latest_data = $today_data[$latest_index];
                                //latest weekly close
                                $contents[0] = $latest_data;

                            }

                            if ($field == 'v') {
                                $latest_data = $today_data[$latest_index];
                                //add today's additional volume
                                $contents[0] += $latest_data;

                            }

                            // date remain unchanged
                        }


                    }

                }
            }

        }
        return array_slice($contents, 0, 248);

    }
    public static function getAdjustedMonthlyData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/monthly/adjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {
                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    switch ($field) {
                        case 'o':
                            $db_field = 'open_price';
                            $latest_index = 0;
                            break;

                        case 'h':
                            $db_field = 'high_price';
                            $latest_index = 1;
                            break;

                        case 'l':
                            $db_field = 'low_price';
                            $latest_index = 2;
                            break;

                        case 'c':
                            $db_field = 'close_price';
                            $latest_index = 3;
                            break;

                        case 'v':
                            $db_field = 'total_volume';
                            $latest_index = 4;
                            break;

                        case 'd':
                            $db_field = 'lm_date_time';
                            $latest_index = 5;

                            break;
                        default:
                            $db_field = 'close_price';
                            $latest_index = 3;
                    }


                    $latest_data_file = "data/$instrument_id/eod/latest.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);     
                    }else{
                        $today_data=[];  
                    }

                    if(isset($today_data[5]) and $today_data[5]!=$last_update_date)
                    {
                        //if it is new month , we have to add new element

                        $last_trade_date_month_number = date('M', strtotime($last_update_date) + 24 * 60 * 60);
                        $today_month_number = date('W', strtotime($today_data[5]) + 24 * 60 * 60);

                        if ($last_trade_date_month_number == $today_month_number)
                            $new_month = 0;
                        else
                            $new_month = 1;

                        if ($new_month) {
                            $latest_data = $today_data[$latest_index];
                            array_unshift($contents, $latest_data);


                        } else {

                            // open remain unchanged

                            if ($field == 'h') {
                                $latest_data = $today_data[$latest_index];
                                //if new high
                                if ($latest_data > $contents[0])
                                    $contents[0] = $latest_data;

                            }

                            if ($field == 'l') {
                                $latest_data = $today_data[$latest_index];
                                //if new low
                                if ($latest_data < $contents[0])
                                    $contents[0] = $latest_data;

                            }
                            if ($field == 'c') {
                                $latest_data = $today_data[$latest_index];
                                //latest weekly close
                                $contents[0] = $latest_data;

                            }

                            if ($field == 'v') {
                                $latest_data = $today_data[$latest_index];
                                //add today's additional volume
                                $contents[0] += $latest_data;

                            }

                            // date remain unchanged
                        }


                    }

                }
            }

        }
        return array_slice($contents, 0, 248);

    }
    public static function get5MinutesUnadjustedData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/intraday/5_minutes/unadjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            $update_date=date("Y-m-d",strtotime($last_update_date));
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {

                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    $file_path = "data/$instrument_id/intraday/5_minutes/latest";

                    $latest_data_file="$file_path/$field.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);     
                    }else{
                        $today_data=[];  
                    }    
        


                    if (isset($today_data[0]))
                    {

                        if($today_data[0] != $last_update_date)
                        {
                            // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday


                            array_shift($today_data); // removing update time note

                            $today_data=array_reverse($today_data);

                            $result = array_merge($today_data, $contents);

                            $contents= $result;
                        }

                    }


                }
            }

        }


        return $contents;

    }
    public static function get15MinutesUnadjustedData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/intraday/15_minutes/unadjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            $update_date=date("Y-m-d",strtotime($last_update_date));
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {

                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    $file_path = "data/$instrument_id/intraday/15_minutes/latest";

                    $latest_data_file="$file_path/$field.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);
                    }else{
                        $today_data=[];
                    }



                    if (isset($today_data[0]))
                    {

                        if($today_data[0] != $last_update_date)
                        {
                            // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday


                            array_shift($today_data); // removing update time note

                            $today_data=array_reverse($today_data);

                            $result = array_merge($today_data, $contents);

                            $contents= $result;
                        }

                    }


                }
            }

        }


        return $contents;

    }
    public static function get30MinutesUnadjustedData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/intraday/30_minutes/unadjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            $update_date=date("Y-m-d",strtotime($last_update_date));
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {

                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    $file_path = "data/$instrument_id/intraday/30_minutes/latest";

                    $latest_data_file="$file_path/$field.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);
                    }else{
                        $today_data=[];
                    }



                    if (isset($today_data[0]))
                    {

                        if($today_data[0] != $last_update_date)
                        {
                            // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday


                            array_shift($today_data); // removing update time note

                            $today_data=array_reverse($today_data);

                            $result = array_merge($today_data, $contents);

                            $contents= $result;
                        }

                    }


                }
            }

        }


        return $contents;

    }
    public static function get60MinutesUnadjustedData($instrument_id,$field='c',$latest=1)
    {

        $contents=array();
         $file = "data/$instrument_id/intraday/60_minutes/unadjusted/$field.txt";

        if(Storage::disk('local')->exists($file))
        {

            $contents = Storage::get($file);
            $contents=explode(',',$contents);
            $last_update_date=$contents[0];
            $update_date=date("Y-m-d",strtotime($last_update_date));
            array_shift($contents); //removing 1st row as it contain update date information which is not expected data


            if($latest)
            {

                if($last_update_date!=date('Y-m-d')) {
                    // after running corn (updating after trade hour), its useless to look for latest.txt. it will save us from unnecessary look for latest.txt at same date
                    // we could use last trade_date but it needs db access. So to save resource we are using date()


                    $file_path = "data/$instrument_id/intraday/60_minutes/latest";

                    $latest_data_file="$file_path/$field.txt";
                    if(Storage::disk('local')->exists($latest_data_file)){
                        $today_data = Storage::get($latest_data_file);

                        $today_data=explode(',',$today_data);
                    }else{
                        $today_data=[];
                    }



                    if (isset($today_data[0]))
                    {

                        if($today_data[0] != $last_update_date)
                        {
                            // here we are checking again so that it does not add duplicate data from latest.txt - specially friday and saterday


                            array_shift($today_data); // removing update time note

                            $today_data=array_reverse($today_data);

                            $result = array_merge($today_data, $contents);

                            $contents= $result;
                        }

                    }


                }
            }

        }


        return $contents;

    }


} 