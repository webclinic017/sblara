<?php

namespace App\Listeners;

use App\Events\PortfolioItemModified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Portfolio;

class AdjustPortfolioCash
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PortfolioItemModified  $event
     * @return void
     */
    public function handle(PortfolioItemModified $event)
    {
        dd($event->transaction);
        $portfolio = Portfolio::find($event->transaction->portfolio_id);
        if($event->transaction->transaction_type_id==1) //buy
        {
            $total_commission=(($event->transaction->commission)/100)*($event->transaction->shares * $event->transaction->rate);
            $portfolio->portfolio_cash = $portfolio->portfolio_cash - ($event->transaction->shares * $event->transaction->rate);
            $portfolio->portfolio_cash = $portfolio->portfolio_cash - $total_commission;
        }

        if($event->transaction->transaction_type_id==2) //sell
        {
            $total_commission=(($event->transaction->commission)/100)*($event->transaction->shares * $event->transaction->rate);
            $portfolio->portfolio_cash = $portfolio->portfolio_cash + ($event->transaction->shares * $event->transaction->rate);
            $portfolio->portfolio_cash = $portfolio->portfolio_cash - $total_commission;
        }

        $portfolio->save();

    }
}
