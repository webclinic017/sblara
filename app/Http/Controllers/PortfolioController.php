<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('portfolio.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = [
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
//        dd($request->all());
        if ($portfolioId = $request->portfolioId) {
            $portfolio = Portfolio::find($portfolioId);
            if ($request->old_types) {
                foreach ($request->old_types as $key => $type) {
                    $transactionId = $request->old_transaction_ids[$key];
//                    dd($transactionId);
                    switch ($type) {
                        case 2:
                            $transaction = new \App\PortfolioTransaction;
                            $oldtransaction = \App\PortfolioTransaction::find($transactionId);
                            $transaction->portfolio_id = $oldtransaction->portfolio_id;
                            $transaction->instrument_id = $oldtransaction->instrument_id;
                            $transaction->exchange_id = $oldtransaction->exchange_id;
                            $transaction->transaction_type_id = $type;
                            $transaction->amount = $request->old_price_per_share[$key] * $request->old_shares[$key];
                            $transaction->rate = $request->old_price_per_share[$key];
                            $transaction->transaction_time = $request->old_dates[$key];
                            $transaction->shares = $request->old_shares[$key];
                            $transaction->commission = $request->old_commissions[$key];
                            $transaction->parent_id = $oldtransaction->id;
                            $transaction->save();
                            $oldtransaction->shares-=$transaction->shares;
                            $oldtransaction->amount-=$oldtransaction->shares * $oldtransaction->rate;
                            $oldtransaction->save();
                            break;
                        case 3:
                            $transaction = \App\PortfolioTransaction::find($request->old_transaction_ids[$key]);
                            if ($transaction) {
                                $transaction->amount = $request->old_price_per_share[$key] * $request->old_shares[$key];
                                $transaction->rate = $request->old_price_per_share[$key];
                                $transaction->transaction_time = $request->old_dates[$key];
                                $transaction->shares = $request->old_shares[$key];
                                $transaction->commission = $request->old_commissions[$key];
                                $transaction->save();
                            }
                            break;
                        case 4:
                            \App\PortfolioTransaction::where('id', $transactionId)->delete();
                            break;
                    }
                }
            }
        } else {
            $portfolio = new Portfolio();
            $portfolio->user_id = auth()->id();
        }
        $portfolio->portfolio_name = $request->name;
        $portfolio->save();
        foreach ($request->shares as $key => $share) {
            if ($share) {
                $portfolioTransaction = new \App\PortfolioTransaction;
                $portfolioTransaction->portfolio_id = $portfolio->id;
                $portfolioTransaction->instrument_id = $request->symbols[$key];
                $portfolioTransaction->exchange_id = $request->markets[$key];
                $portfolioTransaction->transaction_type_id = $request->types[$key];
                $portfolioTransaction->amount = $request->price_per_share[$key] * $share;
                $portfolioTransaction->rate = $request->price_per_share[$key];
                $portfolioTransaction->transaction_time = $request->dates[$key];
                $portfolioTransaction->shares = $share;
                $portfolioTransaction->commission = $request->commissions[$key];
                $portfolioTransaction->save();
            }
        }
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
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'transactions' => $portfolio->portfolio_transactions()->where('transaction_type_id', 1)->get(),
        ];
        return view('portfolio.show', $data);
    }

    public function gainLoss($id) {
        $portfolio = Portfolio::find($id);
        $data = [
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'transactions' => $portfolio->portfolio_transactions()->where('transaction_type_id', 2)->get(),
        ];
//        dd($data);
        return view('portfolio.gain_loss', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio) {
        $data = [
            'portfolioId' => $portfolio->id,
            'portfolio' => $portfolio,
            'instruments' => \App\Repositories\InstrumentRepository::getInstrumentList(),
            'transactions' => $portfolio->portfolio_transactions()->where('transaction_type_id', 1)->get(),
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
        //
    }

}
