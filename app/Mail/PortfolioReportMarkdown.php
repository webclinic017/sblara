<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PortfolioReportMarkdown extends Mailable
{
    use Queueable, SerializesModels;
    private $portfolio_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($portfolio_id)
    {
        $this->portfolio_id=$portfolio_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $market=\App\Market::getActiveDates();
        $market_id=$market[0]->id;
        $trade_date=$market[0]->trade_date->format('d M,Y');
        $portfolio_id=$this->portfolio_id;

        $portfolio_info=\DB::select("select * from portfolios where id=$portfolio_id");
        $portfolio_name=$portfolio_info[0]->portfolio_name;
        $commission=$portfolio_info[0]->broker_fee;
/*
        $sql="select instruments.instrument_code,no_of_shares,buying_price,data_banks_intradays.close_price,
round((data_banks_intradays.close_price-buying_price)/buying_price*100,2) as since_perchase_change,
round((data_banks_intradays.close_price-data_banks_intradays.yday_close_price)/data_banks_intradays.yday_close_price*100,2) as today_change
from portfolio_scrips,instruments,data_banks_intradays
where instruments.id = portfolio_scrips.instrument_id and
instruments.batch_id=data_banks_intradays.batch and instruments.id=data_banks_intradays.instrument_id and
portfolio_id=$porrfolio_id and share_status like 'buy'
ORDER BY instruments.instrument_code ASC";*/


        $sql="select instruments.instrument_code,SUM(no_of_shares) as no_of_shares,SUM(buying_price*no_of_shares) as total_cost, data_banks_intradays.close_price, data_banks_intradays.yday_close_price
from portfolio_scrips,instruments,data_banks_intradays
where instruments.id = portfolio_scrips.instrument_id and
instruments.batch_id=data_banks_intradays.batch and instruments.id=data_banks_intradays.instrument_id and
portfolio_id=$portfolio_id and share_status like 'buy'
GROUP BY portfolio_scrips.instrument_id
ORDER BY instruments.instrument_code ASC";

        $portfolio_shares=\DB::select("$sql");
        $portfolio_holdings=array();
        $total_gain_today=0;
        $total_gain_since_purchased=0;
        foreach($portfolio_shares as $share)
        {
            $row=(array) $share;
            $temp=array();
            $temp=$row;
            $temp['buying_price']=$row['no_of_shares']?round($row['total_cost']/$row['no_of_shares'],2):0;

            $temp['today_change']=round(($temp['close_price']-$temp['yday_close_price'])*$row['no_of_shares'],2);
            $temp['today_change_per']=$temp['yday_close_price']?round(($temp['close_price']-$temp['yday_close_price'])/$temp['yday_close_price']*100,2):0;
            $total_gain_today+=$temp['today_change'];
            $portfolio_holdings[]=(object) $temp;
        }

        //dump($portfolio_holdings);

        $sql="select instruments.instrument_code as instrument_code,details from news,instruments
where
news.instrument_id=instruments.id and
market_id=$market_id
and instrument_id in
(SELECT instrument_id from portfolio_scrips where portfolio_id=$portfolio_id and share_status like 'buy')";

        $news=\DB::select("$sql");

        //dd($news);

        return $this->subject("Portfolio report of $portfolio_name ($trade_date)")->markdown('emails.portfolio.report_markdown')->with([
            'portfolio_name' => $portfolio_name
            ,'total_gain_today' => $total_gain_today
            ,'portfolio_id' => $portfolio_id
            ,'trade_date' => $trade_date
            ,'news' => $news
            ,'portfolio_holdings' => $portfolio_holdings
        ]);
    }
}
