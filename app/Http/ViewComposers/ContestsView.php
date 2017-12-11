<?php

namespace App\Http\ViewComposers;

use App\Repositories\ContestRepository;
use Illuminate\View\View;
use App\Contest;

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
        $contestOfMonth = Contest::withCount('approvedContestUsers')
                    ->where('contest_category', 3)
                    ->where('is_active', true)
                    ->latest('created_at')->first();

        $view->with(compact('contests', 'contestOfMonth'));
    }
}
