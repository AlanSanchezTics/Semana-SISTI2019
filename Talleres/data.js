$(document).ready(function () {
    moment.locale('es');
    getTalleres();
    loadFoto();
    //wizardForm();
    guardarData();
    $('[href="#modal"]').on('click', function () {
        var modal = $(this).attr('data-target');
        limpiar_forms();
        $(modal).modal('show');
    });
    $(".form-line").removeClass("focused");
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - hh:mm a',
        clearButton: true,
        weekStart: 1,
        shortTime: true,
        lang: 'es',
        clearText: "Limpiar",
        okText: "Ok",
        cancelText: "Cancelar"
    }).on('change', function (e, date) {
        $('input[name="fecha"]').val(moment(date).format("YYYY-MM-DD"));
        $('input[name="hora"]').val(moment(date).format("HH:mm:ss"));
    });
});
var getTalleres = function () {
    $("#Talleres").find('.body').find('.row').html("");
    $("#Talleres").waitMe({
        effect: 'timer',
        text: 'Cargando Talleres',
        bg: '#FFF'
    });
    $.ajax({
        type: "POST",
        url: "getTalleres.php",
        success: function (response) {
            var data = JSON.parse(response);
            console.log(data);
            $.map(data, function (element, index) {
                var template = `
                <div class="col-sm-6 col-md-3">
                    <div class="card">
                        <div class="header bg-sisti" style="padding-bottom: 5px;">
                            <h2>${element.nombre}<small>${moment(element.fecha + " " + element.inicio).format("dddd DD MMMM YYYY, hh:mm a")}</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#editar" data-target="${element.id}" class="editar waves-effect waves-block">Editar</a></li>
                                        <li><a href="#eliminar" data-target="${element.id}" class="eliminar waves-effect waves-block">Eliminar</a></li>
                                        <li><a href="#ver" data-target="${element.id}" class=" waves-effect waves-block">Ver
                                                vista detallada </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body" style="padding: 0px;">
                            <div class="thumbnail" style="padding: 0px;">
                                <img src="./images/${element.img}">
                            </div>
                        </div>
                    </div>
                </div>`;
                $("#Talleres").find('.body').find('.row').append(template);

                setTimeout(function () { $("#Talleres").waitMe('hide'); }, 1000);
            });
            $('[href="#eliminar"]').on('click', function () {
                var target = $(this).attr('data-target');
                swal({
                    title: `¿esta seguro de eliminar el taller?`,
                    text: `Los cambios realizados no seran reversibles!`,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: "POST",
                        url: "data.php",
                        data: { "opcion": "ELIMINAR", "id": target },
                        success: function (response) {
                            val_respuesta(response);
                        }
                    });
                });
            });
            $('[href="#editar"]').on('click', function () {
                limpiar_forms();
                var target = $(this).attr('data-target');
                $("#opcion").val("EDITAR");
                $('input[name="id"]').val(target);
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: { "opcion": "GETACTIVIDAD", "id": target },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $.map(data, function (element, key) {
                            $("#nombre").val(element.nombre);
                            $('[name="descripcion"]').val(element.descripcion);
                            $('#ponente').val(element.ponente);
                            $('[name="fecha"]').val(element.fecha);
                            $('[name="hora"]').val(element.inicio);
                            $('.datetimepicker').bootstrapMaterialDatePicker('setDate', moment(element.fecha + " " + element.inicio));
                            $("#lugar").val(element.lugar);
                            $("#cupo").val(element.cupo);
                            $("input[name='imgName']").val(element.img);
                            $('.imgPreview').css("background-image", "url('./images/" + element.img + "')");
                            $('.imgPreview').css("width", '500px');
                            $('.imgPreview').css("height", '300px');
                            $("i.del").css("display", "block");
                        });
                        $("#formData").find('select.show-tick').selectpicker('render');
                        $('#formData').find(".form-line").addClass("focused");
                        $('#modal-form').modal('show');
                        $(".modal-title").html("Datos del Taller");
                    }
                });
            });
            $('[href="#ver"]').on('click', function () {
                var target = $(this).attr('data-target');
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    data: { "opcion": "GETACTIVIDAD", "id": target },
                    success: function (response) {
                        var data = JSON.parse(response);
                        $.map(data, function (value, index) {
                            $("#smallModal").find('.titulo').html(value.nombre);
                            $("#smallModal").find('.baner').attr('src',"./images/"+value.img);
                            $("#smallModal").find('.ponente').html("Ponente: "+value.ponente);
                            $("#smallModal").find('.fecha').html("Fecha: "+moment(value.fecha + " " + value.inicio).format("dddd DD MMMM YYYY, hh:mm a"));
                            $("#smallModal").find('.lugar').html("Lugar: "+value.lugar);
                            $("#smallModal").find('.contenido').html(value.descripcion);
                            $("#smallModal").find('.contenido').css("color","black");
                        });
                        $("#smallModal").modal("show");
                    }
                });
                
            });
        }
    });
}
var guardarData = function () {
    $('#formData').on('submit', function (e) {
        e.preventDefault();
        var $btn = $("#formData button[type='submit']").button('loading');
        $.ajax({
            type: "POST",
            url: "data.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                val_respuesta(response);
                $btn.button('reset');
            }
        });
    });
}
var loadFoto = function () {
    $(document).on("change", ".uploadFile", function () {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        if (files[0].size > 8388608) { alert("El tamaño de la imagen no debe de ser mayor a 7MB."); return; }
        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                uploadFile.closest(".imgUp").find('.imgPreview').css("background-image", "url(" + this.result + ")");
                uploadFile.closest(".imgUp").find('.imgPreview').css("width", '500px');
                uploadFile.closest(".imgUp").find('.imgPreview').css("height", '300px');
                $("i.del").css("display", "block");
                $("input[name='imgName']").val("");
            }
        }
    });
    $(document).on("click", "i.del", function () {
        $(".uploadFile").val("");
        $('.imgPreview').css("background-image", "");
        $('.imgPreview').css("width", '200px');
        $('.imgPreview').css("height", '332px');
        $("i.del").css("display", "none");
        $("input[name='imgName']").val("");
    });
}
var wizardForm = function () {
    var form = $('#formData').show();

    form.validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        rules: {
            'confirm': {
                equalTo: '#password'
            }
        },
    });
}
var limpiar_forms = function () {
    $('#formData').trigger('reset');
    $('.form-line').removeClass('focused');
    $('#formData input').removeAttr("aria-invalid");
    $('#opcion').val("REGISTRAR");
    $(".modal-title").html("Registro de Actividad");
    $('.imgPreview').css("background-image", "");
    $("i.del").css("display", "none");
}
var val_respuesta = function (res) {
    switch (res) {
        case "UPDATED":
            swal({
                title: "Taller actualizado con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                getTalleres();
            });
            break;
        case "ADDED":
            swal({
                title: "Taller registrado con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                getTalleres();
            });
            break;
        case "DELETED":
            swal({
                title: "Taller eliminado con exito",
                type: "success"
            }, function () {
                getTalleres();
            });
            break;

        default:
            swal({
                title: "Ups!",
                text: "Hay un error en servidor, contacte al administrador.",
                type: "error"
            });
            break;
    }
}