function notify(type, msg, title, time_out)
{
    //toastr.clear();

    time_out = (time_out == undefined) ? 0 : time_out;

    toastr.options = {
        "closeButton": true,
        "closeHtml": "<i class='glyphicon glyphicon-remove-sign'></i>",
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 300,
        "timeOut": time_out,
        "extendedTimeOut": 0,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr[type](msg, title);
}