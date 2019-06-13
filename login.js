$(function () {
    wizardForm();
});
var wizardForm = function () {
    var form = $('#login-form').show();
    var result = form.validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');

        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');

        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);

        },
        submitHandler: function (form) {
            login(form)
        },
    });
}
var login = function (form) {
    $(".card").waitMe({
        effect: 'timer',
        text: 'Un momento...',
        bg: 'rgba(255,255,255,0.7)',
        color: '#000'
    });
    $.ajax({
        type: "POST",
        url: "acceso.php",
        data: new FormData(form),
        processData: false,
        contentType: false,
        success: function (response) {
            var res = JSON.parse(response);
            switch (res.response) {
                case 'DONE':
                    switch (res.dashboard) {
                        case 'Administrador':
                            window.location.replace("./Alumnos/");
                            break;
                        case 'Docente':
                            window.location.replace("./doc/");
                            break;
                    }
                    break;
                case 'DENIED':
                    swal({
                        title: "Ups!",
                        text: "El usuario no tiene los permisos necesarios para el acceso.",
                        type: "error"
                    });
                    $(".card").waitMe('hide');
                    break;
                case 'NOEXIST':
                    swal({
                        title: "Ups!",
                        text: "El usuario no existe.",
                        type: "error"
                    });
                    $(".card").waitMe('hide');
                    break;
                default:
                    swal({
                        title: "Ups!",
                        text: "Hay un error en servidor, contacte al administrador.",
                        type: "error"
                    });
                    $(".card").waitMe('hide');
                    break;
            }
        }
    });
}