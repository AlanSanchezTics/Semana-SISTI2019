<!DOCTYPE html>
<?php
    include 'database.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISTI 2019 | Registro a la semana</title>
    <!-- Favicon-->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="./plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="./plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="./plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./plugins/animate-css/animate.css" rel="stylesheet" />

    <!--WaitMe Css-->
    <link href="./plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./build/css/style.css" rel="stylesheet">
    <style>
        .login-page{
            max-width: 750px;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><img src="./images/logo-sisti.png" /></a>
            <small>Semana de Ingenieria en sistemas computacionales y tecnologias de la información - Tec MM, Campus Vallarta</small>
            <hr>
        </div>
        <div class="card">
            <div class="body">
                <form id="login-form" method="POST">
                    <input type="hidden" name="opcion" id="opcion" value="REGISTRAR">
                    <div class="msg">Registro al evento</div>
                    <fieldset class="card">
                        <div class="header">
                            <h2>Información Personal</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                                    <label class="form-label">Nombre</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="apaterno" id="apaterno" required>
                                    <label class="form-label">Apellido Paterno</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="amaterno" id="amaterno" required>
                                    <label class="form-label">Apellido Materno</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" name="email" id="email" class="form-control" required>
                                    <label class="form-label">Correo electronico</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="tel" name="telefono" id="telefono" class="form-control" required>
                                    <label class="form-label">Telefono</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="form-label">Genero</label>
                                    <select class="form-control show-tick" id="genero" name="genero">
                                        <option>Hombre</option>
                                        <option>Mujer</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="card">
                        <div class="header">
                            <h2>Información Escolar</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="nocontrol" id="NoControl" class="form-control" required maxlength="8">
                                    <label class="form-label">No. de Control</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="form-label">Carrera</label>
                                    <select class="form-control show-tick" id="carrera" name="carrera">
                                        <?php
                                                $sql = "SELECT * FROM tbl_carreras";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '
                                                    <option value="'.$row[0].'">'.$row[1].'</option>
                                                    ';
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="form-label">Grupo</label>
                                    <select class="form-control show-tick" id="grupo" name="grupo">
                                        <?php
                                                $sql = "SELECT idgrupo,semestre,nomgrupo,nomcarrera FROM tbl_grupo, tbl_carreras WHERE tbl_grupo.carrera = tbl_carreras.idcarrera AND tbl_grupo.existe = 1";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '
                                                    <option value="'.$row[0].'">'.$row[1].'°'.$row[2].' - '.$row[3].'</option>
                                                    ';
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="form-label">Turno</label>
                                    <select class="form-control show-tick" id="turno" name="turno">
                                        <option value="M">Matutino</option>
                                        <option value="V">Vespertino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="form-label">Periodo</label>
                                    <select class="form-control show-tick" id="periodo" name="periodo">
                                        <?php
                                                $sql = "SELECT * FROM tbl_periodos";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '
                                                    <option value="'.$row[0].'">'.$row[1].'</option>
                                                    ';
                                                }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="card">
                        <div class="header">
                            <h2>Por ultimo</h2>
                        </div>
                        <div class="body">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group imgUp">
                                <input type="hidden" name="imgName">
                                <center>
                                    <div class="imagePreview"><i class="material-icons del">close</i></div>
                                    <label class="btn btn-primary">
                                        Subir Foto<input type="file" name="imagen" class="uploadFile img" value="Upload Photo"
                                            style="width: 0px;height: 0px;overflow: hidden;" accept="image/x-png,image/jpeg">
                                    </label>
                                </center>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-sisti waves-effect" type="submit">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="legal">
            <div class="copyright col-white">
                &copy; 2019 <a href="javascript:void(0);">Tec MM - Campus Vallarta</a>.
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="./plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="./plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="./plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="./plugins/node-waves/waves.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="./plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Validation Plugin Js -->
    <script src="./plugins/jquery-validation/jquery.validate.js"></script>
    <script src="./plugins/jquery-validation/localization/messages_es.js"></script>

    <!-- Wait Me Plugin Js -->
    <script src="./plugins/waitme/waitMe.js"></script>

    <!-- Custom Js -->
    <script src="./build/js/admin.js"></script>
    <script src="registro.js"></script>
</body>

</html>