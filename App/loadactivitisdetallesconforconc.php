<?php
    include 'conexion.php';   
    $idevento=$_POST['idevento'];

    
    $statement = mysqli_prepare($con, "SELECT idevento,nomevento,desevento,ponente,fecha,hinicio,hfinal,
    imgevento,lugar from tbl_eventos where idevento=? and existe=1");
    mysqli_stmt_bind_param($statement, "s", $idevento);
    mysqli_stmt_execute($statement);
        
    mysqli_stmt_bind_result($statement, $id_evento,$nomevento,$desevento,$ponente,$fecha,$hinicio,$hfinal,$imgevento,
    $lugar);    
    $response = array();   
    
    while(mysqli_stmt_fetch($statement)){        
        $date = $fecha;
        $unixTimestamp = strtotime($date);        
        $fecha = date("l", $unixTimestamp);
        $response["act_id"] = $idevento; 
        $response["act_nombre"] = $nomevento; 
        $response["act_descripcion"] = $desevento;
        $response["act_ponente"] = $ponente;
        $response["act_fecha"] = $fecha;
        $response["act_hinicio"] = date("H:i",strtotime($hinicio));
        $response["act_hfinal"] = date("H:i",strtotime($hfinal));
        $response["act_imagen"] = $imgevento;
        $response["act_lugar"] = $lugar;
	}    
    echo json_encode($response);
?>