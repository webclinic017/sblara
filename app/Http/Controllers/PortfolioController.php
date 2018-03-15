<?php

namespace App\Http\Controllers;

use App\Mail\PortfolioReportMarkdown;
use App\Portfolio;
use App\Repositories\InstrumentRepository;
use Illuminate\Http\Request;
use DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PortfolioReport;


class PortfolioController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //dd(auth()->user()->portfolios);
        $data = [
            'navigation' => [
                'Portfolio',
                'Your Portfolios',
            ],
            'portfolios' => auth()->user()->portfolios->sortByDesc('id'),
        ];
        return view('portfolio.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = [
            'navigation' => [
                'Portfolio',
                'Create Portfolio',
            ],
        ];
        return view('portfolio.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $cash_amount_to_be_adjusted=0;

        if ($portfolioId = $request->portfolioId) {
            // when editing share

            $portfolio = Portfolio::find($portfolioId);
            if ($request->old_types) {
                foreach ($request->old_types as $key => $type) {
                    $transactionId = $request->old_transaction_ids[$key];
//                    dd($transactionId);
                    switch ($type) {
                        //when sell
                        case 2:
                            /*
                             * @todo share sell validation in front end
                             *
                            */
                            $share_status='sell';
                            $oldtransaction = \App\PortfolioScrip::find($transactionId);
                            $remaining_shares=$oldtransaction->no_of_shares-$request->old_shares[$key];

                            $total_sell_value=$request->old_shares[$key]*$request->old_price_per_share[$key];
                            $sell_commission=($request->old_commissions[$key]/100)*$total_sell_value;
                            $total_sell_value_deducting_commission=$total_sell_value-$sell_commission;

                            $cash_amount_to_be_adjusted=$cash_amount_to_be_adjusted+$total_sell_value_deducting_commission; // amount that will be added with portfolio cash_amount

                            if($remaining_shares>=0)
                            {
                                // if allowed share quantity

                                $transaction = new \App\PortfolioScrip;
                                $transaction->portfolio_id = $oldtransaction->portfolio_id;
                                $transaction->instrument_id = $oldtransaction->instrument_id;
                                $transaction->exchange_id = $oldtransaction->exchange_id;

                                $transaction->no_of_shares=$oldtransaction->no_of_shares;
                                $transaction->buying_price=$oldtransaction->buying_price;
                                $transaction->buying_date =$oldtransaction->buying_date;

                                $transaction->share_status = $share_status;
                                $transaction->no_of_shares =  $request->old_shares[$key];
                                $transaction->sell_price = $request->old_price_per_share[$key];
                                $transaction->sell_date = $request->old_dates[$key];
                                $transaction->commission = $request->old_commissions[$key];
                                $transaction->save();

                                if($remaining_shares) {
                                    //if still share remaining
                                    $oldtransaction->no_of_shares = $remaining_shares;
                                    $oldtransaction->save();
                                }else
                                {
                                    // no shares left. so delete the row
                                    $oldtransaction->delete();
                                }

                            }else
                            {
                                return redirect()->back()->with('status', 'error');
                            }


                            break;
                        case 3:
                            //when edit
                            $transaction = \App\PortfolioScrip::find($request->old_transaction_ids[$key]);
                            if ($transaction) {

                                //lets calculate how much adjustable cash
                                // 1st rollback existing cash amount for this item

                                $total_buy_value=$transaction->no_of_shares*$transaction->buying_price;
                                $buy_commission=($transaction->commission/100)*$total_buy_value;
                                $total_buy_value_with_commission=$total_buy_value+$buy_commission;
                                $cash_amount_to_be_adjusted=$cash_amount_to_be_adjusted+$total_buy_value_with_commission;  // Returning that amount to portfolio cash

                                $transaction->no_of_shares=$request->old_shares[$key];
                                $transaction->buying_price=$request->old_price_per_share[$key];
                                $transaction->commission =$request->old_commissions[$key];
                                $transaction->buying_date = $request->old_dates[$key];
                                $transaction->save();

                                // now re-adding edited amount
                                $total_buy_value=$transaction->no_of_shares*$transaction->buying_price;
                                $buy_commission=($transaction->commission/100)*$total_buy_value;
                                $total_buy_value_with_commission=$total_buy_value+$buy_commission;
                                $cash_amount_to_be_adjusted=$cash_amount_to_be_adjusted-$total_buy_value_with_commission;  // deducting new edited amount from portfolio

                            }
                            break;
                        case 4:
                            //when delete
                            $transaction = \App\PortfolioScrip::find($transactionId);

                            $total_buy_value=$transaction->no_of_shares*$transaction->buying_price;
                            $buy_commission=($transaction->commission/100)*$total_buy_value;
                            $total_buy_value_with_commission=$total_buy_value+$buy_commission;
                            $cash_amount_to_be_adjusted=$cash_amount_to_be_adjusted+$total_buy_value_with_commission;  // returning that amount to cash_amount

                            \App\PortfolioScrip::where('id', $transactionId)->delete();
                            break;
                    }
                }
            }
        } else {
            // new
            $portfolio = new Portfolio();
            $portfolio->user_id = auth()->id();
        }

        $portfolio->portfolio_name = $request->name;
        $portfolio->cash_amount = $request->cash_amount;
        $portfolio->broker_fee = $request->broker_fee;
        $portfolio->save();

        foreach ($request->no_of_shares as $key => $share) {
            if ($share) {
                $portfolioTransaction = new \App\PortfolioScrip;
                $portfolioTransaction->portfolio_id = $portfolio->id;
                $portfolioTransaction->instrument_id = $request->instrument_id[$key];
                $portfolioTransaction->exchange_id = $request->exchange_id[$key];
                $portfolioTransaction->share_status = $request->share_status[$key];
                $portfolioTransaction->no_of_shares = $request->no_of_shares[$key];
                $portfolioTransaction->buying_price = $request->buying_price[$key];
                $portfolioTransaction->commission = $request->commission[$key];
                $portfolioTransaction->buying_date = $request->buying_date[$key];
                $portfolioTransaction->save();

                $total_buy_value=$portfolioTransaction->no_of_shares*$portfolioTransaction->buying_price;
                $buy_commission=($portfolioTransaction->commission/100)*$total_buy_value;
                $total_buy_value_with_commission=$total_buy_value+$buy_commission;
                $cash_amount_to_be_adjusted=$cash_amount_to_be_adjusted-$total_buy_value_with_commission;  // deducting  amount from portfolio


            }
        }

        $portfolio->cash_amount = $portfolio->cash_amount+$cash_amount_to_be_adjusted;
        $portfolio->save();

        return redirect("/portfolio/$portfolio->id")->with('status', 'success');
        return redirect()->back()->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio) {
        if($portfolio->user_id != user()->id)
            {
                abort(404);
            }
        $data = [
            'navigation' => [
                'Portfolio',
                $portfolio->portfolio_name,
                'Performance',
            ],
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'transactions' => $portfolio->portfolio_scrips()->where('share_status', 'buy')->groupBy('instrument_id')->get(),
        ];
        return view('portfolio.show', $data);
    }

    public function performance($id) {
        $portfolio = Portfolio::find($id);
        $data = [
            'navigation' => [
                'Portfolio',
                $portfolio->portfolio_name,
                'Performance',
            ],
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'transactions' => $portfolio->portfolio_scrips()->where('share_status', 'buy')->groupBy('instrument_id')->get(),
        ];
        return view('portfolio.performance', $data);
    }
    public function marketSummary($id) {

     /*   $sql="SELECT instruments.instrument_code
,portfolio_scrips.instrument_id
,instruments.sector_list_id
,sum(((no_of_shares*buying_price)+commission/100*((no_of_shares*buying_price)))) as buying_cost_with_com
,sector_lists.name as sector_name
FROM
portfolio_scrips,instruments,sector_lists
WHERE portfolio_scrips.instrument_id=instruments.id
and sector_lists.id=instruments.sector_list_id
and portfolio_id=$id
and share_status like 'buy'
and instruments.active =1
GROUP BY instrument_id
";*/

        $sql="select instrument_id from portfolio_scrips where portfolio_id=$id and share_status like 'buy' GROUP BY instrument_id";

        $portfolio_holdings=DB::select($sql);

/*
        $sector_wise_holdings=array();
        foreach($portfolio_holdings as $transaction)
        {
            dump($transaction);
            $this_instruments_value= $transaction->buying_cost_with_com;
            isset($sector_wise_holdings[$transaction->sector_name])? $sector_wise_holdings[$transaction->sector_name]+=$this_instruments_value: $sector_wise_holdings[$transaction->sector_name]=$this_instruments_value;
        }*/


//        $instrument_id_arr=collect($portfolio_holdings)->pluck('instrument_id');


//        dd($data['transactions']->toArray());
        return view('portfolio.market_summary', ['portfolio_holdings' => $portfolio_holdings]);
    }
    public function portfolio_chart($id) {

     /*   $sql="SELECT instruments.instrument_code
,portfolio_scrips.instrument_id
,instruments.sector_list_id
,sum(((no_of_shares*buying_price)+commission/100*((no_of_shares*buying_price)))) as buying_cost_with_com
,sector_lists.name as sector_name
FROM
portfolio_scrips,instruments,sector_lists
WHERE portfolio_scrips.instrument_id=instruments.id
and sector_lists.id=instruments.sector_list_id
and portfolio_id=$id
and share_status like 'buy'
and instruments.active =1
GROUP BY instrument_id
";*/

        $sql="select instruments.instrument_code,instrument_id from portfolio_scrips,instruments where portfolio_scrips.instrument_id=instruments.id and portfolio_id=$id and share_status like 'buy' GROUP BY instrument_id ORDER by instrument_code asc";

        $portfolio_holdings=DB::select($sql);

/*
        $sector_wise_holdings=array();
        foreach($portfolio_holdings as $transaction)
        {
            dump($transaction);
            $this_instruments_value= $transaction->buying_cost_with_com;
            isset($sector_wise_holdings[$transaction->sector_name])? $sector_wise_holdings[$transaction->sector_name]+=$this_instruments_value: $sector_wise_holdings[$transaction->sector_name]=$this_instruments_value;
        }*/


//        $instrument_id_arr=collect($portfolio_holdings)->pluck('instrument_id');


//        dd($data['transactions']->toArray());
        return view('portfolio.portfolio_chart', ['portfolio_holdings' => $portfolio_holdings]);
    }
    public function diversity_model($id) {

        $sql="SELECT instruments.instrument_code
,portfolio_scrips.instrument_id
,instruments.sector_list_id
,sum(((no_of_shares*buying_price)+commission/100*((no_of_shares*buying_price)))) as buying_cost_with_com
,sector_lists.name as sector_name
FROM
portfolio_scrips,instruments,sector_lists
WHERE portfolio_scrips.instrument_id=instruments.id
and sector_lists.id=instruments.sector_list_id
and portfolio_id=$id
and share_status like 'buy'
and instruments.active =1
GROUP BY instrument_id
";

      //  $sql="select instruments.instrument_code,instrument_id from portfolio_scrips,instruments where portfolio_scrips.instrument_id=instruments.id and portfolio_id=$id and share_status like 'buy' GROUP BY instrument_id ORDER by instrument_code asc";

        $portfolio_holdings=DB::select($sql);

        $portfolio=DB::select("select cash_amount from portfolios where id=$id");



        $sector_wise_holdings=array();
        foreach($portfolio_holdings as $transaction)
        {
            $this_instruments_value= $transaction->buying_cost_with_com;
            isset($sector_wise_holdings[$transaction->sector_name])? $sector_wise_holdings[$transaction->sector_name]+=$this_instruments_value: $sector_wise_holdings[$transaction->sector_name]=$this_instruments_value;
        }
        $sector_data=array();
        foreach($sector_wise_holdings as $sector=>$sector_total)
        {
            $temp=array();

            $temp['name']=$sector;
            $temp['y']=$sector_total;
            $sector_data[]=$temp;
        }

        $temp=array();
        $temp['name']='Cash';
        $temp['y']=$portfolio[0]->cash_amount;
        $sector_data[]=$temp;


        $portfolio_holdings_data=array();
        foreach($portfolio_holdings as $row)
        {
            $temp=array();

            $temp['name']=$row->instrument_code;
            $temp['y']=$row->buying_cost_with_com;
            $portfolio_holdings_data[]=$temp;
        }

/*        $temp=array();
        $temp['name']='Cash';
        $temp['y']=$portfolio[0]->cash_amount;
        $portfolio_holdings_data[]=$temp;*/


        return view('portfolio.diversity_model', ['portfolio_holdings_data' =>  collect($portfolio_holdings_data)->toJson(),'sector_data' => collect($sector_data)->toJson()]);
    }
    public function portfolio_fundamental($id) {

        $sql="select instruments.instrument_code,portfolio_scrips.instrument_id from portfolio_scrips,instruments where portfolio_scrips.instrument_id=instruments.id and portfolio_id=$id and share_status like 'buy' GROUP BY instrument_id ORDER by instrument_code asc";
        $portfolio_holdings=DB::select($sql);

        $instrument_id_arr=collect($portfolio_holdings)->pluck('instrument_id');
        $instrument_id_arr=$instrument_id_arr->implode(" ,");
        $sql="SELECT
    details,
    instrument_id,
    post_date
FROM
(
    SELECT
        details,
        instrument_id,
        post_date,
        @rn := IF(@prev = instrument_id, @rn + 1, 1) AS rn,
        @prev := instrument_id
    FROM news
    JOIN (SELECT @prev := NULL, @rn := 0) AS vars
    WHERE instrument_id in ($instrument_id_arr)
    ORDER BY instrument_id, post_date DESC, details

) AS T1
WHERE rn <= 3";
        $portfolio_holding_news=DB::select($sql);
        $portfolio_holding_news=collect($portfolio_holding_news)->groupBy('instrument_id');



        return view('portfolio.portfolio_fundamental', ['portfolio_holdings' => $portfolio_holdings,'portfolio_holding_news' => $portfolio_holding_news]);
    }


    public function gainLoss($id) {
        $portfolio = Portfolio::find($id);
        $data = [
            'navigation' => [
                'Portfolio',
                $portfolio->portfolio_name,
                'Realized Gain/Loss',
            ],
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'transactions' => $portfolio->portfolio_scrips()->where('share_status', 'sell')->get(),
        ];

        $instrument_info = \App\Instrument::all()->keyBy('id');
        $exchange_info = \App\Exchange::all()->keyBy('id');

        $all_transaction=array();
        $total_profit=0;
        foreach($data['transactions'] as $transaction)
        {
            $temp = array();
            $temp['instrument_code'] = $instrument_info[$transaction->instrument_id]->instrument_code;
            $temp['exchange'] = $exchange_info[$instrument_info[$transaction->instrument_id]->exchange_id]->name;
            $temp['no_of_shares']= $transaction->no_of_shares;
            $temp['buying_price']= $transaction->buying_price;
            $temp['total_buy_commission_of_this_instrument'] = $transaction->commission ? ($transaction->commission / 100) * ($transaction->buying_price * $transaction->no_of_shares) : 0;
            $temp['total_buy_cost_with_commission_of_this_instrument'] = $transaction->buying_price * $transaction->no_of_shares+ $temp['total_buy_commission_of_this_instrument'];
            $temp['buying_date']= $transaction->buying_date->format('M d, y');
            $temp['sell_price']= $transaction->sell_price;
            $temp['total_sell_commission_of_this_instrument'] = $transaction->commission ? ($transaction->commission / 100) * ($transaction->sell_price * $transaction->no_of_shares) : 0;
            $temp['total_sell_cost_deducting_commission_of_this_instrument']= ($transaction->sell_price* $transaction->no_of_shares)- $temp['total_sell_commission_of_this_instrument'];
            $temp['sell_date']= $transaction->sell_date->format('M d, y');
            $temp['profit']= $temp['total_sell_cost_deducting_commission_of_this_instrument']- $temp['total_buy_cost_with_commission_of_this_instrument'];
            $temp['profit']=round($temp['profit'],2);
            $temp['profit_per'] = $temp['total_buy_cost_with_commission_of_this_instrument']?($temp['profit'] / $temp['total_buy_cost_with_commission_of_this_instrument']*100):0;
            $temp['profit_per']=round($temp['profit_per'],2);
            $temp['id']= $transaction->id;
            $total_profit+= $temp['profit'];
            $all_transaction[]=$temp;

        }

        return view('portfolio.gain_loss', ['all_transaction' => $all_transaction,'total_profit' => $total_profit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio) {
        $data = [
            'navigation' => [
                'Portfolio',
                $portfolio->portfolio_name,
                'Edit Portfolio',
            ],
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'instruments' => \App\Repositories\InstrumentRepository::getInstrumentList(),
            'transactions' => $portfolio->portfolio_scrips()->where('share_status', 'buy')->get(),
        ];
        return view('portfolio.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio) {
        \App\PortfolioScrip::where('portfolio_id', $portfolio->id)->delete();
        $portfolio->delete();
    }

    public function uploadForm()
    {
        return view('upload_form');
    }

    public function uploadSubmit(Request $request)
    {

        $portfolio_id= $request->input('portfolio_id');
        $user_id= $request->input('user_id');
        $commission= $request->input('commission');
        $cash_amount= $request->input('cash_amount');
        $portfolio_action= $request->input('portfolio_action');
        $adjust_with_cash= $request->input('adjust_with_cash');


        if (\Auth::user()->id != $user_id)
        {
            session()->flash('portfolio_error', 'You are not authorized to do that');
            return redirect()->back();
        }



        if($request->hasFile('import_file') && $portfolio_id && $user_id){

            $allowed_ext=array('xlsx','csv','xlt');


            $path = $request->import_file->path();
            //$extension = $request->import_file->extension();

            $instrument_list=InstrumentRepository::getInstrumentsScripOnly();
            $instrument_list= $instrument_list->keyBy('instrument_code');

//            Excel::selectSheetsByIndex(0)->load();
            $data = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
            })->get();


            if(!empty($data) && $data->count()){


                if($portfolio_action=='keep_realized_gain_loss')
                {
                    \DB::select("DELETE FROM portfolio_scrips WHERE portfolio_id=$portfolio_id and share_status='buy'" );
                }

                if($portfolio_action=='empty_whole_portfolio')
                {
                    \DB::select("DELETE FROM portfolio_scrips WHERE portfolio_id=". $portfolio_id);
                }




                foreach ($data as $key => $value) {
                    $instrument_code=isset($value['share'])? $value['share']:'';
                    $no_of_shares= isset($value['quantity']) ? $value['quantity'] : 0;
                    $no_of_shares=(int)$no_of_shares;
                    $buying_price= isset($value['price']) ? $value['price'] : 0;
                    $buying_price=floatval($buying_price);

                    if(is_object($value['date']))
                    {
                        $buying_date=  $value['date'];
                    }
                    else{
                        $buying_date=Carbon::parse($value['date']);
                    }

                    $buying_date=$buying_date->format('Y-m-d');

                    if(isset($instrument_list[$instrument_code]))
                    {

                        if($no_of_shares==0)
                            continue;
                        if($buying_price==0)
                            continue;



                        $instrument_id= $instrument_list[$instrument_code]->id;
/*
                        $portfolioTransaction = new \App\PortfolioScrip;
                        $portfolioTransaction->portfolio_id = (int)$portfolio_id;
                        $portfolioTransaction->instrument_id = $instrument_id;
                        $portfolioTransaction->exchange_id = 1; // DSE hardcoded . it should be dynamic later
                        $portfolioTransaction->share_status = 'buy';
                        $portfolioTransaction->no_of_shares = (int)$no_of_shares;
                        $portfolioTransaction->buying_price = floatval($buying_price);
                        $portfolioTransaction->commission = is_null($commission)?0:$commission;
                        dump($buying_date);
                        continue;
                        $portfolioTransaction->buying_date = $buying_date;
$portfolioTransaction->save();
*/


                        \DB::select("INSERT INTO portfolio_scrips (portfolio_id, instrument_id, no_of_shares, buying_price, buying_date,commission)
 VALUES ($portfolio_id,$instrument_id,$no_of_shares,$buying_price,'$buying_date',$commission);");









                        $total_buy_value = $no_of_shares * $buying_price;
                        $buy_commission = ($commission / 100) * $total_buy_value;
                        $total_buy_value_with_commission = $total_buy_value + $buy_commission;
                        $adjusted_cash_amount = $cash_amount - $total_buy_value_with_commission;  // deducting  amount from portfolio

                        if($adjust_with_cash=='on')
                        \DB::select("update portfolios set cash_amount=$adjusted_cash_amount where id=". $portfolio_id);

                    }



                }


                session()->flash('portfolio_error', 'Your portfolio import is successful');
                return redirect()->back();

            }
        }else
        {
            session()->flash('portfolio_error', 'Please attach the portfolio');
            return redirect()->back();
        }
    }

    public function portfolio_export($portfolio_id)
    {

        $data=\DB::select("select instrument_id,no_of_shares,buying_price,DATE_FORMAT(buying_date,'%c/%e/%Y') as buying_date from portfolio_scrips where share_status like 'buy' and portfolio_id=$portfolio_id ORDER BY instrument_id ");
        $instrument_list=InstrumentRepository::getInstrumentsScripOnly();
        $instrument_list=$instrument_list->keyBy('id');

        $portfolio_info=\DB::select("select portfolio_name,user_id from portfolios where id=$portfolio_id");
        $portfolio_name=$portfolio_info[0]->portfolio_name;
        $user_id=$portfolio_info[0]->user_id;


        if (\Auth::user()->id != $user_id)
        {
            session()->flash('portfolio_error', 'You are not authorized to do that');
            return redirect()->back();
        }



        $csvdata=array();
        foreach($data as $row)
        {
            $temp=array();
            $temp['share']=$instrument_list[$row->instrument_id]->instrument_code;
            $temp['quantity']=$row->no_of_shares;
            $temp['price']=$row->buying_price;
            $temp['date']=$row->buying_date;
            $temp['exchange']='DSE';

            $csvdata[]=$temp;

        }

     //  dd($csvdata);

        $data=\DB::select("select instrument_id,no_of_shares,buying_price,DATE_FORMAT(buying_date,'%m/%d/%Y') as buying_date ,sell_price,DATE_FORMAT(sell_date,'%m/%d/%Y') as sell_date from portfolio_scrips where share_status like 'sell' and portfolio_id=$portfolio_id ORDER  BY sell_date asc,instrument_id asc");
        $instrument_list=InstrumentRepository::getInstrumentsScripOnly();
        $instrument_list=$instrument_list->keyBy('id');


        $csvdata_sold=array();
        foreach($data as $row)
        {
            $temp=array();
            $temp['share']=$instrument_list[$row->instrument_id]->instrument_code;
            $temp['quantity']=$row->no_of_shares;
            $temp['buy price']=$row->buying_price;
            $temp['buy date']=$row->buying_date;
            $temp['exchange']='DSE';
            $temp['sell price']=$row->sell_price;
            $temp['sell date']=$row->sell_date;


            $csvdata_sold[]=$temp;

        }



        return Excel::create($portfolio_name, function($excel) use ($csvdata,$csvdata_sold) {
            $excel->sheet('holdings', function($sheet) use ($csvdata)
            {
                $sheet->fromArray($csvdata);
            });

            // Our first sheet
            $excel->sheet('Realized GainLoss', function($sheet) use ($csvdata_sold) {
                $sheet->fromArray($csvdata_sold);
            });



        })->download('xls');
    }

    public function portfolio_setting(Request $request)
    {
        $portfolio_id= $request->input('portfolio_id');
        $setting_name= $request->input('setting_name');
        $setting_value= $request->input('setting_value');

        $portfolio_info=\DB::select("select portfolio_name,user_id from portfolios where id=$portfolio_id");
        $user_id=$portfolio_info[0]->user_id;
        $portfolio_name=$portfolio_info[0]->portfolio_name;

        if (\Auth::user()->id != $user_id)
        {
            return response()->json("You are not authorize to do that. Check your login") ;
        }else
        {
            \DB::select("update portfolios set $setting_name=$setting_value where id=$portfolio_id");
            return response()->json("Email alert has been set as $setting_value for $portfolio_name") ;
        }
        $msg = "This is a simple message.";

        return json_encode($portfolio_id);

    }


}
