<?php

namespace App\Http\ViewComposers;

use App\Repositories\MyContestRepository;
use Illuminate\View\View;

class MyContests
{
	/**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $contests = MyContestRepository::myContestData();

        $view->with('contests', $contests);
    }
}
