<!DOCTYPE html>
<html>
<?php
        include '../database.php';
        session_name("webSession");
                    session_start();
        if(!isset($_SESSION["ID_USUARIO"]) || $_SESSION["TIPO"]!="Administrador"){
            session_destroy();
            header("Location: ../");
        }
    ?>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SISTI | Talleres</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/datatables.net-responsive-bs/css/responsive.bootstrap.css">

    <!--JQuery FAB-->
    <link rel="stylesheet" href="../plugins/jquery-fab-button/css/jquery-fab-button.css">

    <!--WaitMe Css-->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />


    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../build/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../build/css/style.css" rel="stylesheet">
</head>

<body class="theme-sisti ls-closed">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-sisti">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Un momento...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#!">Semana de Ing. en sistemas y Tecnologias de la información</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["NOMBRE"]; ?></div>
                    <div class="email"><?php echo $_SESSION["TIPO"]; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="../salir.php"><i class="material-icons">input</i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menu Principal</li>
                    <li>
                        <a href="../Alumnos/">
                            <i class="material-icons col-blue">school</i>
                            <span>Alumnos</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Docentes/">
                            <i class="material-icons col-blue">person</i>
                            <span>Docentes</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Actividades/">
                            <i class="material-icons col-light-blue">person_pin_circle</i>
                            <span>Actividades</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Talleres/">
                            <i class="material-icons col-light-blue">person_pin_circle</i>
                            <span>Talleres</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Grupos/">
                            <i class="material-icons col-light-blue">group</i>
                            <span>Grupos</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">Tec MM - Campus Vallarta</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h3>Talleres Disponibles</h3>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="Talleres">
                        <div class="body">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
    <div class="fixed-action-btn" data-toggle="tooltip" data-placement="left" title="Crear Taller">
        <a class="btn-floating btn-large waves-effect waves-circle waves-float waves-light" href="#modal" data-target="#modal-form">
            <i class="large material-icons">add</i>
        </a>
    </div>
    <!-- Large Size -->
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="formModal">Registro de Taller</h5>
                </div>
                <form id="formData" method="POST" class="">
                    <input type="hidden" name="opcion" id="opcion" value="REGISTRAR">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <fieldset class="card">
                            <div class="body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                                        <label class="form-label">Nombre del taller</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Descripción</label>
                                    <div class="form-line">
                                        <textarea rows="10" class="form-control no-resize" name="descripcion"></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ponente" id="ponente" required>
                                        <label class="form-label">Ponente o Instructor</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fecha y hora del evento</label>
                                    <div class="form-line">
                                        <input type="hidden" name="fecha">
                                        <input type="hidden" name="hora">
                                        <input type="text" class="datetimepicker form-control" placeholder="Seleccione una fecha y hora..." required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="tel" name="lugar" id="lugar" class="form-control" required>
                                        <label class="form-label">Lugar</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="cupo" id="cupo" class="form-control" min="0" max="50" required>
                                        <label class="form-label">Cupo</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="card">
                            <div class="header">
                                <h2>Banner del Taller</h2>
                            </div>
                            <div class="body">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group imgUp">
                                    <input type="hidden" name="imgName">
                                    <center>
                                        <div class="imgPreview"><i class="material-icons del">close</i></div>
                                        <small>Dimenciones de la imagen maximo 900x540</small>
                                        <label class="btn btn-primary">
                                            Subir Foto<input type="file" name="imagen" class="uploadFile img" value="Upload Photo"
                                                style="width: 0px;height: 0px;overflow: hidden;" accept="image/x-png,image/jpeg">
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-green btn-link waves-effect waves-light col-white" data-loading-text="Espere...">Guardar
                            Datos
                        </button>
                        <button type="button" class="btn btn-link waves-effect waves-red reset" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" style="background-color: #113b9e;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="thumbnail">
                                <h3 class="titulo">Desarrollo web</h3>
                                <img class="baner" src="http://placehold.it/500x300">
                                <div class="caption">
                                    <small class="ponente">Ponente: Alan Danchez</small><br>
                                    <small class="fecha">Fecha: 22 de Mayo 2019 - 11:00 am</small><br>
                                    <small class="lugar">Lugar: Laboratorio 6 - Edificio D</small>
                                    <h3>Descripcion</h3>
                                    <p class="contenido">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                        text ever since the 1500s
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>
    <script src="../plugins/jquery-validation/localization/messages_es.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/datatables.net-responsive/js/dataTables.responsive.js"></script>
    <script src="../plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

    <!--JQuery FAB-->
    <script src="../plugins/jquery-fab-button/js/jquery-fab-button.min.js"></script>
    <script src="../plugins/moment/min/moment-with-locales.js"></script>

    <!-- Wait Me Plugin Js -->
    <script src="../plugins/waitme/waitMe.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="../build/js/admin.js"></script>
    <script src="./data.js"></script>
</body>

</html>