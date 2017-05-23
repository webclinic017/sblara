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

class BreadcrumbMaker
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

        $selected_node_parent_id=0;
        $selected_node_id=0;
        $bread=array();


        foreach($items as $item)
        {

            $found=$item['children']->where('name',$currentPath);

            if(count($found)) {
                $temp=array();
                $temp['text']=$item->title;
                $temp['url']='#';
                $bread[]=$temp;


                $temp=array();
                $temp['text']=$found->first()->title;
                $temp['url']=$found->first()->route;
                $bread[]=$temp;


            }

        }
        $view->with('bread', $bread);




    }


}