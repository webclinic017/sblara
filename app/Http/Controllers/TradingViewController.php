<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DataBankEodRepository;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\ExchangeRepository;
use App\Repositories\InstrumentRepository;
use Carbon\Carbon;
use App\ChartLayout;

class TradingViewController extends Controller
{
    public function search(Request $request)
    {
        $limit = (int) $request->input('limit', 30);
        $query = $request->input('query',null);
        $type='stock';
        $exchangeName = $request->input('exchange', 'DSE');
        if(is_null($exchangeName))
            $exchangeName='DSE';
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getTradingViewInstrumentList($limit,$query,$type,$exchangeDetails);
        return $instrumentList;
    }


    public function symbols(Request $request)
    {
        $instrumentCode = $request->input('symbol','DSEX');
        $exchangeName="DSE";
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();

        $returnData['name']="$instrumentCode";
        $returnData['exchange-traded']="$exchangeName";
        $returnData['exchange-listed']="$exchangeName";
        //$returnData['timezone']='UTC';
        $returnData['timezone']='Asia/Almaty';
        $returnData['minmov']=1;
        $returnData['minmov2']=2;
        $returnData['pricescale']=10;
        $returnData['pointvalue']=1;
        //$returnData['session']='1030-1430;1'; //https://github.com/tradingview/charting_library/wiki/Trading-Sessions   github user: afmsohail@gmail.com
        $returnData['session'] = '1;1000-1600:12345';
        $returnData['has_daily']=true;
        $returnData['has_weekly_and_monthly'] = false;
        $returnData['has_intraday']=true;
        $returnData['has_no_volume']=false;
        $returnData['ticker']="$instrumentCode";
        $returnData['description']="$instrumentCode-SB";
        $returnData['sector']='sector';
        $returnData['type']='stock';
        $returnData['supported_resolutions']=array("5","15","30","60","D","2D","3D","W","2W","M","6M");

        return $returnData;


    }

    public function intraData($instrument_id, $from, $to, $resolution)
    {
        $candle_time=$resolution*60;

        $from=Carbon::createFromTimestamp($from);
        $from_date=$from->format('Y-m-d H:i:s');

        $to=Carbon::createFromTimestamp($to);
        $to_date=  $to->format('Y-m-d H:i:s');


        $sql = "select DISTINCT(total_volume),instrument_id,markets.market_closed,open_price,close_price,pub_last_traded_price,spot_last_traded_price,UNIX_TIMESTAMP(lm_date_time) as date_timestamp
from data_banks_intradays,markets
where lm_date_time >= '$from_date' and lm_date_time < '$to_date' and instrument_id=$instrument_id and markets.id = data_banks_intradays.market_id
ORDER BY lm_date_time asc ,total_volume asc";

        $all_data = \DB::select($sql);

        $returnData=array();
        if (count($all_data)) {

            $grouped=array();
            foreach($all_data as $data)
            {
                $ltp=$data->spot_last_traded_price?$data->spot_last_traded_price:$data->pub_last_traded_price;
                $day_key=date('Y-m-d', $data->date_timestamp);

                // deducting 60 seconds so that 2.30 PM data includes in previous base_time_key (here 2.15 PM)
                $market_closed=strtotime("$day_key ".$data->market_closed);
                if($data->date_timestamp>=$market_closed)
                $data->date_timestamp= $data->date_timestamp-60;

                $q=$data->date_timestamp%$candle_time;
                //$base_time_key=date('Y-m-d H:i', $data->date_timestamp-$q);
                $base_time_key=$data->date_timestamp-$q;

                $time=date('H:i:s', $data->date_timestamp);
                $data->time=$time;
                $data->ltp=$ltp;
                $grouped[$day_key][$base_time_key][]= $data;
            }





            foreach($grouped as $trade_date=>$all_day_data)
            {
                $last_total_volume=0;
                $count=0;
                foreach($all_day_data as $base_time=>$grouped_by_time_frame_data)
                {
                    //if($count>5)  break;


                    $first_data= $grouped_by_time_frame_data[0];
                    $last_data= $grouped_by_time_frame_data[count($grouped_by_time_frame_data) - 1];


                    $date = $base_time;
                    if($count==0)
                    {
                        // its first data of the day. day open will be counted for very first data
                        $open= $first_data->open_price;

                    }else
                    {
                        $open= $first_data->ltp;
                    }

                    $close= $last_data->ltp;
                    $high=collect($grouped_by_time_frame_data)->max('ltp');
                    $low=collect($grouped_by_time_frame_data)->min('ltp');
                    // $volume = collect($grouped_by_time_frame_data)->sum('total_volume');

                    $volume=$last_data->total_volume-$last_total_volume;
                    if($volume<1)
                        continue;


                    //dump($grouped_by_time_frame_data);
                    // dump("o=$open h=$high l= $low c=$close v=$volume d=$date");
                    //    dump($last_data->total_volume."-".$last_total_volume."= $volume");

                    $last_total_volume=$last_data->total_volume;

                    $returnData['t'][] = $date;
                    $returnData['c'][] = $close;
                    $returnData['o'][] = $open;
                    $returnData['h'][] = $high;
                    $returnData['l'][] = $low;
                    $returnData['v'][] = $volume;


                    $count++;
                }



            }





        }

        if(count($returnData)) {
            $returnData['s'] = "ok";
        }else
        {
            $returnData['s'] = "no_data";
            //  $returnData['nextTime'] = strtotime('1999-01-01');
        }

        return collect($returnData)->toJson();

    }


