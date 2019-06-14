<?php
    if(isset($_POST["usuario"]) && isset($_POST["clave"])){
        include './database.php';

        $user = $_POST['usuario'];
        $clave = $_POST['clave'];

        $sql = "SELECT idusuario, tbl_usutipo.tipo FROM tbl_usuarios, tbl_usutipo WHERE tbl_usuarios.tipo = tbl_usutipo.idtipo AND usuario = '{$user}' AND clave = '{$clave}' AND tbl_usuarios.existe = 1";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            die("SQL ERROR: ". mysqli_error($conn));
        }
        $usuario = mysqli_fetch_array($result);

        switch ($usuario[1]) {
            case 'Docente':
                $sql = "SELECT `nomdoc`, `docapaterno`, `docamaterno`, `sexo` FROM `tbl_docentes` WHERE matricula = {$user}";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    die("SQL ERROR: ". mysqli_error($conn));
                }
                if($row = mysqli_fetch_array($result)){
                    session_name("webSession");
                    session_start();
                    $_SESSION["ID_USUARIO"] = $usuario[0];
                    $_SESSION["MATRICULA"] = $user;
                    $_SESSION["NOMBRE"] = $row[0]." ".$row[1]." ".$row[2];
                    $_SESSION["TIPO"] = $usuario[1];
                    $_SESSION["SEXO"] = $row[3];
                }
                $json = array(
                    'response' =>'DONE',
                    'dashboard' =>$_SESSION['TIPO']
                );
                die(json_encode($json));
                break;
            case 'Administrador':
                $sql = "SELECT `nomadm`, `admapaterno`, `admamaterno` FROM `tbl_admin` WHERE matricula = {$user}";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    die("SQL ERROR: ". mysqli_error($conn));
                }
                if($row = mysqli_fetch_array($result)){
                    session_name("webSession");
                    session_start();
                    $_SESSION["ID_USUARIO"] = $usuario[0];
                    $_SESSION["MATRICULA"] = $user;
                    $_SESSION["NOMBRE"] = $row[0]." ".$row[1]." ".$row[2];
                    $_SESSION["TIPO"] = $usuario[1];
                }
                $json = array(
                    'response' =>'DONE',
                    'dashboard' =>$_SESSION['TIPO']
                );
                die(json_encode($json));
                break;
            case 'Alumno':
                $json = array('response' => 'DENIED');
                die(json_encode($json));
                break;
            default:
                $json = array('response' => 'NOEXIST');
                die(json_encode($json));
                break;
        }
    }
?>