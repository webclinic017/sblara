@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
@include('admin_courses.menu')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light portlet-fit portlet-datatable bordered">
      <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject font-green sbold uppercase">Create Payment:</span>
          </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          @include('admin_courses.message')
        </div>
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('participant_payment.index', $participant->id)}}">Back</a>
            {{ csrf_field() }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

              <p>{{$participant->p_name}}</p>
              <p>{{$participant->p_phone}}</p>
            <form action="{{route('participant_payment.store')}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" value="{{$participant->id}}" name="course_participant_id">
              <div class="form-group">
                <label for="payment_mr_no">Money Recipit No:</label>
                <input type="text" class="form-control" id="payment_mr_no" name="payment_mr_no" value="{{ old('payment_mr_no') }}">
              </div>
              <div class="form-group">
                <label for="payment_type">Payment Type:</label>
                <input type="text" class="form-control" id="payment_type" name="payment_type" value="{{ old('payment_type') }}">
              </div>
              <div class="form-group">
                <label for="payment_amount">Payment Amount:</label>
                <input type="text" class="form-control" id="payment_amount" name="payment_amount" value="{{ old('payment_amount') }}">
              </div>
              <div class="form-group">
                <label for="payment_due">Payment Due:</label>
                <input type="text" class="form-control" id="payment_due" name="payment_due" value="{{ old('payment_due') }}">
              </div>
              <div class="form-group">
                <label for="payment_vat_chalan_no">Vat Chalan No:</label>
                <input type="text" class="form-control" id="payment_vat_chalan_no" name="payment_vat_chalan_no" value="{{ old('payment_vat_chalan_no') }}">
              </div>
              <button type="submit" class="btn btn-default">Add</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>



@endsection
@push('scripts')

  <script>

  </script>
@endpush
