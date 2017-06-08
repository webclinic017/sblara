    <div id="myCarousel" class="carousel image-carousel">
        <div class="carousel-inner">

            <div class="active item">
                <img src="{{$allnews[0]['thmbnail']}}" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="{{$allnews[0]['guid']}}">
                            {{$allnews[0]['post_title']}} </a>
                    </h4>

                    <p>
                      {!! $allnews[0]['post_content'] !!}
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="{{$allnews[1]['thmbnail']}}" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="{{$allnews[1]['guid']}}">
                            {{$allnews[1]['post_title']}}</a>
                    </h4>

                    <p>

                      {!! $allnews[1]['post_content'] !!}
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="{{$allnews[2]['thmbnail']}}" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="{{$allnews[2]['guid']}}">
                            {{$allnews[2]['post_title']}}</a>
                    </h4>

                    <p>
                         {!! $allnews[2]['post_content'] !!}

                    </p>
                </div>
            </div>

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
    </div>


