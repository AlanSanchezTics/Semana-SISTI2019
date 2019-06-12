<?php
function registrarAlumno($nombre,$apaterno ,$amaterno ,$email ,$telefono,$genero ,$nocontrol,$carrera,$grupo,$periodo,$turno,$foto){
    include '../database.php';
    $imagen = "user-default.png";
    if($foto['name']!=""){
        $nombreFoto = $nocontrol;
        $tipoarchivo=$foto['type'];
        $rest = substr($tipoarchivo,6);                            
        $ruta="images/".$nombreFoto.".".$rest;
        $imagen = $nombreFoto.".".$rest;
    }
    $sql = "SELECT * FROM tbl_alumnos WHERE nocontrol = {$nocontrol}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0 ){
        die("EXIST");
    }
    $sql = "INSERT INTO tbl_alumnos(`nocontrol`, `alunombre`, `aluapaterno`, `aluamaterno`, `idcarrera`, `tel`, `turno`, `correo`, `notalleres`, `imagen`, `alugenero`, `existe`) VALUES({$nocontrol}, '{$nombre}', '{$apaterno}', '{$amaterno}', {$carrera}, '{$telefono}', '{$turno}', '{$email}', 0, '{$imagen}', '{$genero}', 1)";
    if(mysqli_query($conn, $sql) == TRUE){
        if($foto["name"]!="")    
            move_uploaded_file($foto['tmp_name'],$ruta);

        $sql = "INSERT INTO `tbl_asig_grupo_alumn`(`nocontrol`, `idgrupo`, `idperiodo`, `asigexiste`) VALUES ({$nocontrol},{$grupo},{$periodo},1)";
        if(mysqli_query($conn, $sql) == TRUE){
            $sql = "INSERT INTO `tbl_usuarios`(`usuario`, `clave`, `tipo`, `existe`) VALUES ({$nocontrol},{$nocontrol},1,1)";
            if(mysqli_query($conn, $sql) == TRUE){
                die("ADDED");
            }
        }
    }
    die(mysqli_error($conn));
}
function editarAlumno($nombre,$apaterno ,$amaterno ,$email ,$telefono,$genero ,$nocontrol,$carrera,$grupo,$periodo,$turno,$foto, $imgName){
    include '../database.php';
    $imagen = "user-default.png";
    if($imgName==""){
        if($foto['name']!=""){
            $nombreFoto = $nocontrol;
            $tipoarchivo=$foto['type'];
            $rest = substr($tipoarchivo,6);                            
            $ruta="images/".$nombreFoto.".".$rest;
            $imagen = $nombreFoto.".".$rest;
        }
    }else{
        $imagen = $imgName;
    }

    $sql = "UPDATE tbl_alumnos SET `alunombre`='{$nombre}',`aluapaterno`='{$apaterno}',`aluamaterno`='{$amaterno}',`idcarrera`={$carrera},`tel`='{$telefono}',`turno`='{$turno}',`correo`='{$email}',`imagen`='{$imagen}',`alugenero`='{$genero}' WHERE nocontrol={$nocontrol}";
    if(mysqli_query($conn, $sql) == TRUE){
        $sql = "UPDATE tbl_asig_grupo_alumn SET `nocontrol`={$nocontrol},`idgrupo`={$grupo},`idperiodo`={$periodo} WHERE nocontrol = {$nocontrol}";
        if(mysqli_query($conn, $sql) == TRUE){
            $sql = "UPDATE `tbl_usuarios` SET `usuario`={$nocontrol},`clave`={$nocontrol} WHERE usuario = {$nocontrol}";
            if(mysqli_query($conn, $sql) == TRUE){
                if($foto["name"]!="")    
                    move_uploaded_file($foto['tmp_name'],$ruta);
                    
                die("UPDATED");
            }else{
                die(mysqli_error($conn));
            }
        }else{
            die(mysqli_error($conn));
        }
    }else{
        die(mysqli_error($conn));
    }
}
function eliminarAlumno($nocontrol){
    include '../database.php';
    
    $sql ="UPDATE tbl_alumnos SET existe=0 WHERE nocontrol = {$nocontrol}";
    if(mysqli_query($conn, $sql) === TRUE){
        $sql = "UPDATE tbl_usuarios SET existe = 0 WHERE usuario = '{$nocontrol}'";
        if(mysqli_query($conn, $sql) === TRUE){
            die("DELETED");
        }
    }
    die(mysqli_error($conn));
}
function addTalleres($nocontrol, $notalleres){
    include '../database.php';

    $sql = "SELECT notalleres FROM tbl_alumnos WHERE nocontrol = {$nocontrol}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $notalleres = $notalleres+$row[0];

    $sql = "UPDATE tbl_alumnos SET notalleres = {$notalleres} WHERE nocontrol = {$nocontrol}";
    if(mysqli_query($conn, $sql) === TRUE){
        die('true');
    }else{
        die('false');
    }
}
if (isset($_POST["opcion"])) {
    $opcion = $_POST["opcion"];

    switch ($opcion) {
        case 'TALLERES':
            $nocontrol = $_POST["nocontrol"];
            $notalleres = $_POST["talleres"];
            addTalleres($nocontrol, $notalleres);
            break;
        case 'EDITAR':
            $imgName = $_POST["imgName"];
            $nombre = $_POST["nombre"];
            $apaterno = $_POST["apaterno"];
            $amaterno = $_POST["amaterno"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $genero = $_POST["genero"];
            $nocontrol = $_POST["nocontrol"];
            $carrera = $_POST["carrera"];
            $grupo = $_POST["grupo"];
            $periodo = $_POST["periodo"];
            $turno = $_POST["turno"];
            $foto = $_FILES["imagen"];
            editarAlumno($nombre,$apaterno ,$amaterno ,$email ,$telefono,$genero ,$nocontrol,$carrera,$grupo,$periodo,$turno,$foto,$imgName);
            break;
        case 'ELIMINAR':
            $nocontrol = $_POST["nocontrol"];
            eliminarAlumno($nocontrol);
            break;
        case 'REGISTRAR':
            $nombre = $_POST["nombre"];
            $apaterno = $_POST["apaterno"];
            $amaterno = $_POST["amaterno"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $genero = $_POST["genero"];
            $nocontrol = $_POST["nocontrol"];
            $carrera = $_POST["carrera"];
            $grupo = $_POST["grupo"];
            $periodo = $_POST["periodo"];
            $turno = $_POST["turno"];
            $foto = $_FILES["imagen"];
            registrarAlumno($nombre,$apaterno ,$amaterno ,$email ,$telefono,$genero ,$nocontrol,$carrera,$grupo,$periodo,$turno,$foto);
            break;
    }
}
?>