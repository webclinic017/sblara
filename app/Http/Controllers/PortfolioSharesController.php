<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use App\Instrument;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PortfolioSharesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
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
        $this->authorize('create', $portfolio);

        $portfolio->load('contest', 'shares');

        $company_info   = null;
        $purchase_power = null;
        $max_shares     = null;

        $instruments = Instrument::where('active', true)
                                 ->pluck('instrument_code', 'id')
                                 ->prepend('Select a company', '');

        if ($id = request()->company_info) {
            $company_info = Instrument::with('data_banks_intraday')->find($id);
            $buying_price = $company_info->data_banks_intraday->close_price;

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
            'max_shares'     => floor($max_shares)
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

        $portfolio->load('contest', 'shares');

        $id           = $request->instrument_id;
        $buy_quantity = $request->buy_quantity;

        $company_info = Instrument::with('data_banks_intraday')->find($id);

        $purchase_power     = $portfolio->cash_amount * $portfolio->contest->max_amount / 100;
        $buying_price       = $company_info->data_banks_intraday->close_price;
        $max_shares_can_buy = floor($purchase_power / $buying_price);

        $noOfShare = $portfolio->shares->sum('no_of_shares');

        if ($noOfShare < $max_shares_can_buy) {
            if ($buy_quantity > $max_shares_can_buy) {
                flash('You are not allowed to purchase this amount of shares', 'error');
            } else {
                $portfolio->portfolioShares()->attach($company_info->id, [
                    'no_of_shares' => $buy_quantity,
                    'buying_price' => $buying_price,
                    'buying_date'  => Carbon::now()
                ]);

                $commission                 = 0.5;
                $totalBuyCost               = $buy_quantity * $buying_price;
                $buyCommission              = $commission * $totalBuyCost / 100;
                $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
                
                $sellCommission = ($commission / 100) * $totalBuyCost;
                $sellValueDeductingCommision = $totalBuyCost - $sellCommission;

                $totalBuyCostWithCommission = $totalBuyCost + $buyCommission;
                $totalGain = $sellValueDeductingCommision - $totalBuyCostWithCommission;

                $portfolio->current_portfolio_value = $portfolio->current_portfolio_value += $totalGain;
                $portfolio->cash_amount = $portfolio->cash_amount -= $totalBuyCostWithCommission;
                $portfolio->save();

                flash('Successfully bought a share', 'success');

                return redirect()->route('contests.portfolios.show', $portfolio);
            }
        } else {
            flash('You are not allowed to purchase this amount of shares', 'error');
        }
        
        return back();
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
