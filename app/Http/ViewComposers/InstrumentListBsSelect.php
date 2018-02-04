<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\InstrumentRepository;
use App\Repositories\SectorListRepository;

class InstrumentListBsSelect
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
        $instrumentList=InstrumentRepository::getInstrumentsScripWithIndex();
       // dd($instrumentList->toArray());
        $sectorList=SectorListRepository::getSectorList();
        $view->with('instrumentList', $instrumentList)->with('sectorList', $sectorList)->with('bs_select_id',$bs_select_id);
    }
}