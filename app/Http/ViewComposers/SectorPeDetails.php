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

class SectorPeDetails
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

        $render_to='sector_pe';
        $height=700;
        $sector_list_id=12;
        if(isset($viewdata['sector_list_id']))
            $sector_list_id=$viewdata['sector_list_id'];

        if(isset($viewdata['render_to']))
        {
            $render_to=$viewdata['render_to'];
        }
        if(isset($viewdata['height']))
        {
            $height=$viewdata['height'];
        }


        //$sector_pe_data=SectorListRepository::getSectorPE([$sector_list_id]);
        $sector_pe_data=SectorListRepository::getSectorPE();

        $category=array();
        $bar=array();
foreach($sector_pe_data['sector_pe_arr'] as $sector_id=>$data)
{
    $category[]=$data['sector'];
    $bar[]=$data['pe'];
}

        //dump($category);
        $view->with('category', collect($category)->toJson())
            ->with('render_to2', 'sector_details_cap')
            ->with('render_to1', 'sector_details_earnings')
            ->with('height', $height)
            ->with('sector_pe_data', $sector_pe_data)
            ->with('bar',collect($bar)->toJson(JSON_NUMERIC_CHECK));

    }


}