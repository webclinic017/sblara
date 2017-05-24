<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use App\Instrument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $portfolio->load('contest');

        $company_info   = null;
        $purchase_power = null;
        $max_shares     = null;

        $instruments = Instrument::where('active', true)
                                 ->pluck('instrument_code', 'id')
                                 ->prepend('Select a company', '');

        if ($id = request()->company_info) {
            $company_info = Instrument::with('data_banks_intraday')->find($id);

            $purchase_power = $portfolio->cash_amount * $portfolio->contest->max_amount / 100;
            $max_shares     = number_format($purchase_power / $company_info->data_banks_intraday->close_price);
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
        $portfolio->load('contest');

        // if $request->buy_quantity > $max_shares_can_buy
        // $purchase_power     = $portfolio->cash_amount * $portfolio->contest->max_amount / 100;
        // $max_shares_can_buy = number_format($purchase_power / $company_info->data_banks_intraday->close_price);

        try {
            $id           = $request->instrument_id;
            $buy_quantity = $request->buy_quantity;

            $company_info = Instrument::with('data_banks_intraday')->find($id);

            $portfolio->cash_amount -= $buy_quantity;
            $portfolio->save();

            $portfolio->portfolioShares()->attach($company_info->id, [
                'no_of_shares' => $buy_quantity,
                'buying_price' => $company_info->data_banks_intraday->close_price,
                'buying_date'  => Carbon::now(),
            ]);
        } catch (Exception $e) {
            // return $e->message;    
        }

        return redirect()->route('contests.portfolios.show', $portfolio);
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
