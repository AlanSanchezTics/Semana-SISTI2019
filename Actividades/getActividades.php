<?php
if(isset($_POST["tipo"])){
    include '../database.php';

    $sql = "SELECT * FROM `tbl_eventos` WHERE tipo = '".$_POST['tipo']."' AND existe = 1";
    $result = mysqli_query($conn,$sql);
    if(!$result){
        die(mysqli_error($conn));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row[0],
            'nombre' => $row[1],
            'descripcion' => nl2br($row[2]),
            'img' => $row[3],
            'ponente' => $row[4],
            'fecha' => $row[5],
            'inicio' => $row[6],
            'fin' => $row[7],
            'tipo' => $row[8],
            'lugar' => $row[9], 
        );
    }
    echo json_encode($json);
}
?>