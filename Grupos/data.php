<?php
function getAlumnos($id){
    include '../database.php';

    $sql = "SELECT tbl_alumnos.nocontrol, tbl_alumnos.alunombre, tbl_alumnos.aluapaterno, tbl_alumnos.aluamaterno, tbl_alumnos.alugenero, tbl_alumnos.tel, tbl_alumnos.correo, tbl_alumnos.notalleres FROM tbl_alumnos, tbl_asig_grupo_alumn WHERE tbl_asig_grupo_alumn.nocontrol = tbl_alumnos.nocontrol AND tbl_asig_grupo_alumn.idgrupo = {$id} AND tbl_alumnos.existe =1";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die();
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json['data'][]  = array(
            'nocontrol' => $row[0],
            'nombre' => $row[1].' '.$row[2].' '.$row[3],
            'genero' => $row[4],
            'telefono' => $row[5],
            'correo' => $row[6],
            'talleres' =>$row[7]
        );
    }
    echo json_encode($json);
}
function getGrupos(){
    include '../database.php';
    $sql = "SELECT idgrupo,semestre,nomgrupo,nomcarrera FROM tbl_grupo, tbl_carreras WHERE tbl_grupo.carrera = tbl_carreras.idcarrera AND tbl_grupo.existe = 1 ORDER BY tbl_grupo.semestre";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(mysqli_error($conn));
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row[0], 
            'contenido' => $row[1].'°'.$row[2].' - '.$row[3]
        );
    }
    echo json_encode($json);
}
function registrarGrupo($semestre, $grupo, $carrera, $docente){
    include '../database.php';

    $sql = "SELECT * FROM tbl_grupo WHERE nomgrupo = '{$grupo}' AND semestre = {$semestre} AND carrera = {$carrera}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)){
        die("EXIST");
    }
    $sql = "INSERT INTO `tbl_grupo`(`nomgrupo`, `semestre`, `carrera`, `existe`) VALUES ('{$grupo}',{$semestre},{$carrera},1)";
    if(mysqli_query($conn, $sql)===TRUE){
        $sql = "SELECT MAX(idgrupo) FROM tbl_grupo WHERE existe =1";
        $result = mysqli_query($conn, $sql);
        $idGrupo = mysqli_fetch_array($result);
        
        $sql = "INSERT INTO `tbl_asig_grupo_doc`(`iddoc`, `idgrupo`, `idperiodo`, `asigexiste`) VALUES ({$docente},{$idGrupo[0]},1,1)";
        if(mysqli_query($conn, $sql)===TRUE){die("ADDED");}else{die("ERROR");}
    }
    
}
function addTalleres($nocontrol, $notalleres){
    include '../database.php';

    $sql = "SELECT notalleres FROM tbl_alumnos WHERE nocontrol = {$nocontrol}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $notalleres = $notalleres+$row[0];
    $sql = "SELECT monto FROM tbl_pagos WHERE nocontrol = {$nocontrol}";
    $result = mysqli_query($conn, $sql);
    $cantidad = mysqli_fetch_array($result);
    $monto = $notalleres*50;
    $total = $monto+$cantidad[0];
    $sql = "UPDATE tbl_pagos SET monto = {$total} WHERE nocontrol = $nocontrol";
    if(mysqli_query($conn, $sql) === TRUE){
        $sql = "UPDATE tbl_alumnos SET notalleres = {$notalleres} WHERE nocontrol = {$nocontrol}";
        if(mysqli_query($conn, $sql) === TRUE){
            die('true');
        }else{
            die(mysqli_error($conn));
        }
    }
}
function getDatos($id){
    include '../database.php';

    $sql = "SELECT tbl_grupo.idgrupo, tbl_grupo.nomgrupo, tbl_grupo.semestre,tbl_grupo.carrera, tbl_asig_grupo_doc.iddoc  FROM tbl_grupo, tbl_asig_grupo_doc where tbl_asig_grupo_doc.idgrupo= tbl_grupo.idgrupo AND idgrupo = {$id}";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(mysqli_error($conn));
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row[0], 
            'grupo' => $row[1],
            'semestre' => $row[2],
            'carrera' => $row[3],
            'docente' => $row[4]
        );
    }
    echo json_encode($json);
}
function editarGrupo($id, $semestre, $grupo, $carrera, $docente){
    include '../database.php';

    $sql = "SELECT * FROM tbl_grupo WHERE nomgrupo = '{$grupo}' AND semestre = {$semestre} AND carrera = {$carrera} AND idgrupo <> {$id}";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)){
        die("EXIST");
    }
    $sql = "UPDATE `tbl_grupo` SET `nomgrupo`='{$grupo}',`semestre`={$semestre},`carrera`={$carrera} WHERE idgrupo = {$id}";
    if(mysqli_query($conn, $sql) === TRUE){
        $sql = "UPDATE tbl_asig_grupo_doc SET iddoc = {$docente} WHERE idgrupo = {$id}";
        if(mysqli_query($conn, $sql) === TRUE){die("UPDATED");}else{die("ERROR");}
    }
    
}
function eliminarGrupo($id){
    include '../database.php';
    
    $sql = "UPDATE tbl_grupo SET existe = 0 WHERE idgrupo = {$id}";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(mysqli_error($conn));
    }
    die("DELETED");

}
function getDocente($id){
    include '../database.php';

    $sql = "SELECT tbl_docentes.nomdoc, tbl_docentes.docapaterno, tbl_docentes.docamaterno FROM tbl_asig_grupo_doc, tbl_docentes WHERE tbl_asig_grupo_doc.iddoc = tbl_docentes.matricula AND tbl_asig_grupo_doc.idgrupo = {$id}";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(mysqli_error($conn));
    }
    $json = "";
    if($row = mysqli_fetch_array($result)){
        $json = $row[0]." ".$row[1]." ".$row[2];
    }
    echo $json;
}
if (isset($_POST["opcion"])) {
    $opcion = $_POST["opcion"];

    switch ($opcion) {
        case 'GETDOC':
            $id = $_POST["id"];
            getDocente($id);
            break;
        case 'ELIMINAR':
            $id = $_POST["id"];
            eliminarGrupo($id);
            break;
        case 'EDITAR':
            $id = $_POST["id"];
            $semestre = $_POST["semestre"];
            $grupo = $_POST["grupo"];
            $carrera = $_POST["carrera"];
            $docente = $_POST["docente"];
            editarGrupo($id, $semestre, $grupo, $carrera, $docente);
            break;
        case 'GETDATOS':
            $id = $_POST["id"];
            getDatos($id);
            break;
        case 'GETGRUPO':
            $id = $_POST["id"];
            getAlumnos($id);
            break;
        case 'GETGRUPOS':
            getGrupos();
            break;
        case 'REGISTRAR':
            $semestre = $_POST["semestre"];
            $grupo = $_POST["grupo"];
            $carrera = $_POST["carrera"];
            $docente = $_POST["docente"];
            registrarGrupo($semestre, $grupo, $carrera, $docente);
            break;
        case 'TALLERES':
            $nocontrol = $_POST["nocontrol"];
            $notalleres = $_POST["talleres"];
            addTalleres($nocontrol, $notalleres);
            break;
    }
    
}
?>