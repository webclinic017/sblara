<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Navigation;
use Illuminate\Support\Facades\Route;

class MenuMaker
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
        $items = Navigation::tree();

        $currentPath= Route::getFacadeRoot()->current()->uri();

        $view->with('items', $items)->with('currentPath', $currentPath);

       /* $view->with('ohlc', collect($ohlc)->toJson(JSON_NUMERIC_CHECK))
            ->with('volume', collect($volume)->toJson(JSON_NUMERIC_CHECK))
            ->with('instrument_code', $instrument_code)
            ->with('news_flags', json_encode($news_flags))
            ->with('news_flags2', json_encode($news_flags2))
            ->with('height', $height)
            ->with('renderTo', 'news_chart_div');*/


    }


}