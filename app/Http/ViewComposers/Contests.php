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
        // Show all contests.
        $contests = ContestRepository::index();

        $view->with('contests', $contests);
    }
}
