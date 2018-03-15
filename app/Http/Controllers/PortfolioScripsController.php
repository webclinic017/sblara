<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PortfolioScrip;

class PortfolioScripsController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    /*public function destroy($id)
    {
        \App\PortfolioScrip::destroy(1);
        //
    }*/


    public function destroy(PortfolioScrip $portfolioTransaction)
    {

        if ($portfolioTransaction->share_status == 'sell') {

/*
            $total_sell_value = $portfolioTransaction->no_of_shares * $portfolioTransaction->sell_price;
            $cash_amount_to_be_adjusted = $total_sell_value;  // returning that amount to cash_amount

            \DB::select("update portfolios set cash_amount=cash_amount+$cash_amount_to_be_adjusted where id=". $portfolioTransaction->portfolio_id);
            */
            $portfolioTransaction->delete();

        }

    }
}
