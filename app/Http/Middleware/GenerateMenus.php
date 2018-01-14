<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        \Menu::make('MyNavBar', function ($menu) {


            /*Home*/
            $menu->add('Home', ['class' => 'dropdown dropdown-fw  ']);
            $menu->home->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->home->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-home" ></i > ');

            //submenu
            $menu->home->add('Dashboard', ['route' => 'home'])->prepend('<i class="fa fa-dashboard" ></i > ');
            $menu->home->add('News', ['class' => 'dropdown more-dropdown-sub closed'])->prepend('<i class="fa fa-newspaper-o" ></i > '); //should remove open class
            $menu->news->link->href('javascript:;');
            $menu->news->add('News from newspaper', ['route' => 'collective-news'])->prepend('<i class="icon-bar-chart" ></i > ');
            $menu->home->add('News Search', ['route' => 'news-search'])->prepend('<i class="fa fa-search" ></i > ');
            $menu->home->add('Knowledge Basket', ['route' => 'knowledge-basket'])->prepend('<i class="fa fa-sun-o" ></i > ');

            /*Chart*/
            $menu->add('Chart', ['class' => 'dropdown dropdown-fw  ']);
            $menu->chart->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->chart->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-bar-chart" ></i > ');

            //submenu
            $menu->chart->add('Minute chart', ['route' => 'minute-chart'])->prepend('<i class="fa fa-clock-o" ></i > ')->active('minute-chart/*');

            $menu->chart->add('TA Chart', ['route' => 'ta-chart'])->prepend('<i class="icon-bar-chart" ></i > ');
            $menu->chart->add('Advance TA Chart', ['route' => 'advance-ta-chart'])->prepend('<i class="fa fa-line-chart" ></i > ');

            //Monitor submenu
            $menu->chart->add('Market Monitor', ['route' => 'monitor'])->prepend('<i class="fa fa-dashboard" ></i > ');
            $menu->chart->add('Market Depth', ['route' => 'market-depth'])->prepend('<i class="icon-bar-chart" ></i > ');
            $menu->chart->add('Market Frame', ['route' => 'market-frame'])->prepend('<i class="icon-bar-chart" ></i > ');
            $menu->chart->add('Market Composition', ['route' => 'market-composition'])->prepend('<i class="icon-bar-chart" ></i > ');



            /*Portfolio*/
            $menu->add('Portfolio', ['class' => 'dropdown dropdown-fw  ']);
            $menu->portfolio->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->portfolio->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-briefcase" ></i > ');

            //submenu
            $menu->portfolio->add('Portfolio home', ['route' => 'portfolio.index'])->prepend('<i class="icon-bar-chart" ></i > ')->active('portfolio/*');
            $menu->portfolio->add('Create new portfolio', ['route' => 'portfolio.create'])->prepend('<i class="icon-bar-chart" ></i > ');

            /*Company*/
            // $menu->add('Company', ['class' => 'dropdown dropdown-fw  ']);
            // $menu->company->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            // $menu->company->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-link" ></i > ');

            //submenu

            $menu->home->add('Company Details', ['route' => 'company-details'])->prepend('<i class="fa fa-dollar" ></i > ')->active('company-details/*');
            $menu->home->add('Fundamental Details', ['route' => 'fundamental-details'])->prepend('<i class="fa fa-paperclip" ></i > ')->active('fundamental-details/*');

            /*Sector*/
            $menu->add('Sector', ['class' => 'dropdown dropdown-fw  ']);
            $menu->sector->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->sector->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-link" ></i > ');

            //submenu
          //  $menu->sector->add('Trade Details', ['route' => 'company-details'])->prepend('<i class="icon-bar-chart" ></i > ');
          //  $menu->sector->add('Fundamental Details', ['route' => 'fundamental-details'])->prepend('<i class="icon-bar-chart" ></i > ');

            /*Contest*/
            $menu->add('Contest', ['class' => 'dropdown dropdown-fw  ']);
            $menu->contest->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->contest->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-link" ></i > ');

            //submenu
            $menu->contest->add('All Contests', ['route' => 'contests'])->prepend('<i class="icon-link" ></i > ');
            $menu->contest->add('My Contests', ['route' => 'mycontests'])->prepend('<i class="icon-link" ></i > ');
            

            /*Corse*/
            $menu->add('Course', ['class' => 'dropdown dropdown-fw  ']);
            $menu->course->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->course->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-link" ></i > ');

            //submenu
            $menu->course->add('Upcoming Courses', ['route' => 'courses'])->prepend('<i class="icon-link" ></i > ');
            
            
            /*IPO*/
            $menu->add('Ipo', ['class' => 'dropdown dropdown-fw  ']);
            $menu->ipo->link->href('javascript:;')->attr(['class' => 'text-uppercase']);
            $menu->ipo->attr(['class' => 'dropdown dropdown-fw  '])->prepend('<i class="icon-link" ></i > ');

            //submenu
            $menu->ipo->add('Upcoming IPO', ['route' => 'ipos'])->prepend('<i class="icon-link" ></i > ');
            $menu->ipo->add('IPO History', ['route' => 'ipos-history'])->prepend('<i class="icon-link" ></i > ');
            $menu->ipo->add('IPO Results', ['route' => 'ipos-results'])->prepend('<i class="icon-link" ></i > ');


        });

        return $next($request);
    }
}

