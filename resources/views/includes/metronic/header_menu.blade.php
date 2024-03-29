{{--                         <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                      
                            {!! $MyNavBar->asUl(
                                    ['class' => 'nav navbar-nav'],
                                    ['class'=>'dropdown-menu dropdown-menu-fw']
                                ) !!}
                        </div>

 --}}




                         <!-- BEGIN HEADER MENU -->
                    <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                            	<li class="dropdown dropdown-fw ">
                            		<a class="text-uppercase" href="javascript:;"><i class="icon-home" ></i > Market</a>
                            		<ul class="dropdown-menu dropdown-menu-fw">
                            			<li ><a data-name="home" href="{{url("/")}}"><i class="fa fa-dashboard" ></i > Home</a>
                            	</li>

                            	<li><a  data-name="price-board" href="{{url("/")}}/price-board"><i class="fa fa-tv" ></i > Price Board</a></li>

                            	<li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="fa fa-binoculars" ></i > Screeners</a>
                            		<ul class="dropdown-menu dropdown-menu-fw">
                            			<li><a  data-name="screeners"  href="{{url("/")}}/screeners"><i class="fa fa-binoculars" ></i > Advanced Screeners</a></li>
                            			<li><a  data-name="/dse/stock/candlestick-pattern" href="{{url("/")}}/dse/stock/candlestick-pattern"><i class="fa fa-binoculars" ></i > Candle Pattern</a></li>
                            		</ul>
                            	</li>
                            	<li><a data-name="market-composition" href="{{url("/")}}/market-composition"><i class="fa fa-pie-chart" ></i > Market Composition</a></li><li><a  data-name="market-frame"   href="{{url("/")}}/market-frame"><i class="fa fa-tv" ></i > Market Frame</a>
                            	</li>
                            	<li><a href="{{url("/")}}/monitor"><i class="fa fa-dashboard" ></i > Market Monitor</a></li>
                            	<li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="fa fa-newspaper-o" ></i > Matrix</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/data-matrix"><i class="fa fa-paperclip" ></i > Data Matrix</a></li>
                            		<li><a href="{{url("/")}}/watch-matrix"><i class="fa fa-paperclip" ></i > Watch Matrix</a></li>
                            		<li><a href="{{url("/")}}/price-matrix"><i class="fa fa-paperclip" ></i > Price Matrix</a></li>
                            		<li><a href="{{url("/")}}/dse-price-list"><i class="fa fa-search" ></i > Price List</a></li></ul>
                            	</li>
                            		<li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="fa fa-newspaper-o" ></i > News</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/news/search"><i class="fa fa-search" ></i > News Search</a></li><li><a href="{{url("/")}}/collective/news"><i class="icon-bar-chart" ></i > News from newspaper</a></li><li><a href="{{url("/")}}/dse/stock/dsex/dse-broad-index/chart/news-chart"><i class="icon-bar-chart" ></i > News Chart</a></li></ul>
                            	</li></ul>
                            </li>
                            <li class="dropdown dropdown-fw  "><a class="text-uppercase" href="javascript:;"><i class="icon-link" ></i > Sector</a><ul class="dropdown-menu dropdown-menu-fw">
                            	<li>
                            		<a href="{{url("/")}}/sector-minute-chart"><i class="fa fa-tv" ></i > Sector Movement</a>
                            	</li>

                            		<li><a href="{{url("/")}}/sector-pe"><i class="fa fa-tv" ></i > Sector P/E</a></li>
                            		<li><a href="{{url("/")}}/category-pe"><i class="fa fa-tv" ></i > Category P/E</a></li>
                            	</ul>
                            </li>

                            		<li class="dropdown dropdown-fw  "><a class="text-uppercase" href="javascript:;"><i class="icon-link" ></i > Company</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/dse/stock/abbank/ab-bank-limited/trade/details"><i class="fa fa-dollar" ></i > Trade Details</a></li><li><a href="{{url("/")}}/dse/stock/abbank/ab-bank-limited/fundamental/details"><i class="fa fa-paperclip" ></i > Fundamental Details</a></li><li><a href="{{url("/")}}/dividend-yield-payout-ratio"><i class="fa fa-paperclip" ></i > Dividend Yield</a></li><li><a href="{{url("/")}}/dividend-yield-payout-ratio"><i class="fa fa-paperclip" ></i > Payout Ration</a></li></ul>
                            	</li>
                            		<li class="dropdown dropdown-fw  "><a class="text-uppercase" href="javascript:;"><i class="fa fa-line-chart" ></i > Chart</a><ul class="dropdown-menu dropdown-menu-fw">
                            			<li><a href="{{url("/")}}/dse/stock/dsex/dse-broad-index/chart/technical-analysis"><i class="icon-bar-chart" ></i > TA Chart</a></li>
                            			<li><a href="{{url("/")}}/dse/stock/dsex/dse-broad-index/chart/advance-technical-analysis"><i class="fa fa-line-chart" ></i > Advance TA Chart</a></li>
                            			<li><a href="{{url("/")}}/dse/stock/dsex/dse-broad-index/chart/minute-chart"><i class="fa fa-clock-o" ></i > Minute chart</a></li>
                            			<li><a href="{{url("/")}}/market-depth"><i class="fa fa-gavel" ></i > Market Depth</a></li>
                            		</ul></li>
                            		<li class="dropdown dropdown-fw  "><a class="text-uppercase" href="javascript:;"><i class="icon-briefcase" ></i > Portfolio</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/portfolio"><i class="icon-bar-chart" ></i > Portfolio home</a></li><li><a href="{{url("/")}}/portfolio/create"><i class="icon-bar-chart" ></i > Create new portfolio</a></li></ul></li>
                            		<li class="dropdown dropdown-fw  "><a class="text-uppercase" href="javascript:;"><i class="fa fa-graduation-cap" ></i > Courses</a><ul class="dropdown-menu dropdown-menu-fw">
                            			<li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="icon-bar-chart" ></i > Technical analysis</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/courses/technical-analysis"><i class="icon-bar-chart" ></i > TA Course Home </a></li><li><a href="{{url("/")}}/courses/technical-analysis/basic-technical-analysis"><i class="icon-bar-chart" ></i > Basic TA</a></li><li><a href="{{url("/")}}/courses/technical-analysis/executive-technical-analysis"><i class="icon-bar-chart" ></i > Executive TA</a></li><li><a href="{{url("/")}}/courses/technical-analysis/advance-technical-analysis-course"><i class="icon-bar-chart" ></i > Advance TA</a></li><li><a href="{{url("/")}}/courses/technical-analysis/advance-usage-of-amibroker"><i class="icon-bar-chart" ></i > Advance Usage of Amibroker</a></li><li><a href="{{url("/")}}/courses/technical-analysis/free-technical-analysis-course"><i class="icon-bar-chart" ></i > Free TA Course</a></li></ul></li>

                            			<li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="icon-bar-chart" ></i > Fundamental analysis</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/courses/fundamental-analysis/basic-fundamental-analysis"><i class="icon-bar-chart" ></i > Basic Fundamental </a></li><li><a href="{{url("/")}}/courses/fundamental-analysis/business-and-financial-modeling"><i class="icon-bar-chart" ></i > Financial modeling</a></li><li><a href="{{url("/")}}/courses/fundamental-analysis/risk-management"><i class="icon-bar-chart" ></i > Risk Management</a></li><li><a href="{{url("/")}}/courses/fundamental-analysis/standard-financial-reporting-with-useful-tips"><i class="icon-bar-chart" ></i > Financial reporting</a></li></ul></li>

                            			<li><a href="{{url("/")}}/courses/upcoming-courses"><i class="fa fa-graduation-cap" ></i > Upcoming Courses</a></li>
                            		</ul></li>

                            		<li class="dropdown dropdown-fw  ">
                            			<a class="text-uppercase" href="javascript:;"><i class="fa fa-database" ></i >
                            			 Resources</a><ul class="dropdown-menu dropdown-menu-fw"><li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="fa fa-newspaper-o" ></i > Ipo</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/ipos"><i class="icon-link" ></i > Upcoming IPO</a></li><li><a href="{{url("/")}}/ipos/history"><i class="icon-link" ></i > IPO History</a></li><li><a href="{{url("/")}}/ipos/results"><i class="icon-link" ></i > IPO Results</a></li></ul></li><li class="dropdown more-dropdown-sub closed"><a href="javascript:;"><i class="fa fa-trophy" ></i > Contest</a><ul class="dropdown-menu dropdown-menu-fw"><li><a href="{{url("/")}}/contests"><i class="icon-link" ></i > All Contests</a></li><li><a href="{{url("/")}}/mycontests"><i class="icon-link" ></i > My Contests</a></li></ul></li><li><a href="http://www.new.stockbangladesh.net/users/login"><i class="fa fa-flash" ></i > Online Market Order</a></li><li><a href="///stockbangladesh.com/blog"><i class="fa fa-globe" ></i > SB Blog</a></li><li><a href="{{url("/")}}/tutorials/technical"><i class="fa fa-sun-o" ></i > Knowledge Basket</a></li><li><a href="{{url("/")}}/resources/amibroker-data-plugin-dse"><i class="fa fa-plug" ></i > Amibroker Plugin</a></li><li><a href="{{url("/")}}/download"><i class="fa fa-download" ></i > Data download</a></li></ul></li>
                            	</ul>
                        </div>




