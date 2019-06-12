CREATE TABLE tbl_carreras(idcarrera bigint not null AUTO_INCREMENT, nomcarrera text not null,existe 
bit not null,PRIMARY KEY(idcarrera));

CREATE TABLE tbl_usutipo(idtipo bigint not null AUTO_INCREMENT, tipo varchar(30) not null,existe 
bit not null,PRIMARY KEY(idtipo));

CREATE TABLE tbl_alumnos(nocontrol bigint not null, alunombre varchar(50) not null, aluapaterno varchar(100) 
not null, aluamaterno varchar(100) ,idcarrera bigint not null,tel varchar(15) not null,turno char not null,correo varchar(100) not null,
notalleres int not null,imagen text not null,alugenero varchar(20) not null,existe bit not null, PRIMARY KEY(nocontrol), 
FOREIGN KEY(idcarrera) REFERENCES tbl_carreras(idcarrera) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_periodos(idperiodo bigint not null AUTO_INCREMENT, ano date not null,existe 
bit not null,PRIMARY KEY(idperiodo));

CREATE TABLE tbl_pagos(idpago bigint not null AUTO_INCREMENT,nocontrol bigint not null ,monto float not null,idperiodo bigint not null,
fechapago date not null,existe bit not null,PRIMARY KEY(idpago), FOREIGN KEY(nocontrol) REFERENCES tbl_alumnos(nocontrol) 
ON DELETE CASCADE ON UPDATE CASCADE,FOREIGN KEY(idperiodo) REFERENCES tbl_periodos(idperiodo) ON DELETE CASCADE ON UPDATE CASCADE );

CREATE TABLE tbl_usuarios(idusuario bigint not null AUTO_INCREMENT,usuario bigint not null ,clave varchar(10) not null,tipo bigint 
not null, existe bit not null,PRIMARY KEY(idusuario), FOREIGN KEY(tipo) REFERENCES tbl_usutipo(idtipo) ON DELETE CASCADE 
ON UPDATE CASCADE);

CREATE TABLE tbl_docentes(matricula bigint not null,nomdoc varchar(100) not null,docapaterno varchar(100) not null,docamaterno 
varchar(100) not null,existe bit not null,PRIMARY KEY(matricula));

CREATE TABLE tbl_admin(matricula bigint not null,nomadm varchar(100) not null,admapaterno varchar(100) not null,admamaterno 
varchar(100) not null,existe bit not null,PRIMARY KEY(matricula));

CREATE TABLE tbl_grupo(idgrupo bigint not null AUTO_INCREMENT,nomgrupo char not null ,semestre char not null,carrera bigint 
not null, existe bit not null,PRIMARY KEY(idgrupo), FOREIGN KEY(carrera) REFERENCES tbl_carreras(idcarrera) ON DELETE CASCADE 
ON UPDATE CASCADE);

CREATE TABLE tbl_talleres(idtaller bigint not null AUTO_INCREMENT,nomtaller text not null ,destaller text not null ,
imgtaller text not null , ponente text not null ,fecha date not null ,hinicio time not null ,hfinal time not null ,
lugar text not null,cupo int not null, existe bit not null,PRIMARY KEY(idtaller));

CREATE TABLE tbl_eventos(idevento bigint not null AUTO_INCREMENT,nomevento text not null ,desevento text not null ,
imgevento text not null , ponente text not null ,fecha date not null ,hinicio time not null ,hfinal time not null ,
tipo varchar(10) not null,lugar text not null,existe bit not null,PRIMARY KEY(idevento));

CREATE TABLE tbl_asig_taller(idasigtall bigint not null AUTO_INCREMENT, nocontrol bigint not null,tallid bigint not null ,idperiodo bigint
not null,asigexiste bit not null,PRIMARY KEY(idasigtall), FOREIGN KEY(nocontrol) REFERENCES tbl_alumnos(nocontrol) 
ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(tallid) REFERENCES tbl_talleres(idtaller) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(idperiodo) REFERENCES tbl_periodos(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_asig_grupo_alumn(idasiggrpalum bigint not null AUTO_INCREMENT, nocontrol bigint not null,idgrupo bigint not null ,idperiodo bigint
not null,asigexiste bit not null,PRIMARY KEY(idasiggrpalum), FOREIGN KEY(nocontrol) REFERENCES tbl_alumnos(nocontrol) 
ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(idgrupo) REFERENCES tbl_grupo(idgrupo) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(idperiodo) REFERENCES tbl_periodos(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_asig_grupo_doc(idasiggrpdoc bigint not null AUTO_INCREMENT, iddoc bigint not null,idgrupo bigint not null ,idperiodo bigint
not null,asigexiste bit not null,PRIMARY KEY(idasiggrpdoc), FOREIGN KEY(iddoc) REFERENCES tbl_docentes(matricula) 
ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(idgrupo) REFERENCES tbl_grupo(idgrupo) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(idperiodo) REFERENCES tbl_periodos(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);











CREATE TABLE tbl_usuarios(iduser bigint not null AUTO_INCREMENT, username varchar(20) not null, password varchar(20) not null,
usutipo int not null, usuexiste bit not null,PRIMARY KEY(iduser) );

CREATE TABLE tbl_docentes(iddoc bigint not null AUTO_INCREMENT, docnombre varchar(200) not null, docapellidos varchar(200) 
not null,docasiggrupo int not null, docexiste bit not null,dociduser bigint not null,PRIMARY KEY(iddoc), FOREIGN KEY(dociduser) 
REFERENCES tbl_usuarios(iduser) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_admin(idadmin bigint not null AUTO_INCREMENT, admnombre varchar(200) not null, admapellidos varchar(200) not null,
admexiste bit not null,admiduser bigint not null,PRIMARY KEY(idadmin), FOREIGN KEY(admiduser) REFERENCES tbl_usuarios(iduser) 
ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_talleres(idtaller bigint not null AUTO_INCREMENT, tallnombre varchar(200) not null, tallsubtitulo varchar(300) 
not null,talldescripcion varchar(500) not null,tallimpartidopor varchar(200) not null,tallhinicio datetime not null,tallhfinal 
datetime not null,tallimagen blob not null,talllugar varchar(300) not null,tallcupo int not null,tallexiste bit not null, 
PRIMARY KEY(idtaller));

CREATE TABLE tbl_actividades(idact bigint not null AUTO_INCREMENT, actnombre varchar(200) not null, actsubtitulo varchar(300) 
not null,actdescripcion varchar(500) not null,actimpartidopor varchar(200) not null,acthinicio datetime not null,acthfinal 
datetime not null,actimagen blob not null,actlugar varchar(300) not null,actcupo int not null,acttipo varchar(100) not null,
actexiste bit not null,PRIMARY KEY(idact));

CREATE TABLE tbl_asig_grupo(idasiggrp bigint not null AUTO_INCREMENT, docid bigint not null,grupo int not null ,asigexiste 
bit not null,PRIMARY KEY(idasiggrp), FOREIGN KEY(docid) REFERENCES tbl_docentes(iddoc) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tbl_asig_taller(idasigtall bigint not null AUTO_INCREMENT, aluid bigint not null,tallid bigint not null ,idperiodo bigint
not null,asigexiste bit not null,PRIMARY KEY(idasigtall), FOREIGN KEY(aluid) REFERENCES tbl_alumnos(idalu) 
ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(tallid) REFERENCES tbl_talleres(idtaller) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY(idperiodo) REFERENCES tbl_periodos(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);






//saceua//
CREATE TABLE tblbecas(idBeca bigint not null AUTO_INCREMENT,idAlumno bigint not null,porcentaje int not null ,idperiodo bigint not null,status bit not null,PRIMARY KEY(idBeca), FOREIGN KEY(idAlumno) REFERENCES tblalumno(idAlumno) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(idperiodo) REFERENCES tblperiodo(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tblnocontables(nocontable bigint not null AUTO_INCREMENT,idAlumno bigint not null,status bit not null,PRIMARY KEY(nocontable), FOREIGN KEY(idAlumno) REFERENCES tblalumno(idAlumno) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tblpagoservicio(folio bigint not null AUTO_INCREMENT,nocontable bigint not null,idservicio bigint not null ,idperiodo bigint not null,pago_tipo varchar(50) not null,fecha_pago date ,correo_factura text ,comentarios text,total float,pagoexiste bit not null,PRIMARY KEY(folio), FOREIGN KEY(nocontable) REFERENCES tblnocontables(nocontable) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY(idservicio) REFERENCES tblservicios(idservicio) ON UPDATE CASCADE ON DELETE CASCADE,FOREIGN KEY(idperiodo) REFERENCES tblperiodo(idperiodo) ON UPDATE CASCADE ON DELETE CASCADE);

CREATE TABLE tblservicios(idservicio bigint not null AUTO_INCREMENT,nombre_servicio varchar(200),costo_servicio float,status bit not null,
PRIMARY KEY(idservicio));

//sin referencias//

CREATE TABLE tblbecas(idBeca bigint not null AUTO_INCREMENT,idAlumno bigint not null,porcentaje int not null ,idperiodo bigint not null,status bit not null,PRIMARY KEY(idBeca));

CREATE TABLE tblnocontables(nocontable bigint not null AUTO_INCREMENT,idAlumno bigint not null,status bit not null,PRIMARY KEY(nocontable));

CREATE TABLE tblpagoservicio(folio bigint not null AUTO_INCREMENT,nocontable bigint not null,idservicio bigint not null ,idperiodo bigint not null,pago_tipo varchar(50) not null,fecha_pago date ,correo_factura text ,comentarios text,total float,pagoexiste bit not null,PRIMARY KEY(folio));

CREATE TABLE tblservicios(idservicio bigint not null AUTO_INCREMENT,nombre_servicio varchar(200),costo_servicio float,status bit not null,
PRIMARY KEY(idservicio));
