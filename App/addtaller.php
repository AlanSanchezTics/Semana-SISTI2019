<?php
include 'conexion.php';    
$nocontrol = $_POST["id_alu"];
$id_periodo = $_POST["id_periodo"];
$id_taller = $_POST["id_taller"];

$Sql_Query = "SELECT notalleres FROM tbl_alumnos where nocontrol=$nocontrol and existe=1";
$result=mysqli_query($con,$Sql_Query);
$fila = mysqli_fetch_row($result);
$notalleres= $fila[0];


$Sql_Query = "SELECT *FROM tbl_asig_taller where nocontrol=$nocontrol and idperiodo=$id_periodo  and asigexiste=1";
$result=mysqli_query($con,$Sql_Query);
$asignedtall = mysqli_num_rows($result);


$Sql_Query = "SELECT *FROM tbl_asig_taller where nocontrol=$nocontrol and tallid=
    $id_taller and asigexiste=1 and idperiodo=$id_periodo";
    
    $result=mysqli_query($con,$Sql_Query);
    $num_rows = mysqli_num_rows($result);

if($num_rows>0){
    echo '2'; 
}else
{
    if($asignedtall>=$notalleres){
        echo '3';
    }else{                 
        $Sql_Query = "insert into tbl_asig_taller(nocontrol,tallid,idperiodo,asigexiste) 
        values ($nocontrol,$id_taller,$id_periodo,1)";  
        if(mysqli_query($con,$Sql_Query)){     
            echo '1';     
        }
        else{     
        echo '0';     
        }
        
    }     
}
mysqli_close($con);
?>