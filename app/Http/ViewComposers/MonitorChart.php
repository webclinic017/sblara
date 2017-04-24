<?php
/**
 * Created by Haitham Nabil.
 * Date: 4/22/2017
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\InstrumentRepository;
use App\Repositories\UserRepository;
use Log;
use Auth;
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

        date_default_timezone_set('asia/dhaka');
        $savedUserData = ['symbols'=>array(),'periods' => array()];
        if (!Auth::guest()) {
            $savedUserData = unserialize(UserRepository::getUserInfo(array('market_monitor_settings'),5)[0]->meta_value);
        }
        $view->with('instruments', $instruments)
             ->with('savedUserData', $savedUserData);
    }

}