    public function weeklyData($instrument_id, $from, $to, $resolution)
    {

        $eodData = DataBankEodRepository::getEodDataAdjusted($instrument_id, $from, $to, 0);
        $eodData = $eodData->reverse();
        //$eodData = DataBankEodRepository::getAdjustedDataForTradingView($instrument_id, $from, $to, 0);

        $returnData = array();

        if (count($eodData)) {

            $weekly_grouped = array();
            foreach ($eodData as $data) {
                $key = date('W-y', $data['date_timestamp'] + 24 * 60 * 60);  // adding 1 day to start week from sunday. other wise it will start from monday
                $weekly_grouped[$key][] = $data;
            }


            //$weekly_grouped = array_reverse($weekly_grouped, true);


            foreach ($weekly_grouped as $week => $data) {
                $first_day_of_week = $data[0];
                $last_day_of_week = $data[count($data) - 1];


                //$date = date('Y-m-d', $first_day_of_week['date_timestamp']);
                $date = $first_day_of_week['date_timestamp'];
                $open = $first_day_of_week['open'];
                $close = $last_day_of_week['close'];
                $high = collect($data)->max('high');
                $low = collect($data)->min('low');
                $volume = collect($data)->sum('volume');

                $returnData['t'][] = $date;
                $returnData['c'][] = $close;
                $returnData['o'][] = $open;
                $returnData['h'][] = $high;
                $returnData['l'][] = $low;
                $returnData['v'][] = $volume;


            }


        }


        if (count($returnData)) {
            $returnData['s'] = "ok";
        } else {
            // $returnData['s'] = "no_data";
            //  $returnData['nextTime'] = strtotime('1999-01-01');
        }

        return collect($returnData)->toJson();

    }

    public function history(Request $request)
    {
        // dd('under construction');
        $instrumentCode = $request->input('symbol','DSEX');
        $resolution = $request->input('resolution');

        $exchangeName="DSE";
        $exchangeDetails=ExchangeRepository::getExchangeInfo($exchangeName);
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex($exchangeDetails->id);

        $instrumentInfo=$instrumentList->where('instrument_code',"$instrumentCode")->first();


        $from=(int) $request->input('from');
        $to=(int) $request->input('to',time());

        if($resolution=='D') {
                   // $data =  \Cache::remember("tv_D_ins_".$instrumentInfo->id, 1, function () use ($instrumentInfo, $resolution)
                   //  {
                        // return  $data = DataBankEodRepository::getAdjustedDataForTradingView($instrumentInfo->id, strtotime("01-01-2000"), time(), $resolution);
                        return  $data = DataBankEodRepository::getAdjustedDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
                 //    });
                 // return $data;
    
           
            //$data = DataBankEodRepository::getEodDataAdjusted($instrumentInfo->id, $from, $to);
        }
        elseif($resolution=='W') {
            // if  $returnData['has_weekly_and_monthly']=true at symbols() then enable following line
           // $data = self::weeklyData($instrumentInfo->id, $from, $to, $resolution);

        }else
        {
            //$data = DataBanksIntradayRepository::getDataForTradingView($instrumentInfo->id, $from, $to, $resolution);
            $data = self::intraData($instrumentInfo->id, $from, $to, $resolution);

        }

       // return response()->view('dashboard', ['trade_date_Info' => $trade_date_Info])->setTtl(1);
        return response($data)->header('Content-Type', 'application/json');
        //return $data;

    }

