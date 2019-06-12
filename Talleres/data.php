<?php
    function eliminarTaller($id){
        include '../database.php';

        $sql ="UPDATE tbl_talleres SET existe = 0 WHERE idtaller = {$id}";
        if(mysqli_query($conn, $sql)===TRUE){
            die("DELETED");
        }
    }
    function registrarTaller($nombre,$contenido,$ponente,$fecha,$hora,$lugar,$cupo,$foto){
        include '../database.php';
        $imagen = "baner.png";
        if($foto['name']!=""){
            $nombreFoto = rand(1,1000);
            $tipoarchivo=$foto['type'];
            $rest = substr($tipoarchivo,6);                            
            $ruta="images/".$nombreFoto.".".$rest;
            $imagen = $nombreFoto.".".$rest;
        }
        $sql = "INSERT INTO `tbl_talleres`(`nomtaller`, `destaller`, `imgtaller`, `ponente`, `fecha`, `hinicio`, `hfinal`, `lugar`, `cupo`, `existe`) VALUES ('{$nombre}','{$contenido}','{$imagen}','{$ponente}','{$fecha}','{$hora}','{$hora}','{$lugar}',{$cupo},1)";
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

        $sql = "SELECT * FROM tbl_talleres WHERE idtaller = {$id}";
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
    }
    function editarTaller($id,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$cupo,$imgName,$foto){
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
        $sql = "UPDATE `tbl_talleres` SET `nomtaller`='{$nombre}',`destaller`='{$contenido}',`imgtaller`='{$imagen}',`ponente`='{$ponente}',`fecha`='{$fecha}',`hinicio`='{$hora}',`hfinal`='{$hora}',`lugar`='{$lugar}',`cupo`={$cupo} WHERE idtaller = {$id}";
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
            case 'ELIMINAR':
                $id = $_POST["id"];
                eliminarTaller($id);
                break;
            case 'REGISTRAR':
                $nombre = $_POST["nombre"];
                $contenido = $_POST["descripcion"];
                $ponente = $_POST["ponente"];
                $fecha = $_POST["fecha"];
                $hora = $_POST["hora"];
                $lugar = $_POST["lugar"];
                $cupo = $_POST["cupo"];
                $foto = $_FILES["imagen"];
                registrarTaller($nombre,$contenido,$ponente,$fecha,$hora,$lugar,$cupo,$foto);
                break;
            case 'GETACTIVIDAD':
                $id = $_POST["id"];
                getActividad($id);
                break;
            case 'EDITAR':
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $contenido = $_POST["descripcion"];
                $ponente = $_POST["ponente"];
                $fecha = $_POST["fecha"];
                $hora = $_POST["hora"];
                $lugar = $_POST["lugar"];
                $cupo = $_POST["cupo"];
                $imgName = $_POST["imgName"];
                $foto = $_FILES["imagen"];
                editarTaller($id,$nombre,$contenido,$ponente,$fecha,$hora,$lugar,$cupo,$imgName,$foto);
                break;
        }
    }
?>