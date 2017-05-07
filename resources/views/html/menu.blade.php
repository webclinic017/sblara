
                         <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                            @foreach($items as $item)
                            @if($item->title==$currentPath)
                            <li class="dropdown dropdown-fw dropdown-fw-disabled active open selected">

                            @else
                                <li class="dropdown dropdown-fw dropdown-fw-disabled  ">
                            @endif
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="icon-home"></i> {{ $item->title }} </a>

                                    <ul class="dropdown-menu dropdown-menu-fw">
                                    @foreach($item['children'] as $child)
                                        <li>
                                            <a href="index.html">
                                                <i class="icon-bar-chart"></i> {{ $child->title }} </a>
                                        </li>
                                       @endforeach

                                    </ul>
                                </li>
                                @endforeach


                            </ul>
                        </div>