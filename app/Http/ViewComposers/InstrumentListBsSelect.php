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
        $instrumentList=InstrumentRepository::getInstrumentsScripOnly();
       // dd($instrumentList->toArray());
        $view->with('instrumentList', $instrumentList)->with('bs_select_id',$bs_select_id);
    }
}