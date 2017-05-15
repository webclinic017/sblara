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
                        @foreach ($contests as $contest)
                            <tr>
                                <td>
                                    <a href="{{ route('contests.show', $contest) }}">{{ $contest->name }}</a>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>