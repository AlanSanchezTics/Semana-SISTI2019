<?php
    include '../database.php';
    $json= array();
    $sql = "SELECT * FROM tbl_docentes WHERE existe = 1";

    $result = mysqli_query($conn, $sql);
    if(!$result){
        die(json_encode($json));
    }

    while ($row = mysqli_fetch_array($result)) {
        $json['data'][] = array(
            'matricula' => $row[0],
            'fullName' => $row[1]." ".$row[2]." ".$row[3],
            'nombre' => $row[1],
            'apaterno' => $row[2],
            'amaterno' => $row[3],
            'correo' => $row[4],
            'telefono' => $row[5],
            'sexo' => $row[6]
        );
    }

    echo json_encode($json);
?>