    public function config()
    {

        //https://github.com/tradingview/charting_library/wiki/Customization-Overview
        //old config:   {"supports_search":true,"supports_group_request":false,"supports_marks":true,"supports_timescale_marks":true,"supports_time":true,"exchanges":[{"value":"","name":"All Exchanges","desc":""},{"value":"XETRA","name":"XETRA","desc":"XETRA"},{"value":"NSE","name":"NSE","desc":"NSE"},{"value":"NasdaqNM","name":"NasdaqNM","desc":"NasdaqNM"},{"value":"NYSE","name":"NYSE","desc":"NYSE"},{"value":"CDNX","name":"CDNX","desc":"CDNX"},{"value":"Stuttgart","name":"Stuttgart","desc":"Stuttgart"}],"symbolsTypes":[{"name":"All types","value":""},{"name":"Stock","value":"stock"},{"name":"Index","value":"index"}],"supportedResolutions":["D","2D","3D","W","3W","M","6M"]}
        $config=array();
        $config['supports_search']=true;
        $config['supports_group_request']=false;
        $config['supported_resolutions']=array("5","15","30","60","D","2D","3D","W","2W","M","6M");
        $config['supports_marks']=false;
        $config['supports_time']=true;

        $exchange_dse=array();
        $exchange_dse['value']="DSE";
        $exchange_dse['name']="DSE";
        $exchange_dse['desc']="Dhaka Stock Exchange";

        $exchange_cse=array();
        $exchange_cse['value']="CSE";
        $exchange_cse['name']="CSE";
        $exchange_cse['desc']="Chittagong Stock Exchange";

        $config['exchanges'][]=$exchange_dse;
        $config['exchanges'][]=$exchange_cse;

        $symbolType=array();
        $symbolType['name']="Stock";
        $symbolType['value']="Stock";

        $config['symbolsTypes'][]=$symbolType;
        return $config;
    }

