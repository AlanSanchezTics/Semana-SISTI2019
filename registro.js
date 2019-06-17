$(document).ready(function () {
    loadFoto();
    guardarData();
    $(".form-line").removeClass("focused");
    $("#NoControl").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});
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
var guardarData = function () {
    $('form').on('submit', function (e) {
        e.preventDefault();
        var $btn = $("form button[type='submit']").button('loading');
        $.ajax({
            type: "POST",
            url: "./Alumnos/data.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                val_respuesta(response);
                $btn.button('reset');
            }
        });
    });
};
var val_respuesta = function (res) {
    switch (res) {
        case 'ADDED':
            swal({
                title: "Alumno registrado con exito",
                type: "success"
            }, function () {
                $('#modal-form').modal('hide');
                $(".card").hide();
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