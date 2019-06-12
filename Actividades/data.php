<?php
    function eliminarEvento($id){
        include '../database.php';
        $sql = "UPDATE tbl_eventos SET existe = 0 WHERE idevento = {$id}";
        if(mysqli_query($conn, $sql)===TRUE){
            die("DELETED");
        }
    }
    function registrarActividad($tipo,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$foto){
        include '../database.php';
        $imagen = "baner.png";
        if($foto['name']!=""){
            $nombreFoto = rand(1,1000);
            $tipoarchivo=$foto['type'];
            $rest = substr($tipoarchivo,6);                            
            $ruta="images/".$nombreFoto.".".$rest;
            $imagen = $nombreFoto.".".$rest;
        }
        $sql = "INSERT INTO `tbl_eventos`(`nomevento`, `desevento`, `imgevento`, `ponente`, `fecha`, `hinicio`, `hfinal`, `tipo`, `lugar`, `existe`) VALUES ('{$nombre}','{$contenido}','{$imagen}','{$ponente}','{$fecha}','{$hora}','{$hora}','{$tipo}','{$lugar}',1)";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die(mysqli_error($conn));
        }
        if($foto["name"]!="")    
            move_uploaded_file($foto['tmp_name'],$ruta);

        die("ADDED");
    }
    function getActividad($id){
        include '../database.php';

        $sql = "SELECT * FROM `tbl_eventos` WHERE idevento = {$id}";
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
    function editarActividad($id,$tipo,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$imgName,$foto){
        include '../database.php';
        
        $imagen = "baner.png";
        if($imgName==""){
            if($foto['name']!=""){
                $nombreFoto = rand(1,1000);
                $tipoarchivo=$foto['type'];
                $rest = substr($tipoarchivo,6);                            
                $ruta="images/".$nombreFoto.".".$rest;
                $imagen = $nombreFoto.".".$rest;
            }
        }else{
            $imagen = $imgName;
        }

        $sql = "UPDATE `tbl_eventos` SET `nomevento`='{$nombre}',`desevento`='{$contenido}',`imgevento`='{$imagen}',`ponente`='{$ponente}',`fecha`='{$fecha}',`hinicio`='{$hora}',`hfinal`='{$hora}',`tipo`='{$tipo}',`lugar`='{$lugar}' WHERE idevento = {$id}";
        if(mysqli_query($conn, $sql)===TRUE){
            if($foto["name"]!="")    
                move_uploaded_file($foto['tmp_name'],$ruta);
            
            die("UPDATED");
        }else{
            die(mysqli_error($conn));
        }
    }
if(isset($_POST["opcion"])){
    $opcion = $_POST["opcion"];

    switch ($opcion) {
        case 'EDITAR':
            $id = $_POST["id"];
            $tipo = $_POST["tipo"];
            $nombre = $_POST["nombre"];
            $contenido = $_POST["descripcion"];
            $ponente = $_POST["ponente"];
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $lugar = $_POST["lugar"];
            $imgName = $_POST["imgName"];
            $foto = $_FILES["imagen"];
            editarActividad($id,$tipo,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$imgName,$foto);
            break;
        case 'GETACTIVIDAD':
            $id = $_POST["id"];
            getActividad($id);
            break;
        case 'ELIMINAR':
            $id = $_POST["id"];
            eliminarEvento($id);
            break;
        case 'REGISTRAR':
                $tipo = $_POST["tipo"];
                $nombre = $_POST["nombre"];
                $contenido = $_POST["descripcion"];
                $ponente = $_POST["ponente"];
                $fecha = $_POST["fecha"];
                $hora = $_POST["hora"];
                $lugar = $_POST["lugar"];
                $foto = $_FILES["imagen"];
                registrarActividad($tipo,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$foto);
                break;
    }
}
?>