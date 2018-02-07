<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use App\Repositories\SectorListRepository;
use Illuminate\View\View;
use App\Repositories\InstrumentRepository;

class InstrumentListBsSelectWithSector
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $viewdata= $view->getData();
        $bs_select_id=$viewdata['bs_select_id'];
        /*$sectorList=SectorListRepository::getSectorList();
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex();*/
        $sectorList=SectorListRepository::getSectorList();
        $instrumentList=InstrumentRepository::getInstrumentList();
        unset($instrumentList['custom_index']);
        unset($instrumentList['Treasury Bond']);

        $view->with('instrumentList', $instrumentList)->with('sectorList', $sectorList)->with('bs_select_id',$bs_select_id);
    }
}