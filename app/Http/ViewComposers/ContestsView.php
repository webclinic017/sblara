<?php

namespace App\Http\ViewComposers;

use App\Repositories\ContestRepository;
use Illuminate\View\View;

class ContestsView
{
    /**
     * Bind data to the index view.
     *
     * @param  View  $view
     * @return void
     */
    public function index(View $view)
    {
        // Show all contests.
        $contests = ContestRepository::index();

        $view->with('contests', $contests);
    }
}
