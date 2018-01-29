<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\SectorListRepository;
use App\Repositories\SectorIntradayRepository;

class CategoryPE
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
        $viewdata= $view->getData();

        $render_to='category_pe';
        $height=300;

        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }
        if(isset($viewdata['height']))
        {
            $height=$viewdata['height'];
        }


        //$sector_pe_data=SectorListRepository::getSectorPE([$sector_list_id]);
        $category_pe_data=SectorListRepository::getCategoryPE();

        $category=array();
        $bar=array();

foreach($category_pe_data['category_pe_arr'] as $cat=>$data)
{

    $category[] = $cat;
    $bar[]=round($data['pe'],2);
}



        //dump($category);
        $view->with('category', collect($category)->toJson())
            ->with('render_to', $render_to)
            ->with('height', $height)
            ->with('category_pe_data', $category_pe_data['category_pe_arr'])
            ->with('bar',collect($bar)->toJson(JSON_NUMERIC_CHECK));

    }


}