$(function () {
    wizardForm();
    login();
});
var wizardForm = function () {
    var form = $('#login-form').show();
    form.validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
}
var login = function () {
    $("#login-form").on('submit', function (e) {
        e.preventDefault();
        $(".card").waitMe({
            effect: 'timer',
            text: 'Un momento...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000'
        });
        $.ajax({
            type: "POST",
            url: "acceso.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                var res = JSON.parse(response);
                switch (res.response) {
                    case 'DONE':

                        break;
                    case 'DENIED':
                        swal({
                            title: "Ups!",
                            text: "El usuario no tiene los permisos necesarios para el acceso.",
                            type: "error"
                        });
                        break;
                    case 'NOEXIST':
                        swal({
                            title: "Ups!",
                            text: "El usuario no existe.",
                            type: "error"
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
        });
    });
}