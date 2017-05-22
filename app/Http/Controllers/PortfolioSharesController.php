<?php

namespace App\Http\Controllers;

use App\ContestPortfolio;
use App\Instrument;
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
        $portfolio->load('contest');

        $instruments = Instrument::where('active', true)
                                 ->pluck('instrument_code', 'id')
                                 ->prepend('Select a company', '');

        if ($id = request()->company_info) {
            $company_info = Instrument::with('data_banks_intraday')->find($id);
        }

        return view('contest_portfolio_shares.create', compact('portfolio', 'instruments', 'company_info'));
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
        $id = $request->instrument_id;

        $company_info = Instrument::with('data_banks_intraday')->find($id);

        $portfolio->portfolioShares()->attach($company_info->id, [
            'amount'           => $request->buy_quantity,
            'rate'             => $company_info->data_banks_intraday->close_price,
            'transaction_time' => Carbon::now(),
            'commission'       => 0.5
        ]);

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
