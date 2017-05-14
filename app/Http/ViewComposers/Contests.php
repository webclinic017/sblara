<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\ContestRepository;

class Contests
{
	/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $contests = ContestRepository::ContestData();

        $view->with('contests', $contests);
    }
}
