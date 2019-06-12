<?php
function registrarDocente($matricula,$nombre,$apaterno,$amaterno,$email,$telefono,$sexo){
    include '../database.php';

    $sql = "SELECT * FROM tbl_docentes WHERE matricula = {$matricula}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        die("EXIST");
    }
    $sql = "INSERT INTO `tbl_docentes`(`matricula`, `nomdoc`, `docapaterno`, `docamaterno`, `correo`, `telefono`, `sexo`, `existe`) VALUES ({$matricula},'{$nombre}','{$apaterno}','{$amaterno}','{$email}','{$telefono}','{$sexo}',1)";
    if(mysqli_query($conn, $sql) == TRUE){
        die("ADDED");
    }
}
function eliminarDocente($matricula){
    include '../database.php';

    $sql = "UPDATE tbl_docentes SET existe = 0 WHERE matricula = {$matricula}";
    if(mysqli_query($conn, $sql) === TRUE){
        die("DELETED");
    }
}
function editarDocente($matricula,$nombre,$apaterno,$amaterno,$email,$telefono,$sexo){
    include '../database.php';

    $sql = "UPDATE `tbl_docentes` SET `nomdoc`='{$nombre}',`docapaterno`='{$apaterno}',`docamaterno`='{$amaterno}',`correo`='{$email}',`telefono`='{$telefono}',`sexo`='{$sexo}' WHERE matricula = '{$matricula}'";
    if(mysqli_query($conn, $sql) === TRUE){
        die("UPDATED");
    }
}
if(isset($_POST["opcion"])){
    $opcion = $_POST["opcion"];

    switch ($opcion) {
        case 'REGISTRAR':
            $matricula = $_POST["matricula"];
            $nombre = $_POST["nombre"];
            $apaterno = $_POST["apaterno"];
            $amaterno = $_POST["amaterno"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $sexo = $_POST["genero"];
            registrarDocente($matricula,$nombre,$apaterno,$amaterno,$email,$telefono,$sexo);
            break;
        case 'ELIMINAR':
            $matricula = $_POST["matricula"];
            eliminarDocente($matricula);
            break;
        case 'EDITAR':
            $matricula = $_POST["matricula"];
            $nombre = $_POST["nombre"];
            $apaterno = $_POST["apaterno"];
            $amaterno = $_POST["amaterno"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $sexo = $_POST["genero"];
            editarDocente($matricula,$nombre,$apaterno,$amaterno,$email,$telefono,$sexo);
            break;
    }
}
?>