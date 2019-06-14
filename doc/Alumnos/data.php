<?php
function getAlumnos($id){
    include '../../database.php';

    $sql = "SELECT tbl_alumnos.nocontrol, tbl_alumnos.alunombre, tbl_alumnos.aluapaterno, tbl_alumnos.aluamaterno, tbl_alumnos.alugenero, tbl_alumnos.tel, tbl_alumnos.correo, tbl_alumnos.notalleres FROM tbl_alumnos, tbl_asig_grupo_alumn WHERE tbl_asig_grupo_alumn.nocontrol = tbl_alumnos.nocontrol AND tbl_asig_grupo_alumn.idgrupo = {$id} AND tbl_alumnos.existe =1";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(mysqli_error($conn));
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
function addTalleres($nocontrol, $notalleres){
    include '../../database.php';

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
if (isset($_POST["opcion"])) {
    $opcion = $_POST["opcion"];
    switch ($opcion) {
        case 'GETGRUPO':
            $id = $_POST["id"];
            getAlumnos($id);
            break;
        case 'TALLERES':
            $nocontrol = $_POST["nocontrol"];
            $notalleres = $_POST["talleres"];
            addTalleres($nocontrol, $notalleres);
            break;
    }
}
?>