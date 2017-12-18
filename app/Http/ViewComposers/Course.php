<?php
namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Repositories\DataBanksIntradayRepository;
use App\Repositories\InstrumentRepository;
use App\CourseParticipants;
class Course
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
     
       $batches = CourseParticipants::getActiveCourse();
     
        return $view->with(compact('batches'));
    }
}