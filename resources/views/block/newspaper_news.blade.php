
<div class="row">
    <div class="col-md-6">
        <div class="portlet green-sharp box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-newspaper-o"></i>পত্রিকা হতে সংগৃহীত খবর </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="javascript:;" class="remove"> </a>
                </div>
            </div>
            <div class="portlet-body bolck_news_scroll">
                <div class="vticker">
                    <ul>
                        
                            @foreach($news as $news)
                            <li>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                <div class="pull-left">
                                    <a href="{{ url('/news/details/'.$news->id)}}"><h4>{{ $news->title }}</h4></a>
                                </div>
                                <div class="pull-right">
                                    <h4>{{ $news->published_date }}</h4>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 10px; margin-right: 10px;">
                                <details>
                                    <summary>
                                        @php
                                        // strip tags to avoid breaking any html
                                        $string = strip_tags($news->details);

                                        if (strlen($string) > 500) {

                                        // truncate string
                                        $stringCut = substr($string, 0, 500);

                                        // make sure it ends in a word so assassinate doesn't become ass...
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
                                        }
                                        echo $string;
                                        @endphp
                                    </summary>
                                    <p>{!! $news->details !!}</p>
                                </details>
                                <br><hr>
                            </div>
                                </li>
                            @endforeach 
                        
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        var dd = $('.vticker').easyTicker({
            direction: 'up',
            easing: 'easeInOutBack',
            speed: 'slow',
            interval: 2000,
            height: 'auto',
            visible: 1,
            mousePause: 0,
            controls: {
                up: '.up',
                down: '.down',
                toggle: '.toggle',
                stopText: 'Stop !!!'
            }
        }).data('easyTicker');

        cc = 1;
        $('.aa').click(function () {
            $('.vticker ul').append('<li>' + cc + ' Triangles can be made easily using CSS also without any images. This trick requires only div tags and some</li>');
            cc++;
        });

        $('.vis').click(function () {
            dd.options['visible'] = 3;

        });

        $('.visall').click(function () {
            dd.stop();
            dd.options['visible'] = 0;
            dd.start();
        });

    });

</script>
@endpush
