$(function () {
    $('#login-form').validate({
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
    $("#login-form").on('submit', function (e) {
        e.preventDefault();
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
                        swal("Ups!");
                        break;
                    case 'NOEXIST':
                        swal("Ups!");
                        break;
                    default:

                        break;
                }
            }
        });
    });
});