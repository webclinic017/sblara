<!--[if lt IE 9]>
<script src="{{ URL::asset('metronic/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<script src="{{ mix('/metronic_home.js') }}"></script>
<script src="/js/application.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ URL::asset('metronic_custom/highstock/code/js/highstock.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>




<script src="{{ URL::asset('metronic/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>


<script>
$(document).ready(function ()
{
    $('#clickmewow').click(function ()
    {
        $('#radio1003').attr('checked', 'checked');
    });
})
</script>
<script src="/js/slimscroll.min.js"></script>
<script src="/js/search.js"></script>

@stack('scripts')
