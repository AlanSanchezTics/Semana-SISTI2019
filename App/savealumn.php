<?php
$con = mysqli_connect("localhost", "root","", "bdsisti2019");
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$edad=$_POST['edad'];
$carrera=$_POST['carrera'];
$grado=$_POST['grado'];
$grupo=$_POST['grupo'];
$status=$_POST['status'];
$imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$genero=$_POST['genero'];
$notalleres=$_POST['notalleres'];
$iduser=$_POST['iduser'];

$query="insert into tbl_alumnos(alunombres,aluapellidos,aluedad,alucarrera,alugrado,alugrupo,alustatus,aluimagen,alugenero,alunotalleres,aluexiste,aluiduser) Values('$nombre','$apellido',$edad,'$carrera',$grado,'$grupo'
,$status,'$imagen','$genero',$notalleres,1,$iduser)";
//var_dump($query);
//die();
$resultado=$con->query($query);

if($resultado){
echo 'se insertó';
}else{
    echo 'no se insertó';
}
?>