    public function snapShot()
    {
        $path = __DIR__."/../../../storage/app/public/chartimages/";
            if(!file_exists($path))
            {
                mkdir ($path);
            }
        $request = json_decode($_POST['images']);
      // set the color      


            $filename = md5(time());
            $ext = ".png";

            // decode and store in variable time axis
            $time_axis = $request->charts[0]->timeAxis->content;
            $time_axis = str_replace('data:image/png;base64,', '', $time_axis);
            $time_axis = str_replace(' ', '+', $time_axis);
            $time_axis = base64_decode($time_axis);
            $time_axis = imagecreatefromstring($time_axis);
          

             // decode and store in variable time axis
            $time_axis_stub = $request->charts[0]->timeAxis->rhsStub->content;
            $time_axis_stub = str_replace('data:image/png;base64,', '', $time_axis_stub);
            $time_axis_stub = str_replace(' ', '+', $time_axis_stub);
            $time_axis_stub = base64_decode($time_axis_stub);
            $time_axis_stub = imagecreatefromstring($time_axis_stub);
            

            // create  empty image with height = height of chart  and width =width of chart +width of axis
            $canvaswidth = $request->charts[0]->panes[0]->contentWidth + $request->charts[0]->panes[0]->rightAxis->contentWidth;
            $canvasHeight = (int) $request->charts[0]->timeAxis->contentHeight;
            foreach($request->charts[0]->panes as $val) {
                $canvasHeight += (int) $val->contentHeight;
            }
            $image = imagecreatetruecolor(
                $canvaswidth,
                $canvasHeight
            );

            $color = $request->charts[0]->colors->text;
            if(isset($color[6])){
                $color = imagecolorallocate($image, hexdec($color[1].$color[2]), hexdec($color[3].$color[4]), hexdec($color[5].$color[6]));
            }else{
                $color = imagecolorallocate($image, hexdec($color[1]), hexdec($color[2]), hexdec($color[3]));
            }
          $font = __DIR__.'/arial.ttf';            
            // decode and store in variable chart  
            // dd(count($request->charts[0]->panes));
            $i = -1;
            $padding = 0;
            foreach ($request->charts[0]->panes as $pane) {
                $content = $pane->content;
                $content = str_replace('data:image/png;base64,', '', $content);
                $content = str_replace(' ', '+', $content);
                $content = base64_decode($content);
                $content = imagecreatefromstring($content);

            // decode and store in variable right axis
            if(isset($pane->rightAxis))
            {            
                $right_axis = $pane->rightAxis->content;
                $right_axis = str_replace('data:image/png;base64,', '', $right_axis);
                $right_axis = str_replace(' ', '+', $right_axis);
                $right_axis = base64_decode($right_axis);
                $right_axis = imagecreatefromstring($right_axis);
            }


            if($i != -1){
                //set studies
                $padding += (int) $request->charts[0]->panes[$i]->contentHeight;
            }else{
                $count = count($request->charts[0]->panes) - 1;
                $additional = (int) $request->charts[0]->panes[$count]->contentHeight;
            }
            $i++;
            $studyMargin = 15;
            if(isset($pane->studies)){
                foreach ($pane->studies as $study) {
                    $studyMarginTotal = $studyMargin;
                    if($i == 0){
                        $studyMarginTotal += 30;
                    }
                imagettftext($content, 9, 0, 10, $studyMarginTotal, $color, $font, $study);
                $studyMargin += 15;
                }
            }
            //replace area of chart in image with chart 
            imagecopymerge(
                        $image,
                        $content,
                        0,
                        $padding,
                        0,
                        0,
                        $pane->contentWidth,
                        $pane->contentHeight,
                        100
                    );

            //replace area of right axis in image with axis
             imagecopymerge(
                        $image,
                        $right_axis,
                        $request->charts[0]->panes[0]->contentWidth,
                        $padding,
                        0,
                        0,
                        $pane->rightAxis->contentWidth,
                        $pane->rightAxis->contentHeight,
                        100
                    );

            }


            //replace area of time axis in image with axis

            imagecopymerge(
                        $image,
                        $time_axis,
                        0,
                        $padding+ (int) $additional,       
                        0,
                        0,
                        $request->charts[0]->timeAxis->contentWidth,
                        $request->charts[0]->timeAxis->contentHeight,
                        100
                    );            
            imagecopymerge(
                        $image,
                        $time_axis_stub,
                        $request->charts[0]->timeAxis->contentWidth,
                        $padding + (int) $additional,       
                        0,
                        0,
                        $request->charts[0]->timeAxis->contentWidth,
                        $request->charts[0]->timeAxis->contentHeight,
                        100
                    );            




// imagefilledrectangle($image, 0, 0, 399, 29, $white);

// The text to draw
$symbol = $request->charts[0]->meta->symbol;
$text = $request->charts[0]->meta->symbol.", ".$request->charts[0]->meta->resolution.", ". $request->charts[0]->meta->exchange;
$text2 = "O: ".$request->charts[0]->ohlc[0].", H: ".$request->charts[0]->ohlc[1].", L: ". $request->charts[0]->ohlc[2].", C: ".$request->charts[0]->ohlc[2];
// Replace path by your own font path


header('Content-Type: image/png');
// Add some shadow to the text
// imagettftext($image, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
imagettftext($image, 13, 0, 10, 17, $color, $font, $text);
imagettftext($image, 10, 0, 10, 32, $color, $font, $text2);

            $stamp = imagecreatefromgif(__DIR__."/../../../public/img/chart_logo.gif");
            // $clr = imagecolorallocatealpha($stamp, 255, 255, 255, 255);
            // imagefill($stamp, 0, 0, $clr);
             // imagecolortransparent ($image,);
                $marge_right = 10;
                $width =  $canvaswidth-100;
                $height =  $canvasHeight - 70;
                $marge_bottom = 10;
                $sx = imagesx($stamp);
                $sy = imagesy($stamp);
                $filename = $symbol.'_'.$filename;
                imagecopy($image, $stamp, $width/2, $height/2, 0, 0, imagesx($stamp), imagesy($stamp));
            imagepng($image,  $path.$filename.$ext);        
            die(asset('storage/chartimages/'.$filename));
    }

