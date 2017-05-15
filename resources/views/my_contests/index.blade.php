@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> My Contest</span>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Contest Name</td>
                            <td>Portfolio</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Access</td>
                            <td>Creator Name</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($contests as $contest)
                            <tr>
                                <td>{{ $contest->name }}</td>
                                <td>{{ $contest->start_date }}</td>
                                <td>{{ $contest->end_date }}</td>
                                <td>{{ $contest->contest_amount }} ({{ $contest->max_amount }}%)</td>
                                <td>
                                    @if ($contest->access_level)
                                        <span class="text-danger">Private</span>
                                    @else
                                        <span class="text-success">Public</span>
                                    @endif
                                </td>
                                <td>Own</td>
                                <td>
                                    <a href="{{ route('contests.edit', $contest) }}" class="btn btn-primary btn-xs">Edit</a>

                                    <button class="btn btn-danger btn-xs" 
                                            data-toggle="confirmation" 
                                            data-original-title="Are you sure ?" 
                                            title="">
                                            <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Block
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
