<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use App\Instrument;
use App\Repositories\InstrumentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PortfolioSharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ContestPortfolio $portfolio)
    {
        $portfolio->load('contest', 'shares');

        $company_info   = null;
        $purchase_power = null;
        $max_shares     = null;

        $instruments=InstrumentRepository::getInstrumentsScripOnly();
        $instruments=$instruments->pluck('instrument_code', 'id')->prepend('Select a company', '');


        if ($id = request()->company_info) {
            $company_info = Instrument::with('latestDataBanksEod')->find($id);
            $buying_price = $company_info->latestDataBanksEod->close;

            if ($portfolio->shares) {
                $sum_shares     = $portfolio->shares->sum('no_of_shares');
                $total_shares   = $sum_shares * $buying_price;

                $purchase_power = $portfolio->contest->contest_amount * $portfolio->contest->max_amount / 100;
                $purchase_power -= $total_shares;

                $max_shares     = $purchase_power / $buying_price;
            } else {
                $purchase_power = $portfolio->cash_amount * $portfolio->contest->max_amount / 100;
                $max_shares     = $purchase_power / $buying_price;
            }
        }

        return view('contest_portfolio_shares.create', [
            'portfolio'      => $portfolio,
            'instruments'    => $instruments,
            'company_info'   => $company_info,
            'purchase_power' => $purchase_power,
            'max_shares'     => $max_shares
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContestPortfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ContestPortfolio $portfolio)
    {

        $this->validate($request, [
            'buy_quantity' => 'required|numeric|min:1'
        ]);

        $portfolio->load('contest');
        try {
            $id           = $request->instrument_id;
            $buy_quantity = $request->buy_quantity;

            $company_info = Instrument::with('latestDataBanksEod')->find($id);

            $purchase_power     = $portfolio->cash_amount * $portfolio->contest->max_amount / 100;
            $max_shares_can_buy = $purchase_power / $company_info->latestDataBanksEod->close;
            $buying_price       = $company_info->latestDataBanksEod->close;


            if($request->type == 'sell')
            {
                $sellPrice = $buying_price;
                $qty = $request->buy_quantity;  
                $shares = $portfolio->shares()->where('instrument_id', $id)->get();
                $availableQty = 0;
                foreach ($shares as $share)
                {
                    $availableQty += $share->availableQty;
                }
                 if ($request->buy_quantity > $availableQty || $request->buy_quantity < 1) {

                    flash('You are not allowed to sell this amount of shares', 'error');
                    return back();
                }
                foreach ($shares as $share) {

   
                    if($qty < 1)
                    {
                        break;
                    }
                    if(!$share->isMature && !$share->availableQty < 1 )
                    {
                        continue;
                    }
                    if($share->availableQty > $qty )
                    {
                        $share->sell_quantity = $share->sell_quantity +  $qty;
                        $qty -= $qty;
                    }else{
                        $rem = $share->availableQty;
                        $share->sell_quantity = $share->sell_quantity +  $rem;
                        $qty -= $rem;
                    }
                    $share->sell_price = $sellPrice;
                    $share->sell_date = Carbon::now();
                    $share->save();

                }
 
                                    /*comisssion */
                    $commision = 0.5;
                    $total_sell_cost = $request->buy_quantity * $sellPrice;
                    $sell_commision = $commision * $total_sell_cost / 100;
                    $total_sell_cost_diducting_commission=$total_sell_cost - $sell_commision ;
        
                    $portfolio->cash_amount = $portfolio->cash_amount + $total_sell_cost_diducting_commission;
                    $portfolio->save();                 
                    /*comisssion */
                      flash('Share successfully sold', 'success');
                    return back();
            }


            if ($buy_quantity > $max_shares_can_buy) {
                flash('You are not allowed to purchase this amount of shares', 'error');
                return back();
            } else {
                $portfolio->portfolioShares()->attach($company_info->id, [
                    'no_of_shares' => $buy_quantity,
                    'buying_price' => $buying_price,
                    'buying_date'  => Carbon::now()
                ]);

                $commission                     = 0.5;
                $total_buy_cost                 = $buy_quantity * $buying_price;
                $buy_commission                 = $commission * $total_buy_cost / 100;
                $total_buy_cost_with_commission = $total_buy_cost += $buy_commission;
                $portfolio->cash_amount         = $portfolio->cash_amount -= $total_buy_cost_with_commission;
                $portfolio->save();

                flash('Share successfully purchased', 'success');
                return redirect()->route('contests.portfolios.show', $portfolio);
            }
        } catch (Exception $e) {
            // return $e->message;    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
