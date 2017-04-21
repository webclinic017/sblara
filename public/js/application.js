$(function () {
    $(".portfolio-select").val($(".portfolio-select").attr('selecteditem'));
    $(".portfolio-select").change(function () {
        var id = $(this).val();
        window.location = '/portfolio/' + id;
    })
})