<!--[if lt IE 9]>
<script src="{{ URL::asset('metronic/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<script src="{{ mix('/metronic_home.js') }}"></script>
<script src="/js/application.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

<script>
var ajaxRequest = null;
var ajaxRequestTimeout = null;
$(function () {
    $('.search-result-ajax').slimScroll({
        height: '300px'
    });
    $(".search-result-ajax-top").hide();
    $(".search-result-ajax-top").removeClass('hidden');
    $("#top-search").keyup(function () {
        if ($(this).val().length >= 2)
        {
            var loader = '<div class="loader"><img src="/metronic/assets/global/plugins/mapplic/mapplic/images/loader.gif"></div>';
            $(".search-result-ajax-top").show();
            $(".search-result-ajax .results").html(loader);
            $(".search-result-ajax .asp_group_header").html('');
            var data = $(this).closest('form').serializeArray();
            if (ajaxRequest)
                ajaxRequest.abort();
            if (ajaxRequestTimeout)
            {
                clearTimeout(ajaxRequestTimeout);
                ajaxRequestTimeout = null;
            }
            ajaxRequestTimeout = setTimeout(function () {
                ajaxRequest = $.ajax({
                    url: '/search_json',
                    data: data,
                    method: 'post',
                    success: function (res) {
                        $(".search-result-ajax .asp_group_header").html('Shownig Results : ' + res.count);
                        $(".search-result-ajax .results").html(res.data);
                    },
                    error: function (res) {
                        $(".search-result-ajax .results").html('no record found');
                    }

                });
            }, 2000);
        }
        else
            $(".search-result-ajax-top").hide();
    })
    $(window).click(function () {
        $(".search-result-ajax-top").hide();
    });

    $('.search-result-ajax-top').click(function (event) {
        event.stopPropagation();
    });
});
</script>
@stack('scripts')




