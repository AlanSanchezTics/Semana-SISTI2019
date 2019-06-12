<?php
include 'conexion.php';    
$id_user = $_POST["id_user"];
$actualpass = $_POST["actualpass"];
$npass = $_POST["nuevopass"];

$Sql_Query = "SELECT *FROM tbl_usuarios where clave=$actualpass and idusuario=$id_user and existe=1";    
$result=mysqli_query($con,$Sql_Query);
$num_rows = mysqli_num_rows($result);

if($num_rows>0){
    $Sql_Query = "UPDATE tbl_usuarios SET clave=$npass WHERE idusuario=$id_user";         
        if(mysqli_query($con,$Sql_Query)){     
            echo '1';     
        }
        else{     
        echo '0';     
        }     
}else{

    echo '0';
}             
        

mysqli_close($con);
?>