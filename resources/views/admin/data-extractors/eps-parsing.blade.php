@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        <div class="col-md-12">
            <a href="/admin/data-extractors/share-percentage-dse-import" target="_blank" class="btn btn-success">Update DSE Data</a>
            <a href="?update=sb" onclick="return confirm('Are you sure?')" class="btn btn-warning">Update SB Data</a>
        </div>
          {{-- content start  --}}


          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
