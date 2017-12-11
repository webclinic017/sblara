
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
            <div class="portlet-body">
                @foreach($news as $news)
                <p>
                    <a class="btn default" data-toggle="modal" href="#basic_{{ $news->id }}"> {{ $news->title }} </a>
                </p>
                <hr>
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
                <div class="modal fade" id="basic_{{ $news->id }}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">{{ $news->title }}</h4>
                            </div>
                            <div class="modal-body">
                                <div id="blockui_sample_3_1_element">
                                    <p> {!! $news->details !!} </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline sbold red" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
