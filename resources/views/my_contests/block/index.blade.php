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
                        @forelse ($contests as $contest)
                            <tr>
                                <td>
                                    <a href="{{ route('mycontests.show', $contest) }}">
                                        {{ $contest->name }}
                                        <span class="badge badge-primary">
                                            {{ $contest->approved_contest_users_count }}
                                        </span>

                                        <span class="badge badge-danger">
                                            {{ $contest->for_approval_contest_users_count }}
                                        </span>
                                    </a>
                                </td>
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

                                    @if ($contest->is_active)
                                        <form method="POST" action="{{ route('mycontests.block', $contest) }}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <button class="btn btn-danger btn-xs" 
                                                    data-toggle="confirmation" 
                                                    data-original-title="Are you sure ?" 
                                                    title="">
                                                    <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Block
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('mycontests.unblock', $contest) }}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <button class="btn btn-primary btn-xs" 
                                                    data-toggle="confirmation" 
                                                    data-original-title="Are you sure ?" 
                                                    title="">
                                                    <span class="md-click-circle md-click-animate" style="height: 184px; width: 184px;"></span>Unblock
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="no-records-found text-center">
                                <td colspan="7">No matching records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>