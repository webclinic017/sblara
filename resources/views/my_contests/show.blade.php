@extends('layouts.metronic.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> 
                        <a href="{{ route('contests.show', $mycontest) }}">
                            <span class="text-primary">{{ $mycontest->name }}</span>
                        </a>
                         Details
                    </span>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <span class="caption-subject bold uppercase">
                                    <span class="text-primary">{{ $mycontest->name }}</span>
                                    Pending Request Member's List
                                </span>
                            </th>
                        </tr>

                        <tr class="text-center">
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Contest Name</th>
                            <th class="text-center">Request Date</th>
                            <th class="text-center">Creator</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mycontest->forApprovalContestUsers as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ route('contests.show', $mycontest) }}">{{ $mycontest->name }}</a>
                                </td>
                                <td>{{ $user->join_date }}</td>
                                <td>{{ $mycontest->creator->name }}</td>
                                <td>
                                    <span class="label label-danger">Pending..</span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('mycontests.approve.user', [$mycontest, $user]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}

                                        <button class="btn btn-primary btn-xs" {{ $user->pivot->approved ? 'disabled' : '' }}
                                                data-toggle="confirmation" 
                                                data-original-title="Are you sure ?" 
                                                title="">
                                                <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="no-records-found text-center">
                                <td colspan="6">No matching records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <span class="caption-subject bold uppercase">
                                    <span class="text-primary">{{ $mycontest->name }}</span>
                                    Member's List
                                </span>
                            </th>
                        </tr>

                        <tr class="text-center">
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Contest Name</th>
                            <th class="text-center">Request Date</th>
                            <th class="text-center">Creator</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($mycontest->approvedContestUsers as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="{{ route('contests.show', $mycontest) }}">{{ $mycontest->name }}</a>
                                </td>
                                <td>{{ $user->join_date }}</td>
                                <td>{{ $mycontest->creator->name }}</td>
                                <td>
                                    <span class="label label-primary">Approved</span>
                                </td>
                                <td></td>
                            </tr>
                        @empty
                            <tr class="no-records-found text-center">
                                <td colspan="6">No matching records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
