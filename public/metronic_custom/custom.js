/**
 * Created by sohail on 5/18/2017.
 */
$('body').on('click', '.portlet > .portlet-title > .tools > a.reload', function(e) {
    e.preventDefault();
    var el = $(this).closest(".portlet").children(".portlet-body");
    var url = $(this).attr("data-url-custom");
    var error = $(this).attr("data-error-display");
    if (url) {
        App.blockUI({
            target: el,
            animate: true,
            overlayColor: 'none'
        });
        $.ajax({
            type: "GET",
            url: url,
            dataType: "html",
            success: function(res) {
                App.unblockUI(el);
                el.html(res);
                App.initAjax() // reinitialize elements & plugins for newly loaded content
            },
            error: function(xhr, ajaxOptions, thrownError) {
                App.unblockUI(el);
                var msg = 'Error on reloading the content. Please check your connection and try again.';
                if (error == "toastr" && toastr) {
                    toastr.error(msg);
                } else if (error == "notific8" && $.notific8) {
                    $.notific8('zindex', 11500);
                    $.notific8(msg, {
                        theme: 'ruby',
                        life: 3000
                    });
                } else {
                    alert(msg);
                }
            }
        });
    } else {
        // for demo purpose
        App.blockUI({
            target: el,
            animate: true,
            overlayColor: 'none'
        });
        window.setTimeout(function() {
            App.unblockUI(el);
        }, 1000);
    }
});
