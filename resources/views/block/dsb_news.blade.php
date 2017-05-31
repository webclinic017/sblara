    <div id="myCarousel" class="carousel image-carousel">
        <div class="carousel-inner">

            <div class="active item">
                <img src="<?php echo $allnews[0]['thmbnail'] ?>" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[0]['post_title'] ?> </a>
                    </h4>

                    <p>
                        <?php $post_content = $this->Text->excerpt($allnews[0]['post_content'], 'method', 200, '...');
                        $post_content = strip_tags($post_content);
                        // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo $allnews[1]['thmbnail'] ?>" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[1]['post_title'] ?> </a>
                    </h4>

                    <p>
                        <?php $post_content = $this->Text->excerpt($allnews[1]['post_content'], 'method', 200, '...');
                        $post_content = strip_tags($post_content);
                        // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo $allnews[2]['thmbnail'] ?>" class="img-responsive" alt="">

                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[2]['post_title'] ?> </a>
                    </h4>

                    <p>
                        <?php $post_content = $this->Text->excerpt($allnews[2]['post_content'], 'method', 200, '...');
                        $post_content = strip_tags($post_content);
                        // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>


            <!-- <div class="item">
                <img src="../../assets/admin/pages/media/gallery/image2.jpg" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            Second Thumbnail label </a>
                    </h4>
                    <p>
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="../../assets/admin/pages/media/gallery/image1.jpg" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            Third Thumbnail label </a>
                    </h4>
                    <p>
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    </p>
                </div>
            </div>-->
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

<link href="{{ URL::asset('metronic/assets/global/plugins/cubeportfolio/css/cubeportfolio.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/pages/css/portfolio.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ URL::asset('metronic/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/portfolio-3.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

</script>
@endpush