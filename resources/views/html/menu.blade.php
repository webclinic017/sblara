
                         <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                            <ul class="nav navbar-nav">
                            @foreach($items as $item)
                            @if($item->id==$selected_node->parent_id)
                            <li class="dropdown dropdown-fw dropdown-fw-disabled active open selected">

                            @else
                                <li class="dropdown dropdown-fw dropdown-fw-disabled  ">
                            @endif
                                    <a href="javascript:;" class="text-uppercase">
                                        <i class="{{$item->icon}}"></i> {{ $item->title }} </a>

                                    <ul class="dropdown-menu dropdown-menu-fw">
                                    @foreach($item['children'] as $child)
                                         @if($child->id==$selected_node->id)
                                            <li class="active">
                                         @else
                                            <li>
                                         @endif
                                            <a href="{{url($child->route)}}">
                                                <i class="{{$child->icon}}"></i> {{ $child->title }} </a>
                                            </li>
                                       @endforeach

                                    </ul>
                                </li>
                                @endforeach


                            </ul>
                        </div>