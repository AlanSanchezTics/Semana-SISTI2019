<?php
    include 'conexion.php';   
    $idevento=$_POST['id_taller'];

     //cuantos van inscritos    
     $Sql_Query = "SELECT *FROM tbl_asig_taller where tallid=$idevento and asigexiste=1";
     $result=mysqli_query($con,$Sql_Query);
     $inscritos = mysqli_num_rows($result);

    
    $statement = mysqli_prepare($con, "SELECT idtaller,nomtaller,destaller,imgtaller,ponente,fecha,hinicio,hfinal,lugar,
    cupo from tbl_talleres WHERE idtaller=? and existe=1");
    mysqli_stmt_bind_param($statement, "s", $idevento);
    mysqli_stmt_execute($statement);
        
    mysqli_stmt_bind_result($statement, $idtaller,$nomtaller,$destaller,$imgtaller,$ponente,$fecha,$hinicio,$hfinal,
    $lugar,$cupo);    
    $response = array();   

    
    while(mysqli_stmt_fetch($statement)){        
        $date = $fecha;
        $unixTimestamp = strtotime($date);        
        $fecha = date("l", $unixTimestamp);
        $response["tall_id"] = $idtaller;
        $response["tall_nombre"] = $nomtaller; 
        $response["tall_descripcion"] = $destaller;
        $response["tall_ponente"] = $ponente;
        $response["tall_fecha"] = $fecha;
        $response["tall_hinicio"] = date("H:i",strtotime($hinicio));
        $response["tall_hfinal"] = date("H:i",strtotime($hfinal));
        $response["tall_imagen"] = $imgtaller;
        $response["tall_lugar"] = $lugar;
        $response["tall_inscritos"] = $inscritos;
        $response["tall_cupo"] = $cupo;
	}    
    echo json_encode($response);
?>