    public function share($image)
    {
        if(request()->has('download')){
            $path = $path = storage_path('app/public/chartimages/'.$image.'.png');
            return response()->download($path);
        }
        return view('tradingview-share')->with('image', $image);
    }

    public function saveLayout(Request $request)
    {
        $slug = str_slug($request->name);
        $count = \App\ChartLayout::where('name', $request->name)->count();
        if($count != 0){
            $slug = $slug . "-".$count;
        }
        if($request->has('chart')){
            //update
            $layout = \App\ChartLayout::find($request->chart);
            if($layout->user_id != $this->user()->id){
                abort(403);
            }
            $layout->content = $request->content;
            $layout->symbol = $request->symbol;
            $layout->resolution = $request->resolution;
            $layout->name = $request->name;
                
                $count = \App\ChartLayout::where('name', $request->name)->where('id', '!=', $request->chart)->count();
                if($count != 0){
                    $slug = $slug . "-".$count;
                }            

            $layout->slug = $slug;
            $layout->updated_at = \Carbon\Carbon::now();
            $layout->save();
            return ['status' => 'ok'];
        }

            $count = \App\ChartLayout::where('name', $request->name)->count();
            if($count != 0){
                $slug = $slug . "-".$count;
            }                    
        \App\ChartLayout::insert(['name' => $request->name, 'user_id' => $this->user()->id, 'content' => $request->content, 'symbol' => $request->symbol, 'resolution' => $request->resolution, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(), 'slug' => $slug]);
        return ['status' => 'ok'];
    }

    public function layouts(Request $request)
    {
        if($request->has('chart'))
        {
            $data = [];
            $c = \App\ChartLayout::find($request->chart);
            $c->updated_at = Carbon::now();
            $c->save(); 
            $data['data'] = $c;
            $data['status'] = 'ok';
            return $data; 
        }
        // dd((int) $this->user()->id);
        $data = [];
        $data['data'] = \App\ChartLayout::select('id', 'name', 'resolution', 'slug', 'symbol', 'updated_at')->where('user_id', "=", (string) $this->user()->id)->get();
        $data['status'] = 'ok';
        return $data;
    }

    public function current()
    {
            $c = \App\ChartLayout::where('user_id', (string) $this->user()->id)->orderBy('updated_at', 'desc')->first();
            return $c->slug; 
    }

    public function user()
    {
        if(!$user = request()->user())
        {
            $user = new \stdClass();
            if(!request()->session()->has('TVUserID')){
                session(['TVUserID' => md5(uniqid().time())]);
            }
            $user->id = session()->get('TVUserID');
            $user->name = 'Anonymous';
        }else{
        //sync settings
            
            if(request()->session()->has('TVUserID')){
                \App\ChartLayout::where("user_id", session('TVUserID'))->update(['user_id' => $user->id]);
            }
        }
        return $user;
    }

    public function chart($ticker, $name, $layout=false)
    {
        // return view("tempdown");
        if($layout){
            $data['status'] = 'ok';
            $layout = \App\ChartLayout::where('slug', $layout)->first();
            $data['data'] = $layout;
            $layout = $data;
        }
        $user = $this->user();
        $instrumentInfo = \App\Instrument::where('instrument_code', $ticker)->first();
        return response()->view('advance-ta-chart-new', ['ticker' => $ticker, 'instrumentInfo' => $instrumentInfo, 'layout' => $layout]);
    }

    public function delete()
        {
            $chart = ChartLayout::find(request()->chart);
            if($chart->user_id == $this->user()->id){
                $chart->delete();
                return ['status'=>'ok'];
            }

        } 

    public function tree()
       {
                // var data = [
                //        {
                //          'text' : 'Root node 2',
                //          'state' : {
                //            'opened' : true,
                //            'selected' : true
                //          },
                //          'children' : [
                //            { 'text' : 'Child 1' },
                //            'Child 2',{
                //             'text' : 'test node',
                //             'children': [
                //                 'hey', 'there'
                //             ]
                //            },
                //            'child 3',
                //            'child 4'
                //          ]
                //       }
                //     ]        
            $data = [];
            $list = new \stdClass();
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            $data[] = 'test'; 
            return $data;
       }

       public function tab($tab)
          {
            return view('tv.tabs.'.$tab);
          }   
}
