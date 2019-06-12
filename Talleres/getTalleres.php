<?php
    include '../database.php';

    $sql = "SELECT * FROM tbl_talleres WHERE existe = 1";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die(mysqli_error($conn));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row[0],
            'nombre' => $row[1],
            'descripcion' => $row[2],
            'img' => $row[3],
            'ponente' => $row[4],
            'fecha' => $row[5],
            'inicio' => $row[6],
            'fin' => $row[7],
            'lugar' => $row[8],
            'cupo' => $row[9],
        );
    }
    echo json_encode($json);
?>