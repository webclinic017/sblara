<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-directions font-green hide"></i>
                    <span class="caption-subject bold font-dark uppercase "> Activities</span>
                    <span class="caption-helper">Horizontal Timeline</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;"> Action 1</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">Action 2</a>
                            </li>
                            <li>
                                <a href="javascript:;">Action 3</a>
                            </li>
                            <li>
                                <a href="javascript:;">Action 4</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="cd-horizontal-timeline mt-timeline-horizontal" data-spacing="60">
                    <div class="timeline">
                        <div class="events-wrapper">
                            <div class="events">
                                <ol>
                                @foreach($news_flags as $news)
                                    <li>
                                        <a href="#0" data-date="{{$news->post_date->format('d/m/Y')}}" class="border-after-red bg-after-red selected">{{$news->post_date->format('d-m-Y')}}</a>
                                    </li>
                                    @endforeach

                                </ol>
                                <span class="filling-line bg-red" aria-hidden="true"></span>
                            </div>
                            <!-- .events -->
                        </div>
                        <!-- .events-wrapper -->
                        <ul class="cd-timeline-navigation mt-ht-nav-icon">
                            <li>
                                <a href="#0" class="prev inactive btn btn-outline red md-skip">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#0" class="next btn btn-outline red md-skip">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- .cd-timeline-navigation -->
                    </div>
                    <!-- .timeline -->
                    <div class="events-content">
                        <ol>
                         @foreach($news_flags as $news)
                            <li class="selected" data-date="{{$news->post_date->format('d/m/Y')}}">
                                <div class="mt-title">
                                    <h2 class="mt-content-title">{{$news->prefix}}</h2>
                                </div>
                                <div class="mt-author">
                                    <div class="mt-avatar">
                                        <img src="../assets/pages/media/users/avatar80_3.jpg" />
                                    </div>
                                    <div class="mt-author-name">
                                        <a href="javascript:;" class="font-blue-madison">Published</a>
                                    </div>
                                    <div class="mt-author-datetime font-grey-mint">{{$news->post_date->format('d-m-Y h:i')}}</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="mt-content border-grey-steel">
                                    <p>{{$news->details}}</p>
                                    <a
                                        href="javascript:;" class="btn btn-circle red btn-outline">Read More</a>
                                        <a href="javascript:;" class="btn btn-circle btn-icon-only blue">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-circle btn-icon-only green pull-right">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                </div>
                            </li>
                            @endforeach

                        </ol>
                    </div>
                    <!-- .events-content -->
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')
<script type="text/javascript">



</script>
@endpush