$(function () {
    $('#tblAlumnos').DataTable();
    showGrupo();
});
var showGrupo = function () {
    $('#grupos').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var select = $("#grupos").val();
        if (select == "empty") { return; }
        $(".load").waitMe({
            effect: 'timer',
            text: 'Buscando alumnos',
            bg: '#FFF'
        });
        listar(select);
    });
}
var listar = function (grupo) {
    var tabla = $('#tblAlumnos').DataTable({
        responsive: true,
        "oLanguage": langSpa,
        bAutoWidth: false,
        destroy: true,
        ajax: {
            "method": "POST",
            url: "data.php",
            data: { "opcion": "GETGRUPO", "id": grupo },
        },
        "columns": [
            { "data": "nocontrol" },
            { "data": "nombre" },
            { "data": "genero" },
            { "data": "telefono" },
            { "data": "correo" },
            { "data": "talleres" },
            {
                "defaultContent": `<button data-toggle="tooltip" data-placement="top" title="Agregar taller" type="button" class="btn btn-circle bg-green waves-effect taller"><i class="material-icons">library_add</i></button><script>
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
    setTimeout(function () { $(".waitMe").fadeOut(); }, 1000);
    fnButtons(tabla, "#tblAlumnos tbody");
}
var fnButtons = function (table, tbody) {
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
            if (inputValue === "" || inputValue < 0) {
                swal.showInputError("El numero de talleres debe ser numerico o mayor a 0"); return false;
            } else if (inputValue != false) {
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
                            var select = $("#grupos").val();
                            listar(select);
                        } else {
                            console.log(response);
                            swal("Ups!", "hubo un error en el proceso. Contacta al administrador.", "error");
                        }
                    }
                });
            }
        });
    });
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