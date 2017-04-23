<?php
/**
 * Created by Haitham Nabil.
 * Date: 4/22/2017
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\IndexRepository;
use App\Repositories\InstrumentRepository;
use Log;

class MonitorChart
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository  $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        date_default_timezone_set('UTC');
        $instruments = InstrumentRepository::getInstrumentList();
        
        $view->with('instruments', $instruments);
    }


}