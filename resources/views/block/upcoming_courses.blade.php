@php
 $batches = \App\CourseParticipants::getActiveCourse();
@endphp
<style>
    .courseTicker a{
        text-decoration:none;
    }
</style>
<div class="courseTicker">
    <div style="width:100%">
@foreach($batches as $batch)

<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th colspan="2">
                <strong>                                          
                    <a href="/batches/{{$batch->id}}" target="_blank" title="Show details">
                        {{$batch->course_name}} 
                    </a>
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
                <td > {{$batch->batch_name}} </td>
                
            </tr>
            <tr>
                <td class="highlight">
                    <div class="success"></div>
                    <a href="javascript:;"> Duration: </a>
                </td>
                <td > {{$batch->course_duration}} </td>
                
            </tr>
            <tr>
                <td class="highlight">
                    <div class="success"></div>
                    <a href="javascript:;"> Course Date: </a>
                </td>
                <td > {{\Carbon\Carbon::parse($batch->c_start_date)->format('d M Y')}} </td>
                
            </tr>
            <tr>
                <td class="highlight">
                    <div class="success"></div>
                    <a href="javascript:;"> Class Time: </a>
                </td>
                <td > {{$batch->c_start_time}} - {{$batch->c_end_time}} </td>
                
            </tr>
            <tr>
                <td class="highlight">
                    <div class="success"></div>
                    <a href="javascript:;"> Fees: </a>
                </td>
                <td > {{$batch->course_fees}}/-Tk </td>
                
            </tr>
        </tbody>
    </table>
    @endforeach        
    
</div>
</div>


<script>
    $('.courseTicker').easyTicker({
        interval: 4000,
        height:350
});
</script>