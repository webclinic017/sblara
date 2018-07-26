<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $dates = [
        'post_date',

    ];

    public function instrument() {
        return $this->belongsTo('\App\Instrument');
    }

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public static function getWholeDayNews($tradeDate=null,$exchangeId=0)
    {
        /*We will use session value of active_trade_date as default if exist*/

        if(is_null($tradeDate)) {
            $tradeDate = session('active_trade_date', null);
        }


        /*We will use session value of active_exchange_id as default if exist*/
        if(!$exchangeId) {
            $exchangeId = session('active_exchange_id', 1);
        }

        $m=new Market();
        $activeDate=$m->getActiveDates(1,$tradeDate,$exchangeId)->first();
        $marketId=$activeDate->id;

        $allnews=static::where('market_id',$marketId)->where('is_active',1)->orderBy('post_date', 'desc')->get();

        return $allnews;

    }

    public static function getAllNewsByInstrumentId($instrument_id=0,$limit=1000)
    {
        // if only 1 instrument id given, we are inserting this into array.
        // we are doing this for backward compatibility
        $instrument_arr=array();

        if(is_array($instrument_id))
            $instrument_arr=$instrument_id;
        else
        {
            $instrument_arr[]=$instrument_id;
        }

        $allNews=static::whereIn('instrument_id',$instrument_arr)->where('is_active',1)->orderBy('post_date', 'desc')->skip(0)->take($limit)->get();
        return $allNews;

    }

    public static function getAllNewsByInstrumentIdGroupByDate($instrument_id=0)
    {
        $posts = Post::all()->groupBy(function($item){ return $item->created_at->format('d-M-y'); });

        $allNews=static::where('instrument_id',$instrument_id)->where('is_active',1)->orderBy('post_date', 'desc')->get();

        return $allNews;

    }
