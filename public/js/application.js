$(function () {
    $(".portfolio-select").val($(".portfolio-select").attr('selecteditem'));
    $(".portfolio-select").change(function () {
        var id = $(this).val();
        window.location = '/portfolio/' + id;
    })
    $(".portfolioActions a").click(function () {
        $(".portfolioActions button").removeClass('active');
        $(this).find('button').addClass('active');
        var loader = '<div class="loader"><img src="/metronic/assets/global/plugins/mapplic/mapplic/images/loader.gif"></div>';
        $(".portfolio-content-area").html(loader);
        $.get(($(this).attr('action')), function (res) {
            $(".portfolio-content-area").html(res);
        })
        return false;
    })
})