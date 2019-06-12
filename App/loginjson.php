<?php
    include 'conexion.php';
    
    $user = $_POST["user"];
    $password = $_POST["password"];    
    
    $statement = mysqli_prepare($con, "SELECT tbl_usuarios.idusuario,tbl_usuarios.clave,tbl_carreras.nomcarrera,tbl_alumnos.alunombre,tbl_alumnos.aluapaterno,tbl_alumnos.aluamaterno,tbl_alumnos.turno,tbl_grupo.semestre,tbl_grupo.nomgrupo,
    tbl_pagos.monto,tbl_alumnos.imagen,tbl_alumnos.alugenero,tbl_alumnos.nocontrol, tbl_asig_grupo_alumn.idperiodo 
    FROM tbl_alumnos,tbl_usuarios,tbl_carreras,tbl_grupo,tbl_pagos,tbl_asig_grupo_alumn where tbl_usuarios.usuario=? 
    and tbl_usuarios.clave=? and tbl_alumnos.nocontrol=tbl_usuarios.usuario AND
        tbl_alumnos.idcarrera=tbl_carreras.idcarrera and tbl_asig_grupo_alumn.nocontrol = tbl_alumnos.nocontrol 
        and tbl_asig_grupo_alumn.idgrupo= tbl_grupo.idgrupo and 
        tbl_pagos.nocontrol=tbl_alumnos.nocontrol and tbl_pagos.existe=1");

    mysqli_stmt_bind_param($statement, "ss", $user, $password);
    mysqli_stmt_execute($statement);
        
    mysqli_stmt_store_result($statement);

    mysqli_stmt_bind_result($statement, $id_user,$pass_user,$al_carrera,$al_nombre,$al_apaterno,
    $al_amaterno,$al_turno,$al_semestre,$al_grupo,$al_monto,$al_imagen,$al_genero,$id_alu,$id_periodo);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true; 
        $response["id_user"] = $id_user; 
        $response["pass_user"] = $pass_user; 
        $response["al_carrera"] = $al_carrera;
        $response["al_nombre"] = $al_nombre;
        $response["al_apaterno"] = $al_apaterno;
        $response["al_amaterno"] = $al_amaterno;
        $response["al_turno"] = $al_turno;
        $response["al_semestre"] = $al_semestre;
        $response["al_grupo"] = $al_grupo;
        $response["al_monto"] = $al_monto;
        $response["al_imagen"] = $al_imagen;
        $response["al_genero"] = $al_genero;
        $response["id_alu"] = $id_alu;
        $response["id_periodo"] = $id_periodo;
	}    
    echo json_encode($response);
?>