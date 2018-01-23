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

        if(\Menu::get('MyNavBar')->active()) {
            $activeMenuText = \Menu::get('MyNavBar')->active()->nickname;
            $activeMenuText = preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $activeMenuText);
            $activeMenuText = ucwords($activeMenuText);
            $activeMenuRoute = \Menu::get('MyNavBar')->active()->link->path['route'];


            $parentMenuText = \Menu::get('MyNavBar')->active()->parent()->nickname;

            $parentMenuText = preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $parentMenuText);
            $parentMenuText = ucwords($parentMenuText);
            // dd(\Menu::get('MyNavBar')->active()->parent());

            $bread = array();

            $temp = array();
            $temp['text'] = $parentMenuText;
            $temp['url'] = '#';
            $bread[] = $temp;


            $temp = array();
            $temp['text'] = $activeMenuText;
            $temp['url'] = $activeMenuRoute;
            $bread[] = $temp;
        }else
        {
            \Menu::get('MyNavBar')->add('Dashboard', ['route' => 'home'])->prepend('<i class="fa fa-dashboard" ></i > ')->active();

            $temp = array();
            $temp['text'] = 'Non-Menu Item';
            $temp['url'] = '/';
            $bread[] = $temp;

            $temp = array();
            $temp['text'] = 'Non-Menu Item';
            $temp['url'] = '/';
            $bread[] = $temp;
        }

        $view->with('bread', $bread);




    }


}