@php
 $batches = \App\CourseParticipants::getActiveCourse();
@endphp
<div class="courseTicker">
    <div>
@foreach($batches as $batch)
        <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="2">
                                                                            <strong>                                          
                                                                                {{$batch->course_name}} 
                                                                            </strong>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr>
                                                                        <td class="highlight">
                                                                            <div class="success"></div>
                                                                            <a href="javascript:;"> Batch: </a>
                                                                        </td>
                                                                        <td class="hidden-xs"> {{$batch->batch_name}} </td>
                                                                       
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="highlight">
                                                                            <div class="success"></div>
                                                                            <a href="javascript:;"> Duration: </a>
                                                                        </td>
                                                                        <td class="hidden-xs"> {{$batch->course_duration}} </td>
                                                                       
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="highlight">
                                                                            <div class="success"></div>
                                                                            <a href="javascript:;"> Course Date: </a>
                                                                        </td>
                                                                        <td class="hidden-xs"> {{\Carbon\Carbon::parse($batch->c_start_date)->format('d M Y')}} </td>
                                                                       
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="highlight">
                                                                            <div class="success"></div>
                                                                            <a href="javascript:;"> Class Time: </a>
                                                                        </td>
                                                                        <td class="hidden-xs"> {{$batch->c_start_time}} - {{$batch->c_end_time}} </td>
                                                                       
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="highlight">
                                                                            <div class="success"></div>
                                                                            <a href="javascript:;"> Fees: </a>
                                                                        </td>
                                                                        <td class="hidden-xs"> {{$batch->course_fees}}/-Tk </td>
                                                                       
                                                                    </tr>
                                                                </tbody>
        </table>
@endforeach        

    </div>
</div>


<script>
    $('.courseTicker').easyTicker({
        height:'230px',
        interval: 4000,
});
</script>