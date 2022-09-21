function showAlert(type, message) {
    $('#alert').removeClass().addClass('alert-' + type).html(message).fadeIn();
    document.getElementById("alert").innerHTML = '<i class="fa fa-fw fa-close" style="float: right; margin: 3px 5px;" onclick="closeAlert()"></i>' + message;
    setTimeout("closeAlert()", 4000); // 5 segundos
}

function showAlertModal(type, message, subModal = false, subModalChild = false) {

    if (subModal) {
        $('#alert-modal2').removeClass().addClass('alert-' + type).html(message).fadeIn();
        document.getElementById("alert-modal2").innerHTML = '<i class="fa fa-fw fa-close" style="float: right; margin-right: 5px;" onclick="closeAlertModal()"></i>' + message;
        setTimeout("closeAlertModal(true, false)", 4000);
    } else if (subModalChild) {
        $('#alert-modal3').removeClass().addClass('alert-' + type).html(message).fadeIn();
        document.getElementById("alert-modal3").innerHTML = '<i class="fa fa-fw fa-close" style="float: right; margin-right: 5px;" onclick="closeAlertModal()"></i>' + message;
        setTimeout("closeAlertModal(false, true)", 4000);
    } else {
        $('#alert-modal').removeClass().addClass('alert-' + type).html(message).fadeIn();
        document.getElementById("alert-modal").innerHTML = '<i class="fa fa-fw fa-close" style="float: right; margin-right: 5px;" onclick="closeAlertModal()"></i>' + message;
        setTimeout("closeAlertModal()", 4000); // 5 segundos
    }
}

function closeAlert() {
    $('#alert').fadeOut();
}

function closeAlertModal(subModal = false, subModalChild = false) {
    if (subModal) {
        $('#alert-modal2').fadeOut();
    } else if (subModalChild) {
        $('#alert-modal3').fadeOut();
    } else {
        $('#alert-modal').fadeOut();
    }
}

function closeAlertIndex() {
    $('#alert-index').fadeOut();
}
