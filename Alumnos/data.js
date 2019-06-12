$(function () {
    listar();
    loadFoto();
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
    $('[href="#modal"]').on('click', function () {
        var modal = $(this).attr('data-target');
        limpiar_forms();
        $(modal).modal('show');
    });
    $(".form-line").removeClass("focused");
    $("#NoControl").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    wizardForm();
    guardarData();
});
var listar = function () {
    var tabla = $('#tblAlumnos').DataTable({
        responsive: true,
        "oLanguage": langSpa,
        bAutoWidth: false,
        destroy: true,
        ajax: {
            "method": "POST",
            "url": "getAlumnos.php"
        },
        "columns": [
            { "data": "nocontrol" },
            { "data": "nombre" },
            { "data": "telefono" },
            { "data": "correo" },
            { "data": "carrera" },
            { "data": "semestre" },
            { "data": "grupo" },
            { "data": "turno" },
            { "data": "talleres" },
            {
                "defaultContent": `<button data-toggle="tooltip" data-placement="top" title="Agregar taller" type="button" class="btn btn-circle bg-green waves-effect taller"><i class="material-icons">library_add</i></button> <button data-toggle="tooltip" data-placement="top" title="Editar datos" type="button" class="btn btn-circle bg-orange waves-effect editar"><i class="material-icons">edit</i></button> <button data-toggle="tooltip" data-placement="top" title="Eliminar Alumno" type="button" class="btn btn-circle bg-red waves-effect eliminar"><i class="material-icons">delete</i></button><script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip({
                    container: 'body'
                });
            });
        </script>`, className: "max-buttons-container"
            }
        ]
    });
    $('table').width("100%");
    fnButtons(tabla, "#tblAlumnos tbody");
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
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                uploadFile.closest(".imgUp").find('.imagePreview').css("display", 'inline-block');
                $("i.del").css("display", "block");
                $("input[name='imgName']").val("");
            }
        }
    });
    $(document).on("click", "i.del", function () {
        $(".uploadFile").val("");
        $('.imagePreview').css("background-image", "");
        $("i.del").css("display", "none");
        $("input[name='imgName']").val("");
    });
}
var fnButtons = function (table, tbody) {
    $('button.reset').on('click', function () {
        limpiar_forms();
    });
    $("#modal-form").find('.close').on('click', function () {
        limpiar_forms();
    });
    $(tbody).on('click', 'button.eliminar', function () {
        var row = $(this).closest('tr');
        if (row.hasClass('child')) {
            row = row.prev();
        }
        var data = table.row(row).data();
        swal({
            title: `¿esta seguro de eliminar al alumno?`,
            text: `El cambio realizado al alumno ${data.nombre} ya no se podra revertir!`,
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
                data: { "opcion": "ELIMINAR", "nocontrol": data.nocontrol },
                success: function (response) {
                    val_respuesta(response);
                }
            });
        });
    });
    $(tbody).on('click', 'button.editar', function () {
        var row = $(this).closest('tr');
        if (row.hasClass('child')) {
            row = row.prev();
        }
        var data = table.row(row).data();
        $("#opcion").val("EDITAR");
        $("#nombre").val(data.nombresingle);
        $("#apaterno").val(data.apaterno);
        $("#amaterno").val(data.amaterno);
        $("#email").val(data.correo);
        $("#telefono").val(data.telefono);
        $("#genero").val(data.genero);
        $("#NoControl").val(data.nocontrol);
        $("#NoControl").attr("readonly", true);
        $("#carrera").val(data.idcarrera);
        $("#grupo").val(data.idgrupo);
        $("#periodo").val(data.idperiodo);
        $("#turno").val(data.turno);
        $("#formData").find('select.show-tick').selectpicker('render');
        $('#formData').find(".form-line").addClass("focused");
        $("input[name='imgName']").val(data.foto);
        $('.imagePreview').css("background-image", "url(./images/" + data.foto + ")");
        $("i.del").css("display", "block");
        $("#modal-form").modal('show');
    });
    $(tbody).on('click', 'button.taller', function () {
        var row = $(this).closest('tr');
        if (row.hasClass('child')) {
            row = row.prev();
        }
        var data = table.row(row).data();
        swal({
            title: `Asignación de talleres`,
            text: "Asigne la cantidad de talleres que podra tomar el alumno",
            type: "input",
            inputType: "number",
            inputValue: "0",
            confirmButtonText: "Guardar",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            closeOnConfirm: false,
        }, function (inputValue) {
            if (inputValue === "") {
                swal.showInputError("El numero de talleres debe ser numerico"); return false;
            }
            $.ajax({
                type: "POST",
                url: "data.php",
                data: {
                    "opcion": "TALLERES",
                    "nocontrol": data.nocontrol,
                    "talleres": inputValue
                },
                success: function (response) {
                    if (response === 'true') {
                        swal("Talleres asigandos", "se han asignado " + inputValue + " talleres al alumno " + data.nombre, "success");
                        listar();
                    } else {
                        swal("Ups!", "hubo un error en el proceso. Contacta al administrador.", "error");
                    }
                }
            });
        });
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
                console.log(response);
                val_respuesta(response);
                $btn.button('reset');
            }
        });
    });
};
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
function setButtonWavesEffect(event) {
    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
var limpiar_forms = function () {
    $('#formData').trigger('reset');
    $('.form-line').removeClass('focused');
    $('#formData input').removeAttr("aria-invalid");
    $('#opcion').val("REGISTRAR");
    $('.imagePreview').css("background-image", "");
    $("i.del").css("display", "none");
}
var val_respuesta = function (res) {
    switch (res) {
        case 'UPDATED':
            swal({
                title: "Datos del alumno actualizados con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                listar();
            });
            break;
        case 'DELETED':
            swal({
                title: "Alumno eliminado con exito",
                type: "success"
            }, function () {
                listar();
            });
            break;
        case 'ADDED':
            swal({
                title: "Alumno registrado con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                listar();
            });
            break;

        case 'EXIST':
            swal({
                title: "Ups!",
                text: "El Alumno ya se encuentra dado de alta!",
                type: "error"
            }, function () {
                $("#NoControl").focus();
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
};
var langSpa = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sSearchPlaceholder": "Escriba algo aqui",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "sLengthMenu": '<span>Filas por pagina:</span><select class="browser-default">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '</select></div>'
};