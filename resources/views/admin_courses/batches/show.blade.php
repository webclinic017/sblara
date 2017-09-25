@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
<div class="row">
  <div class="col-md-12 right">
    <h1 class="font-blue-soft"><strong>Exclusive Training Program on {{ $batch->course->course_name }}</strong></h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12 right">
    <strong>Venue: {{ $batch->venue->venue_address }}</strong>
  </div>
</div>

<div class="row">
  <div class="col-md-8 left-pannel">
    <div class="col-md-12 title">
      {{ !empty($batch->course->course_overview_title)?$batch->course->course_overview_title:'Training Overview' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->course_overview)?$batch->course->course_overview:'' !!}
    </div>
    <div class="col-md-12 title">
      {{ !empty($batch->course->objectives_of_course_title)?$batch->course->objectives_of_course_title:'Objectives of Course' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->objectives_of_course)?$batch->course->objectives_of_course:'' !!}
    </div>
    <div class="col-md-12 title">
      {{ !empty($batch->course->why_sb_title)?$batch->course->why_sb_title:'Why StockBangladesh Ltd' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->why_sb)?$batch->course->why_sb:'' !!}
    </div>
    <div class="col-md-12 title">
      {{ !empty($batch->course->course_benefit_title)?$batch->course->course_benefit_title:'Course Benefit' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->course_benefit)?$batch->course->course_benefit:'' !!}
    </div>

    <!-- Course content -->
    <div class="col-md-12 title">
      {{ !empty($batch->course->course_details_title)?$batch->course->course_details_title:'Course Details' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->course_details)?$batch->course->course_details:'' !!}
    </div>
    <!-- No Smoking -->
    <div class="col-md-12 title">
    </div>
    <div class="col-md-12 content no-smoking">
      Above schedule is subject to change without prior intimations<br>
      <b>NO SMOKING</b> is allowed inside the class<br>
      Please keep your mobile in <b>SILENT MOOD</b>
    </div>
  </div>

  <!-- Right pannel -->
  <div class="col-md-3 right-pannel">
    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Training Details
    </div>
    <div class="col-md-12 content">
      <b>Start Date:</b> {{ $batch->c_start_date }}<br>
      <b>End Date:</b> {{ $batch->c_end_date }}<br>
      <b>Days in Week:</b> {{ $batch->course_days_oftheweek }}<br>
      <b>Duration:</b> {{ $batch->course_duration }}<br>
      <b>Time:</b> {{ $batch->c_start_time }}-{{ $batch->c_end_time }}<br>
      <b>Last Date of Reg.: </b>{{ $batch->c_reg_last_date }}<br>
      <b>Training Fees:</b> BDT {{ $batch->course_fees }} - per Participant<br>
    </div>

    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Facilitator's Profile
    </div>
    <div class="col-md-12 content">
      Team of Expert Researchers from StockBangladesh Ltd.'s Research and Development Department.
    </div>

    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      {{ !empty($batch->course->who_should_attend_title)?$batch->course->who_should_attend_title:'Who Should Attend' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->who_should_attend)?$batch->course->who_should_attend:'' !!}
    </div>


    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Learning Methodologies
    </div>
    <div class="col-md-12 content">
      <ul>
        <li>Presentation</li>
        <li>Facilitator Feedback</li>
        <li>Discussion</li>
        <li>Q & A</li>
        <li>Exercises</li>
      </ul>
    </div>


    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      {{ !empty($batch->course->special_notes_title)?$batch->course->special_notes_title:'Special Notes' }}
    </div>
    <div class="col-md-12 content">
      {!! !empty($batch->course->special_notes)?$batch->course->special_notes:'' !!}
    </div>

    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Registration Process
    </div>
    <div class="col-md-12 content">
      <b>Step 01:</b> For online registration <a href="{{ route('registration.create', $batch->id) }}">Click here</a><br>
      <b>Step 02:</b> Deposit the training fee to Account No. <strong>107-110-9792</strong> at <strong>ANY BRANCH Of of Dutch-Bangla BANK LTD</strong> favoring STOCKBANGLADESH LTD.<br>
      <b>Step 03:</b> email the scanned copy of the Bank deposit slip at training@stockbangladesh.com to ensure your participation.<br>
      <b>Or Visit our office for registration.</b><br>
      Seat will be confirmed after payment. For registration or information please call Hot-Line<br>
      <p aling="center" class="title-left"><b>0192 9912 878</b></p>
      <p aling="center" class="title-left"></b><a href="{{ route('registration.create', $batch->id) }}">Register Online</a></b></p>
    </div>

    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Contact Details
    </div>
    <div class="col-md-12 content">
      <b>StockBangladesh Limited</b><br>
      Dhaka Trade Center (14th floor), <br>
      99 KaziNazrul Islam Avenue, <br>
      Kawran Bazar, <br>
      Dhaka-1215<br>
      Phone: +88 02 8189295-8<br>
      Mobile: 0192 9912 878 <br>
      Email: training@stockbangladesh.com<br>
      Web: www.stockbangladesh.com<br>
    </div>

    <div class="col-md-12 title-left bg-blue-madison bg-font-blue-madison">
      Payment Policies and Procedures:
    </div>
    <div class="col-md-12 content">
      Payment is to be made by last date of registration.
      If you cannot attend any program for which you have paid,
      a notification within no less than 2 business days prior to
      your session’s start is required for courtesy transfer to use
      in any future Training program. If you fail to attend without
      notifying us in writing, in fairness to all attendees, neither
      a refund nor a courtesy transfer will be issued.
    </div>



  </div>


</div>
<div class="row">
  <div class="col-md-4 col-md-offset-5">
    <a href="{{ route('registration.create', $batch->id) }}" class="btn btn-default blue-soft">Register Online</a>
  </div>
</div>



@endsection
@push('scripts')

@endpush
@push('css')
<style>
.left-pannel{
  margin-left: 15px;
  border: 1px solid grey;
}
.title{
  padding-left: 0px;
  margin-top:10px;
  margin-left: 10px;
  margin-bottom: 0px;
  font-weight: bold;
  border-bottom: 1px solid black;
  color: #E87E04;
}
.content{
  font-size:12px;
  margin-top:0px;
  margin-bottom: 10px;
}
.no-smoking{
  text-align: right;
}

.title-left{
  margin-top:10px;
  margin-bottom: 10px;
  font-weight: bold;
  text-align: center;
}

.right {
  text-align: right;
  margin-bottom: 10px;
}
</style>
@endpush