/// parsing news
    public function getEpsAttribute()
    {
        try {
        $data =  $this->parseNews();
        foreach ($data as $key => $value) {
            if(strpos($value, '(') !== false){
                $value = str_replace(['(', ')'], ['-', ''], $value);
                $data[$key] = $value;
            }

        }
        return $data;
        } catch (\Exception $e) {
            // dd($e);
        }
    
    }

    public function getTypeAttribute()
    {
       if (strpos($this->details, '(Q3 Un-audited):') !== false) {
            return "Q3";
        }
       if (strpos($this->details, '(Q2 Un-audited):') !== false) {
            return "Q2";
        }
       if (strpos($this->details, '(Q1 Un-audited):') !== false) {
            return "Q1";
        }
       if (strpos($this->details, 'the Fund has reported Net Asset Value') !== false) {
            return "mf";
        }

        return request()->type;
    }

    public function parseNews()
    {
    $type = $this->type;

        if($type == 'Q2'){
            $rgx = "/was Tk.(.*?)as/";
            if(!preg_match_all($rgx, $this->fullDetails, $matches)){
                            return $data =  ['q2_eps_cont_op' => '', 'half_year_eps_cont_op' => '', 'half_year_nocf_per_share' => '', 'half_year_net_asset_val_per_share' => '', 'meta_date' => '' ];
                // throw new \Exception("Error news parsing: $this->details", 1);
            }
            if(isset($matches[1][0])){

                if(!isset(explode('-', str_replace(["'", ","], ' ', $matches[1][0]))[1])){
                                return $data =  ['q2_eps_cont_op' => '', 'half_year_eps_cont_op' => '', 'half_year_nocf_per_share' => '', 'half_year_net_asset_val_per_share' => '', 'meta_date' => '' ];

                throw new \Exception("Error news parsing: $this->details", 1);
                }

                try {
                    
            $eps = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][0])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][0]))[1])->format('Y-m-d') ];
                } catch (\Exception $e) {
                    return $data =  ['q2_eps_cont_op' => '', 'half_year_eps_cont_op' => '', 'half_year_nocf_per_share' => '', 'half_year_net_asset_val_per_share' => '', 'meta_date' => '' ];
                }

            }

            if(isset($matches[1][1])){

                if(!isset(explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])){
                                                    return $data =  ['q2_eps_cont_op' => '', 'half_year_eps_cont_op' => '', 'half_year_nocf_per_share' => '', 'half_year_net_asset_val_per_share' => '', 'meta_date' => '' ];
                throw new \Exception("Error news parsing: $this->details", 1);
                }
            $epsNineMonth = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][1])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])->format('Y-m-d') ];
            }

            if(isset($matches[1][2])){
                if(!isset(explode('-', str_replace(["'", ","], ' ', $matches[1][2]))[1])){
                    // dump($this->details);
                    // dump($matches);
                    // dump($matches[1][2]);
                       $nav = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][2])[0])), 'meta_date' => $eps['meta_date']];

                }
                try {
                    \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][2]))[1])->format('Y-m-d') ;
  
                } catch (\Exception $e) {
                    $matches[1][2] = str_replace(". NOCFPS w", " ", $matches[1][2]);
                }
                if(!isset($nav)){

                    $noc = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][2])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][2]))[1])->format('Y-m-d') ];
                }else{
                    $noc = ['meta_value' => null, 'meta_date' => null];
                }
            }

            if(isset($matches[1][3])){
            $nav = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][3])[0])), 'meta_date' => $noc['meta_date']];
            }else{
                if(!isset($nav)){
                    $nav = ['meta_value' => null, 'meta_date' => null];
                }
            }

            return $data =  ['q2_eps_cont_op' => $eps['meta_value'], 'half_year_eps_cont_op' => $epsNineMonth['meta_value'], 'half_year_nocf_per_share' => $noc['meta_value'], 'half_year_net_asset_val_per_share' => $nav['meta_value'], 'meta_date' => $eps['meta_date'] ];

        }else if($type == 'Q3'){
            //parse q2
            // dd($this->details);
            $rgx = "/was Tk.(.*?)as/";
            if(!preg_match_all($rgx, $this->fullDetails, $matches)){
                return $data =  ['q3_eps_cont_op' => '', 'q3_nine_months_eps' => '', 'q3_nine_months_nocf_per_share' => '', 'q3_nine_months_net_asset_val_per_share' => '', 'meta_date' => '' ];
            }
   
            if(isset($matches[1][0])){
            // dump($matches);
            try {
                
            $eps = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][0])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][0]))[1])->format('Y-m-d') ];
            } catch (\Exception $e) {
                return $data =  ['q3_eps_cont_op' => '', 'q3_nine_months_eps' => '', 'q3_nine_months_nocf_per_share' => '', 'q3_nine_months_net_asset_val_per_share' => '', 'meta_date' => '' ];
            }
            }else{
                         return $data =  ['q3_eps_cont_op' => '', 'q3_nine_months_eps' => '', 'q3_nine_months_nocf_per_share' => '', 'q3_nine_months_net_asset_val_per_share' => '', 'meta_date' => '' ];
            
            }

            if(isset($matches[1][1])){

            $epsNineMonth = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][1])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])->format('Y-m-d') ];
            }else{
                          return $data =  ['q3_eps_cont_op' => '', 'q3_nine_months_eps' => '', 'q3_nine_months_nocf_per_share' => '', 'q3_nine_months_net_asset_val_per_share' => '', 'meta_date' => '' ];
            }

            if(isset($matches[1][2])){
                $mdate = null;
                try {
                    
                    $mdate = \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][2]))[1])->format('Y-m-d');
                } catch (\Exception $e) {
                }

            $noc = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][2])[0])), 'meta_date' => $mdate ];

            }
            if(isset($matches[1][3])){
            $nav = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][3])[0])), 'meta_date' => $noc['meta_date']];
            }else{
                          return $data =  ['q3_eps_cont_op' => '', 'q3_nine_months_eps' => '', 'q3_nine_months_nocf_per_share' => '', 'q3_nine_months_net_asset_val_per_share' => '', 'meta_date' => '' ];
            }

            return $data =  ['q3_eps_cont_op' => $eps['meta_value'], 'q3_nine_months_eps' => $epsNineMonth['meta_value'], 'q3_nine_months_nocf_per_share' => $noc['meta_value'], 'q3_nine_months_net_asset_val_per_share' => $nav['meta_value'], 'meta_date' => $eps['meta_date'] ];
            
        }else if($type == 'Q1'){
            //parse q2
            // dd($this->details);
            $rgx = "/was Tk.(.*?)as/";
            if(!preg_match_all($rgx, $this->details, $matches)){
            }
      

            if(isset($matches[1][0])){
                // dump($this->fullDetails);
                // dump($matches);
                  if (strpos($this->details, 'EPU f') !== false){

                    $eps = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][0])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])->format('Y-m-d') ];
                  }else{
                    try {
                        
                    $eps = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][0])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][0]))[1])->format('Y-m-d') ];
                    } catch (\Exception $e) {
                                    return $data =  ['q1_eps_cont_op' => null, 'q1_nocf_per_share' => null,  'q1_net_asset_val_per_share' => null, 'meta_date' => null ];
                    }
                        
                    
                  }
            }

            if(isset($matches[1][1])){

                if(!isset(explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])){
            $epsNineMonth = ['meta_value' => null, 'meta_date' => null ];

            $nav = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][1])[0])), 'meta_date' => $eps['meta_date']];
                }else{
                    
            $epsNineMonth = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][1])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][1]))[1])->format('Y-m-d') ];
                }
            }

            // if(isset($matches[1][2])){

            // $noc = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][2])[0])), 'meta_date' => \Carbon\Carbon::parse("last day of ".explode('-', str_replace(["'", ","], ' ', $matches[1][2]))[1])->format('Y-m-d') ];
            // }
            if(isset($matches[1][2])){
            $nav = ['meta_value' => str_replace([], '', trim(explode('for', $matches[1][2])[0])), 'meta_date' => $eps['meta_date']];
            }
            return $data =  ['q1_eps_cont_op' => $eps['meta_value'], 'q1_nocf_per_share' => $epsNineMonth['meta_value'],  'q1_net_asset_val_per_share' => $nav['meta_value'], 'meta_date' => $eps['meta_date'] ];
            
        }else if($type == "DIVIDEND"){
            $details = $this->fullDetails;
            // dump($details);
            $stock = 0;
            $cash = 0;
            if(preg_match_all("/(( [\d.]*?%) (cash|stock|Stock|Cash))/", $details, $matches)){
                // dd($details);
                // dd($matches);
                foreach ($matches[3] as $key => $value) {
                    if(strtolower($value) == 'cash'){
                        $cash = str_replace("%", "", trim($matches[2][$key]));

                    }else if(strtolower($value) == 'stock'){
                        $stock = str_replace("%", "", trim($matches[2][$key]));
                    }
                }
            }
               $eps = null;
               $nav = null;
               $noc = null;
            if(preg_match_all("/EPS(.*)year/", $details, $matches)){
               $string = $matches[0][0];

               if(preg_match_all("/(Tk. ([+-]?([0-9]*[.])?[0-9]+))/", $string, $matches))
               {
                    if(isset($matches[2][0])){
                        $eps = $matches[2][0];
                    }
                    if(isset($matches[2][1])){
                        $nav = $matches[2][1];
                    }
                    if(isset($matches[2][2])){
                        $noc = $matches[2][2];
                    }
               }
            }else{
                // dd($details);
            }
            $date = null;
            if(preg_match_all("/ended on(.*?\d\d\d\d)/", $details, $n)){
                $date = \Carbon\Carbon::parse($n[1][0])->format('Y-m-d');
            }
                        // earning_per_share 201
            // net_asset_val_per_share 205
            // nocf_per_share 318
            $recordDate = null;
            if(preg_match_all("/Record Date: ([\d.]*)/", $details, $mtchs)){
                $recordDate = $mtchs[1][0];

            }
              return $data =  ['earning_per_share' => $eps, 'net_asset_val_per_share' => $nav,  'nocf_per_share' => $noc, 'meta_date' => $date, 'cashdiv' => $cash, 'stockdiv' => $stock, 'record_date' => $recordDate];
                // dump($date);
                // dump($eps);
                // dump($nav);
                // dump($noc);
                // dump($stock);
                // dd($cash);
        }else if($type == "mf"){
            $mpb = 0; $cpb = 0; $meta_date = 0;
            preg_match_all("/Tk. ([0-9.]+) per/", $this->details, $matches);
            // echo "\">";
            // dd($matches);
            $mpb = $matches[1][0];
            $cpb = $matches[1][1];
            preg_match_all("/operation on (.+[0-9]), the/", $this->details, $matches);
            $meta_date = $matches[1][0];
            $meta_date = \Carbon\Carbon::parse(str_replace(',','', $meta_date))->format('Y-m-d');
            // print_r($mateches);
            // die('df');
            return ['mpb' => $mpb, 'cpb' => $cpb, 'meta_date' => $meta_date];
        }

    }

    public function getFullDetailsAttribute()
    {
        // $fullDetails = $this->details;
       if (strpos($this->details, ' (cont.') !== false) {
        $remaining = $this->details;
        $fullDetails = $remaining;
        $i = -1;
        while (strpos($remaining, ' (cont.') !== false) {
            $i++;
            $remaining = \App\News::where('post_date', 'like', $this->post_date->format('Y-m-d')."%")
                        ->where('details', 'like', "%(Continuation news of ".$this->prefix.")%");
   
                       $remaining =  $remaining->where('prefix', '=', $this->prefix)->orderBy('post_date', 'asc')->take(1)->skip($i)->first();
                       
                       if($remaining){

                            $fullDetails = str_replace("(cont.", "", $fullDetails).str_replace("(Continuation news of ".$this->prefix."):", "", $remaining->details);
         
                       }else{
                        // break;
                       }


        }

           
        }else{
            $fullDetails = $this->details;
        }
        return $fullDetails;
    }

}
