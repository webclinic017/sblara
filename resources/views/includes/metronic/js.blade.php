<!--[if lt IE 9]>
<script src="{{ asset('metronic/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<script src="{{asset("metronic/assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js")}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 
 <script src="{{ asset('metronic_custom/custom.js?v=1') }}"></script>
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
    <script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}"></script>
<script src="{{ asset('js/se.js') }}?v=1.0.7"></script>
            @stack('scripts')