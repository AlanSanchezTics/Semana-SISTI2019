$(function () {
    listar();
    wizardForm();
    $('[href="#modal"]').on('click', function () {
        var modal = $(this).attr('data-target');
        limpiar_forms();
        $(modal).modal('show');
    });
    $("#matricula").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    guardarData();
});
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
}
var fnButtons = function (tbody, table) {
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
            title: `¿esta seguro de eliminar al Docente?`,
            text: `El cambio realizado al docente ${data.nombre} ya no se podra revertir!`,
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
                data: { "opcion": "ELIMINAR", "matricula": data.matricula },
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
        console.log(data);
        $("#opcion").val("EDITAR");
        $("#nombre").val(data.nombre);
        $("#apaterno").val(data.apaterno);
        $("#amaterno").val(data.amaterno);
        $("#email").val(data.correo);
        $("#telefono").val(data.telefono);
        $("#genero").val(data.sexo);
        $("#matricula").val(data.matricula);
        $("#matricula").attr("readonly", true);
        $("#formData").find('select.show-tick').selectpicker('render');
        $('#formData').find(".form-line").addClass("focused");
        $("#modal-form").modal('show');
    });
}
var listar = function () {
    var tabla = $("#tblDocentes").DataTable({
        responsive: true,
        "oLanguage": langSpa,
        bAutoWidth: false,
        destroy: true,
        ajax: {
            "method": "POST",
            "url": "getDocentes.php"
        },
        "columns": [
            { 'data': 'matricula', 'className': 'min-buttons-container' },
            { 'data': 'fullName' },
            { 'data': 'correo' },
            { 'data': 'telefono' },
            {
                "defaultContent": `<button data-toggle="tooltip" data-placement="top" title="Editar datos" type="button" class="btn btn-circle bg-orange waves-effect editar"><i class="material-icons">edit</i></button> <button data-toggle="tooltip" data-placement="top" title="Eliminar Docente" type="button" class="btn btn-circle bg-red waves-effect eliminar"><i class="material-icons">delete</i></button><script>
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
    fnButtons("#tblDocentes tbody", tabla);
}
var limpiar_forms = function () {
    $('#formData').trigger('reset');
    $('.form-line').removeClass('focused');
    $('#formData input').removeAttr("aria-invalid");
    $('#opcion').val("REGISTRAR");
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
function setButtonWavesEffect(event) {
    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
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
var val_respuesta = function (res) {
    switch (res) {
        case 'UPDATED':
            swal({
                title: "Datos del docente actualizados con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                listar();
            });
            break;
        case 'DELETED':
            swal({
                title: "Docente eliminado con exito",
                type: "success"
            }, function () {
                listar();
            });
            break;
        case 'ADDED':
            swal({
                title: "Docente registrado con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                listar();
            });
            break;

        case 'EXIST':
            swal({
                title: "Ups!",
                text: "El docente ya se encuentra dado de alta!",
                type: "error"
            }, function () {
                $("#matricula").focus();
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