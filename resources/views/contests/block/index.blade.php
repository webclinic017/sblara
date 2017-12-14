<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> List of Contest</span>
                </div>
            </div>

            <div class="portlet-body">
                <div class="caption font-green-haze" style="width: 100%; text-align: center;">
                 <span class="caption-subject bold uppercase"> Contest of the Month</span>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Contest Name</td>
                            <td>Contest Amount</td>
                            <td>Max TK/Share</td>
                            <td>Access</td>
                            <td>Join</td>
                        </tr>
                    </thead>           
                    <tbody>
                        <tr>    
                        <td>                                    
                            <a href="{{ route('contests.show', $contestOfMonth) }}">
                                        {{ $contestOfMonth->name }} 
                                        <span class="badge badge-primary">
                                            {{ $contestOfMonth->approved_contest_users_count }}
                                        </span>
                                    </a>
                        </td>
                        <td>{{ $contestOfMonth->contest_amount }}</td>
                        <td> {{ $contestOfMonth->max_amount }}%</td>
                        <td>
                                    @if ($contestOfMonth->access_level)
                                        <span class="text-danger">Private</span>
                                    @else
                                        <span class="text-success">Public</span>
                                    @endif                            
                        </td>
                        <td>
                                    <form method="POST" action="{{ route('contests.join', $contestOfMonth) }}">
                                        {{ csrf_field() }}

                                        <button class="btn btn-primary btn-xs"  {{ $contestOfMonth->isJoined() ? 'disabled' : '' }}
                                                data-toggle="confirmation" 
                                                data-original-title="Are you sure ?" 
                                                title="">
                                                <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Join
                                        </button>
                                    </form>                            
                        </td>
                        </tr>
 
                    </tbody>         
                </table>
                <hr>
                <div class="col-md-12" style="text-align: right; margin-bottom: 20px;">
{{--                     <a href="" class="btn btn-primary">All Contest</a>
                    <a href="" class="btn btn-primary">General Contest</a> --}}
                    <a href="/contests?type=new" class="btn btn-primary">New Contests</a>
                    <a href="/mycontests/create" class="btn btn-primary">Create Contest</a>
                </div>
              <div class="caption font-green-haze" style="width: 100%; text-align: center; margin-top: 30px;">
                 <span class="caption-subject bold uppercase"> Popular Contests</span>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Amount (Max/Share)</td>
                            <td>Access</td>
                            <td>Creator Name</td>
                            <td></td>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($contests as $contest)
                            <tr>
                                <td>
                                    <a href="{{ route('contests.show', $contest) }}">
                                        {{ $contest->name }} 
                                        <span class="badge badge-primary">
                                            {{ $contest->approved_contest_users_count }}
                                        </span>
                                    </a>
                                </td>
                                <td>{{ $contest->start_date->format('d-M-Y') }}</td>
                                <td>{{ $contest->end_date->format('d-M-Y') }}</td>
                                <td>{{ $contest->contest_amount }} ({{ $contest->max_amount }}%)</td>
                                <td>
                                    @if ($contest->access_level)
                                        <span class="text-danger">Private</span>
                                    @else
                                        <span class="text-success">Public</span>
                                    @endif
                                </td>
                                <td>{{ $contest->creator->name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('contests.join', $contest) }}">
                                        {{ csrf_field() }}

                                        <button class="btn btn-primary btn-xs"  {{ $contest->isJoined() ? 'disabled' : '' }}
                                                data-toggle="confirmation" 
                                                data-original-title="Are you sure ?" 
                                                title="">
                                                <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Join
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="no-records-found text-center">
                                <td colspan="7">No matching records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $contests->links() }}
            </div>
        </div>
    </div>
</div>