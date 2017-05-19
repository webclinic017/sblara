<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ContestPortfolioSharesView
{
    /**
     * Bind data to the index view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$viewData      = $view->getData();
    	$transaction   = $viewData['portfolio'];
    	// dd($viewData);
    }
}
