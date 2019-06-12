<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISTI 2019 | Acceso</title>
    <!-- Favicon-->
    <link rel="icon" href="./favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="./plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="./plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="./plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="./plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="./build/css/style.css" rel="stylesheet">
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
                    <div class="msg">Inicio de sesión</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="clave" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-sisti waves-effect" type="submit">Entrar</button>
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

    <!-- Waves Effect Plugin Js -->
    <script src="./plugins/node-waves/waves.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="./plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Validation Plugin Js -->
    <script src="./plugins/jquery-validation/jquery.validate.js"></script>
    <script src="./plugins/jquery-validation/localization/messages_es.js"></script>

    <!-- Custom Js -->
    <script src="./build/js/admin.js"></script>
    <script src="login.js"></script>
</body>

</html>