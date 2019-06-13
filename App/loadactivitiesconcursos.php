<?php
    include 'conexion.php'; 
    
    
    $sql="SELECT idevento,nomevento,ponente,fecha,hinicio,hfinal,imgevento from tbl_eventos where tipo='Concurso' and existe=1";
    $result = mysqli_query($con,$sql); 
    $res = array();
    
    while($row = mysqli_fetch_array($result)){
        $date = $row['fecha'];
        $unixTimestamp = strtotime($date);        
        $row['fecha'] = date("l", $unixTimestamp);
        array_push($res, array(
            "act_id"=>$row['idevento'],
            "act_nombre"=>$row['nomevento'],
            "act_subtitulo"=>$row['ponente'],         
            "act_fecha"=>$row['fecha'],
            "act_hinicial"=>date("H:i",strtotime($row['hinicio'])),
            "act_hfinal"=>date("H:i",strtotime($row['hfinal'])),            
            "act_imagen"=>$row['imgevento']="http://ciaigandhi.com/Semana-SISTI2019/Actividades/images/".$row['imgevento'])
            );
    }    
    echo json_encode($res);    
?>