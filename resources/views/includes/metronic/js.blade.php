<!--[if lt IE 9]>
<script src="{{ asset('metronic/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('metronic_custom/custom.js') }}"></script>
<script src="{{ asset('js/application.js') }}"></script>
@include('includes.flash.toastr')
<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>-->
<script>
    $(document).ready(function ()
    {
        $('#clickmewow').click(function ()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
    {{-- <script src="{{ asset('js/filter.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('js/se.js') }}?v={{uniqid()}}"></script>
            @stack('scripts')