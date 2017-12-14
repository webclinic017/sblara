<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

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
            $temp['total_buy_commission_of_this_instrument'] = $transaction->commission ? ($transaction->commission / 100) * ($transaction->buying_price * $transaction->no_of_shares) : 0;
            $temp['total_buy_cost_with_commission_of_this_instrument'] = $transaction->buying_price * $transaction->no_of_shares+ $temp['total_buy_commission_of_this_instrument'];
            $temp['buying_date']= $transaction->buying_date->format('d M, Y');
            $temp['sell_price']= $transaction->sell_price;
            $temp['total_sell_commission_of_this_instrument'] = $transaction->commission ? ($transaction->commission / 100) * ($transaction->sell_price * $transaction->no_of_shares) : 0;
            $temp['total_sell_cost_deducting_commission_of_this_instrument']= ($transaction->sell_price* $transaction->no_of_shares)- $temp['total_sell_commission_of_this_instrument'];
            $temp['sell_date']= $transaction->sell_date->format('d M, Y');
            $temp['profit']= $temp['total_sell_cost_deducting_commission_of_this_instrument']- $temp['total_buy_cost_with_commission_of_this_instrument'];
            $temp['profit_per'] = round($temp['profit']/ $temp['total_buy_cost_with_commission_of_this_instrument']*100,2);
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

}
