<?php
    include 'conexion.php';   
    $id_alu=$_POST['id_alu'];    
    $sql="SELECT idtaller,nomtaller,destaller,imgtaller,ponente,fecha,hinicio,hfinal,lugar,cupo from 
    tbl_talleres,tbl_asig_taller WHERE tbl_asig_taller.nocontrol=$id_alu AND tbl_asig_taller.tallid=tbl_talleres.idtaller 
    AND tbl_asig_taller.asigexiste=1";
    $result = mysqli_query($con,$sql); 
    $res = array();
    
    while($row = mysqli_fetch_array($result)){
        $date = $row['fecha'];
        $unixTimestamp = strtotime($date);        
        $row['fecha'] = date("l", $unixTimestamp);

        //cuantos van inscritos 
        $id_taller=$row['idtaller'];   
        $Sql_Query = "SELECT count(idasigtall) FROM tbl_asig_taller where tallid=$id_taller and asigexiste=1";
        $resultado=mysqli_query($con,$Sql_Query);
        $inscritos = mysqli_fetch_array($resultado);    
        $isassigned=1;
        array_push($res, array(
            "tall_id"=>$row['idtaller'],
            "tall_nombre"=>$row['nomtaller'],
            "tall_destaller"=>$row['destaller'],
            "tall_imagen"=>$row['imgtaller']="http://ciaigandhi.com/Semana-SISTI2019/Actividades/images/".$row['imgtaller'],
            "tall_ponente"=>$row['ponente'],    
            "tall_fecha"=>$row['fecha'],
            "tall_hinicial"=>date("H:i",strtotime($row['hinicio'])),
            "tall_hfinal"=>date("H:i",strtotime($row['hfinal'])),
            "tall_lugar"=>$row['lugar'],
            "tall_cupo"=>$inscritos[0].'/'.$row['cupo'],
            "tall_assigned"=>$isassigned)
            );
    }    
    echo json_encode($res);    
?>