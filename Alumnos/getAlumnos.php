<?php
    include '../database.php';

    $sql = "SELECT tbl_alumnos.nocontrol, tbl_alumnos.alunombre, tbl_alumnos.aluapaterno, tbl_alumnos.aluamaterno, tbl_alumnos.tel, tbl_alumnos.correo, tbl_carreras.nomcarrera, tbl_grupo.semestre, tbl_grupo.nomgrupo, tbl_alumnos.turno, tbl_alumnos.notalleres, tbl_carreras.idcarrera, tbl_grupo.idgrupo, tbl_periodos.idperiodo, tbl_alumnos.imagen, tbl_alumnos.alugenero FROM tbl_alumnos, tbl_grupo, tbl_carreras, tbl_asig_grupo_alumn, tbl_periodos WHERE tbl_asig_grupo_alumn.idperiodo = tbl_periodos.idperiodo AND tbl_alumnos.idcarrera = tbl_carreras.idcarrera AND tbl_asig_grupo_alumn.idgrupo = tbl_grupo.idgrupo AND tbl_asig_grupo_alumn.nocontrol = tbl_alumnos.nocontrol AND tbl_alumnos.existe = 1";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die();
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json['data'][]  = array(
            'nocontrol' => $row[0],
            'nombre' => $row[1].' '.$row[2].' '.$row[3],
            'telefono' => $row[4],
            'correo' => $row[5],
            'carrera' => $row[6],
            'semestre' => $row[7],
            'grupo' => $row[8],
            'turno' => $row[9],
            'talleres' => $row[10],
            'nombresingle'=> $row[1],
            'apaterno'=> $row[2],
            'amaterno'=> $row[3],
            'idcarrera'=> $row[11],
            'idgrupo'=> $row[12],
            'idperiodo'=> $row[13],
            'foto'=> $row[14],
            'genero' => $row[15]

        );
    }
    echo json_encode($json);
?>