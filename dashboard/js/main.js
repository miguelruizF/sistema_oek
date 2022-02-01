$('#btnNuevo').click(function() {
    $("#addnew").modal('show');
    $("addnew").trigger('reset');
    //id = null;
});

$('.close').click(function() {
    $("#addnew").modal('hide');
});


$("#formTxt").submit(function(e) {
    e.preventDefault();
    //alert("se presiono el boton");
    var formData = new FormData();
    var fileTxt = $("#file")[0].files[0];
    formData.append('file', fileTxt);
    $.ajax({
        url: "bd-personal/import_asistencia.php",
        type: "POST",
        datatype: "json",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            alert("ENVIO EXITOSO");
        }
    });
    //return false;
});