/*
 *
 *
 *
 *
 * <li class="dropdown more-dropdown-sub">
                                            <a href="javascript:;">
                                                <i class="icon-docs"></i> Apps </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="app_todo.html">
                                                        <i class="icon-clock"></i> Todo 1 </a>
                                                </li>
                                                <li>
                                                    <a href="app_todo_2.html">
                                                        <i class="icon-check"></i> Todo 2 </a>
                                                </li>
                                                <li>
                                                    <a href="app_inbox.html">
                                                        <i class="icon-envelope"></i> Inbox </a>
                                                </li>
                                                <li>
                                                    <a href="app_calendar.html">
                                                        <i class="icon-calendar"></i> Calendar </a>
                                                </li>
                                                <li>
                                                    <a href="app_ticket.html">
                                                        <i class="icon-notebook"></i> Support </a>
                                                </li>
                                            </ul>
                                        </li>
<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse" >
                            <ul class="nav navbar-nav" >
                                <li class="dropdown dropdown-fw  " >
                                    <a href = "javascript:;" class="text-uppercase" >
                                        <i class="icon-home" ></i > Dashboard </a >
                                    <ul class="dropdown-menu dropdown-menu-fw" >
                                        <li >
                                            <a href = "index.html" >
                                                <i class="icon-bar-chart" ></i > Default </a >
                                        </li >
                                        <li >
                                            <a href = "dashboard_2.html" >
                                                <i class="icon-bulb" ></i > Dashboard 2 </a >
                                        </li >
                                        <li >
                                            <a href = "dashboard_3.html" >
                                                <i class="icon-graph" ></i > Dashboard 3 </a >
                                        </li >
                                    </ul >
                                </li >
                            </ul >
</div >

<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">


<div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
        <li class="dropdown dropdown-fw  " id="home_sohail" data-myname="afm sohail">
        <a href="javascript:;"><i class="icon-home" ></i > Home</a>
            <ul class="dropdown-menu dropdown-menu-fw">
                <li id="dash" class="text-uppercase" data-myname="affm sohail">
                    <a><i class="icon-bar-chart" ></i > Dashboard</a>
                </li>
            </ul>
        </li>
        <li class="dropdown dropdown-fw  " id="About">
            <a href="http://127.0.0.1:8000/market-depth">About</a>
        </li>
        <li class="dropdown dropdown-fw  " id="Services">
            <a href="http://127.0.0.1:8000/market-frame">Services</a>
        </li>
        <li class="dropdown dropdown-fw  " id="Contact">
            <a href="http://127.0.0.1:8000/market-composition">Contact</a>
        </li>
    </ul>
</div>




</div>


*/