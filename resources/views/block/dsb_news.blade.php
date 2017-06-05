    <div id="myCarousel" class="carousel image-carousel">
        <div class="carousel-inner">

@foreach($allnews as $news)
            <div class=" item">
                <img src="{{$news['thmbnail']}}" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="{{$news['guid']}}">
                            {{$news['post_title']}}</a>
                    </h4>

                    <p>

                           {{$news['post_title']}}

                    </p>
                </div>
            </div>
@endforeach

        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <i class="m-icon-big-swapleft m-icon-white"></i>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <i class="m-icon-big-swapright m-icon-white"></i>
        </a>
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active">
            </li>
            <li data-target="#myCarousel" data-slide-to="1">
            </li>
            <li data-target="#myCarousel" data-slide-to="2">
            </li>
        </ol>
@push('css')

{{--<link href="{{ URL::asset('metronic/assets/global/plugins/cubeportfolio/css/cubeportfolio.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/pages/css/portfolio.min.css') }}" rel="stylesheet" type="text/css" />--}}
@endpush

@push('scripts')
{{--<script src="{{ URL::asset('metronic/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/portfolio-3.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

</script>--}}
@endpush