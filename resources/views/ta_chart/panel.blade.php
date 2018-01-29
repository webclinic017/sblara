@extends('layouts.metronic.default')
@section('content')
@push('scripts')
<script>
    $(document).ready(function () {
        setTimeout(function() {   
                $('#shareList').val('10001');
                $('#shareList').trigger('change');
        }, 100);
    });
</script>
@endpush
@endsection



