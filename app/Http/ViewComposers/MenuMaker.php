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
        $currentPath= Route::currentRouteName();

        foreach($items as $item)
        {
            $found=$item['children']->where('route',$currentPath);
            $selected_node_parent_id=0;
            $selected_node_id=0;
            if(count($found)) {
                $selected_node_parent_id = $found->first()->parent_id;
                $selected_node_id=$found->first()->id;
            }

        }


        $view->with('items', $items)->with('currentPath', $currentPath)->with('selected_node_parent_id', $selected_node_parent_id)->with('selected_node_id', $selected_node_id);




    }


}