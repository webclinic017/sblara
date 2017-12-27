

<div class="col-md-6">

<div id="courseCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#courseCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#courseCarousel" data-slide-to="1"></li>
    <li data-target="#courseCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{ URL::asset('/course/images/E-65.gif')}}" alt="">
<!--       <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>LA is always so much fun!</p>
      </div> -->
    </div>

    <div class="item">
      <img src="{{ URL::asset('/course/images/R-55.gif')}}" alt="">
<!--       <div class="carousel-caption">
        <h3>Chicago</h3>
        <p>Thank you, Chicago!</p>
      </div> -->
    </div>

    <div class="item">
      <img src="{{ URL::asset('/course/images/E-65.gif')}}" alt="">
<!--       <div class="carousel-caption">
        <h3>New York</h3>
        <p>We love the Big Apple!</p>
      </div> -->
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#courseCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#courseCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    
<!-- BEGIN BORDERED TABLE PORTLET-->
<div class="portlet light portlet-fit bordered">
    <div class="vticker">
                    <ul>
                        
                  @foreach($batches as $batch)
                            <li>
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-red"></i>
            <span class="caption-subject font-red sbold uppercase"><a href="{{ route('batches.show', $batch->id) }}">{{isset($batch->course_name)?$batch->course_name:$batch->course_id}} - {{$batch->batch_name}}</a></span>
        </div>
        <div class="actions">
            <a href="{{ route('registration.create', $batch->id) }}" class="btn dark btn-sm btn-outline sbold uppercase">
                                <i class="fa fa-share"></i> Register Online </a>
            <a href="javascript:;" class="btn dark btn-sm btn-outline sbold uppercase">
                                <i class="fa fa-share"></i> Certificate will be awarded </a>
            <a href="{{ route('batches.show', $batch->id) }}" class="btn dark btn-sm btn-outline sbold uppercase">
                                <i class="fa fa-share"></i> More detail </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <thead>
                    <tr class="uppercase">
                        <th> Course Name  </th>
                        <th> Duration </th>
                        <th> Start Date </th>
                        <th> Class Time </th>
                        <th> Fees </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {{isset($batch->course_name)?$batch->course_name:$batch->course_id}} </td>
                        <td> {{$batch->course_duration}} </td>
                        <td> {{$batch->c_start_date}} </td>
                        <td> {{$batch->c_start_time}} - {{$batch->c_end_time}} </td>
                        <td>  {{$batch->course_fees}} </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
      </li>
                            @endforeach 
                        
                    </ul>
                
</div>
<!-- END BORDERED TABLE PORTLET-->
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
