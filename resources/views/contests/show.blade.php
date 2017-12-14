@extends('layouts.metronic.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> 
                        <span class="text-primary">{{ $contest->name }}</span> Details
                    </span>
                </div>
            </div>

            <div class="portlet-body">
                 <div class="caption font-green-haze" style="width: 100%; text-align: center;">
                     <span class="caption-subject bold uppercase"> Boss of <span class="text-primary">{{ $contest->name }}</span></span>
                </div>
                                     <div class="col-md-8 col-md-offset-2" style="margin-bottom: 20px;">
                   @foreach($top3 as $user)
                        <div class="col-md-4">
                            <h4 class="text-center"> {{strtoupper($user->name)}}</h4>
                            <img class="img-responsive" src="{{$user->avatar}}" alt="User Image">
                        </div>
                  @endforeach
 
                     </div>
                                     <div class="col-md-12" style="text-align: right; margin-bottom: 20px;">
{{--                     <a href="" class="btn btn-primary">All Contest</a>
                    <a href="" class="btn btn-primary">General Contest</a> --}}
                    <a href="/mycontests/create" class="btn btn-primary">Create Contest</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="6">
                                <span class="caption-subject bold uppercase"> 
                                    Top ({{ $contest->contestUsers->count() }}) Performers from the start of 
                                    <span class="text-primary">{{ $contest->name }}</span>
                                </span>
                            </th>
                        </tr>

                        <tr class="text-center">
                            <th class="text-center">Rank</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Join Date</th>
                            <th class="text-center">Growth %</th>
                            {{-- <th class="text-center">Shares Holding</th> --}}
                            <th class="text-center">Portfolio</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $rank = 1;
                        @endphp
                        @forelse ($users as $user)
                            <tr class="text-center">
                                <td>{{ $rank++ }}</td>
                                <td>
                                    @if (auth()->check() AND $user->user_id === auth()->user()->id)
                                        <a href="{{ route('contests.portfolios.show', $user->id) }}">{{ $user->name }}</a>
                                    @else
                                        {{ $user->name }}
                                    @endif
                                </td>
                                <td>{{ date('d-M-Y', strtotime($user->join_date)) }}</td>
                                @php
                                $growth = number_format((($user->portfolio_value - $contest->contest_amount) * 100) / $contest->contest_amount , 2)
                                @endphp
                                <td style="color: {{$growth < 0?"red":"green"}}">{{ $growth  }}</td>
                                 
                                <td>{{ $user->portfolio_value }}</td>
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
