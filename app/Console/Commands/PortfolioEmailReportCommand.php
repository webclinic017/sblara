<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Market;
use Illuminate\Support\Facades\Mail;
use App\Mail\PortfolioReportMarkdown;
use App\Jobs\SendPortfolioEmail;

class PortfolioEmailReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:PortfolioEmailReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending daily email report of their portfolio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */



// live server command   /opt/cpanel/ea-php70/root/usr/bin/php /home/hostingmonitors/artisan mail:PortfolioEmailReport
// ******this need to run following command as background process once. REMEMBER !!! If server restarted it need to run again*****
// nohup php artisan queue:work --daemon > /dev/null 2>&1&
// this should be run from sblara . last run process id from  sblara : 57831 and sbdev: 41998
    public function handle()
    {


        $trade_date=date('Y-m-d');

        if($activeTradeDates=Market::validateTradeDate($trade_date))
        {

/*
            $sql="SELECT portfolios.id,users.email FROM portfolios,users
WHERE portfolios.user_id=users.id and portfolios.email_alert=true and users.email like 'afmsohail@gmail.com'";*/

    $sql="SELECT portfolios.id,users.email FROM portfolios,users
WHERE portfolios.user_id=users.id and portfolios.email_alert=true";

            $portfolio_id_list=\DB::select($sql);


            $i=1;
            foreach($portfolio_id_list as $row)
            {
                // direct mailing
                 Mail::to($row->email)->send(new PortfolioReportMarkdown($row->id));

                // using queue
                /*SendPortfolioEmail::dispatch($row)
                    ->delay(now()->addseconds($i));*/

           $i+=5; // email send to queue every in every 5 sec
            }

            $total= count($portfolio_id_list);
            $this->info(" Total $total portfolio report emailed successfully");

        }
        else
        {
            // Its not returning today data. We will just send a message in console
            $this->info('Today is not Trading day. So no portfolio report has been sent');
        }

    }
}
