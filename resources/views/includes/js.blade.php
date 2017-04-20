<!--[if lt IE 9]>
<script src="{{ URL::asset('metronic/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/excanvas.min.js') }}"></script> 
<script src="{{ URL::asset('metronic/assets/global/plugins/ie8.fix.min.js') }}"></script> 
<![endif]-->
      <script src="{{ mix('/metronic_home.js') }}"></script>

        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>

        @stack('scripts')




