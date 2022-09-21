var color = '';

function validateErrorMessage(errors, type, message) {

    if(type != null && type == 'warning')
    {
        color = '#db8b0b';
    }

    else if(type != null && type == 'danger')
    {
        color = '#d33724';
    }

    else if(type != null && type == 'orange')
    {
        color = '#ff7701';
    }

    else if(type != null && type == 'success')
    {
        color = '#00a65a';
    }

    else{
        color = '#d33724';
    }

    message.forEach(function (index) {

        //form input
        $("form input[name=" + index + "]").css({
            "border": "solid 1px " + color + "",
            "color": "" + color + ""
        });

        //form label

        $("form label[for=" + index + "]").css({
            "color": "" + color + ""
        });

        //select
        $("form select[name=" + index + "]").css({
            "border": "solid 1px " + color + " ",
            "color": "" + color + ""
        });

        //select two
        $("form select[name=" + index + "]").parent().find('.select2-selection').css({
            "border": "solid 1px " + color + " ",
            "color": "" + color + ""
        });

        if ($("form input[name=" + index + "]").length > 0){

            $("form input[name=" + index + "]").attr('data-toggle', "tooltip");
            $("form input[name=" + index + "]").attr('data-placement', "bottom");
            $("form input[name=" + index + "]").attr('data-original-title', errors[index]);
            $("form input[name=" + index + "]").unbind("focusin");
        }

        if ($("form select[name=" + index + "]")){

            $("form select[name=" + index + "]").attr('data-toggle', "tooltip");
            $("form select[name=" + index + "]").attr('data-placement', "bottom");
            $("form select[name=" + index + "]").attr('data-original-title', errors[index]);
            $("form select[name=" + index + "]").unbind("focusin");
        }

        if ($("form select[name=" + index + "]").parent().find('.select2-selection')){

            $("form select[name=" + index + "]").parent().find('.select2-selection').attr('data-toggle', "tooltip");
            $("form select[name=" + index + "]").parent().find('.select2-selection').attr('data-placement', "bottom");
            $("form select[name=" + index + "]").parent().find('.select2-selection').attr('data-original-title', errors[index]);
            $("form select[name=" + index + "]").parent().find('.select2-selection').unbind("focusin");
        }


        $("form input[name=" + index + "]").focusout(function () {
            $(this).removeAttr("style");
            $(this).removeAttr("data-original-title");
            $(this).tooltip('destroy');
            $(this).unbind("focusin");
            $(this).parent().find("label[for=" + index + "]").removeAttr('style');
        });

        $("form select[name=" + index + "]").parent().find('.select2-selection').focusin(function () {
            $(this).removeAttr("style");
            $(this).parent().parent().parent().parent().find("label[for=" + index + "]").removeAttr("style");
            $(this).removeAttr("data-original-title");
            $(this).tooltip('destroy');
            $(this).unbind("focusin");
        });

        $("form select[name=" + index + "]").focusin(function () {
            $(this).removeAttr("style");
            $(this).parent().find("label[for=" + index + "]").removeAttr("style");
            $(this).removeAttr("data-original-title");
            $(this).tooltip('destroy');
            $(this).unbind("focusin");
        });
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

}

function simpleValidateErrors(name,msg, type) {
    var erros = {};
    erros[name] = [msg];
    var keys = Object.keys(erros);
    validateErrorMessage(erros, keys, type);
}
