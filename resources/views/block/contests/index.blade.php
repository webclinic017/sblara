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
                                <td>{{ $contest->name }}</td>
                                <td>{{ $contest->start_date }}</td>
                                <td>{{ $contest->end_date }}</td>
                                <td>{{ $contest->contest_amount }} ({{ $contest->max_amount }}%)</td>
                                <td>
                                    @if ($contest->access_level)
                                        Private
                                    @else
                                        Public
                                    @endif
                                </td>
                                <td>{{ $contest->creator->name }}</td>
                                <td><a href="" class="btn btn-primary btn-xs">Join</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>