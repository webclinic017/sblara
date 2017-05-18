<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-badge font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> You Are Competitors of</span>
                </div>
            </div>

            <div class="portlet-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Contest Name</td>
                            <td>Creator</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Access</td>
                            <td>Portfolio</td>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($contests->contestPortfolios as $contest)
                            @if ($contest->creator)
                                <tr>
                                    <td>
                                        <a href="{{ route('contests.show', $contest) }}">
                                            {{ $contest->name }}
                                        </a>
                                    </td>
                                    <td>{{ $contest->creator->name }}</td>
                                    <td>{{ $contest->start_date->format('d-M-Y') }}</td>
                                    <td>{{ $contest->end_date->format('d-M-Y') }}</td>
                                    <td>
                                        @if ($contest->access_level)
                                            <span class="text-danger">Private</span>
                                        @else
                                            <span class="text-success">Public</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-xs">View</a>
                                    </td>
                                </tr>
                            @endif
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