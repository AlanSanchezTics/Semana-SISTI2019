-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2019 a las 17:41:44
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisti2019`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `matricula` bigint(20) NOT NULL,
  `nomadm` varchar(100) NOT NULL,
  `admapaterno` varchar(100) NOT NULL,
  `admamaterno` varchar(100) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alumnos`
--

CREATE TABLE `tbl_alumnos` (
  `nocontrol` bigint(20) NOT NULL,
  `alunombre` varchar(50) NOT NULL,
  `aluapaterno` varchar(100) NOT NULL,
  `aluamaterno` varchar(100) DEFAULT NULL,
  `idcarrera` bigint(20) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `turno` char(1) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `notalleres` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `alugenero` varchar(20) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_alumnos`
--

INSERT INTO `tbl_alumnos` (`nocontrol`, `alunombre`, `aluapaterno`, `aluamaterno`, `idcarrera`, `tel`, `turno`, `correo`, `notalleres`, `imagen`, `alugenero`, `existe`) VALUES
(1, 'Hector', 'Palomino', 'Vargas', 1, '322263824', 'M', 'hdector1091@gmail.com', 3, 'https://66.media.tumblr.com/e8ef0fd7cb016170fc1593c20e349692/tumblr_oxhemhp08J1rvnle4o1_1280.jpg', 'Masculino', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asig_grupo_alumn`
--

CREATE TABLE `tbl_asig_grupo_alumn` (
  `idasiggrpalum` bigint(20) NOT NULL,
  `nocontrol` bigint(20) NOT NULL,
  `idgrupo` bigint(20) NOT NULL,
  `idperiodo` bigint(20) NOT NULL,
  `asigexiste` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_asig_grupo_alumn`
--

INSERT INTO `tbl_asig_grupo_alumn` (`idasiggrpalum`, `nocontrol`, `idgrupo`, `idperiodo`, `asigexiste`) VALUES
(1, 1, 1, 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asig_grupo_doc`
--

CREATE TABLE `tbl_asig_grupo_doc` (
  `idasiggrpdoc` bigint(20) NOT NULL,
  `iddoc` bigint(20) NOT NULL,
  `idgrupo` bigint(20) NOT NULL,
  `idperiodo` bigint(20) NOT NULL,
  `asigexiste` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asig_taller`
--

CREATE TABLE `tbl_asig_taller` (
  `idasigtall` bigint(20) NOT NULL,
  `nocontrol` bigint(20) NOT NULL,
  `tallid` bigint(20) NOT NULL,
  `idperiodo` bigint(20) NOT NULL,
  `asigexiste` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_asig_taller`
--

INSERT INTO `tbl_asig_taller` (`idasigtall`, `nocontrol`, `tallid`, `idperiodo`, `asigexiste`) VALUES
(36, 1, 1, 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carreras`
--

CREATE TABLE `tbl_carreras` (
  `idcarrera` bigint(20) NOT NULL,
  `nomcarrera` text NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_carreras`
--

INSERT INTO `tbl_carreras` (`idcarrera`, `nomcarrera`, `existe`) VALUES
(1, 'Ingenieria En Tecnologias de la informacion y Comunicaicones', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_docentes`
--

CREATE TABLE `tbl_docentes` (
  `matricula` bigint(20) NOT NULL,
  `nomdoc` varchar(100) NOT NULL,
  `docapaterno` varchar(100) NOT NULL,
  `docamaterno` varchar(100) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_eventos`
--

CREATE TABLE `tbl_eventos` (
  `idevento` bigint(20) NOT NULL,
  `nomevento` text NOT NULL,
  `desevento` text NOT NULL,
  `imgevento` text NOT NULL,
  `ponente` text NOT NULL,
  `fecha` date NOT NULL,
  `hinicio` time NOT NULL,
  `hfinal` time NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `lugar` text NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_eventos`
--

INSERT INTO `tbl_eventos` (`idevento`, `nomevento`, `desevento`, `imgevento`, `ponente`, `fecha`, `hinicio`, `hfinal`, `tipo`, `lugar`, `existe`) VALUES
(1, 'Gran Charreada', 'una super charreada aca bien perrona en las instalaciones del tec sdfdsfds\r\nfsd\r\nf\r\nsd\r\nfsd\r\nf\r\nsdfsdfsdfsdfsdfsdfsdfsdf entocnes aveda\r\n', 'https://i.ytimg.com/vi/E73gqzbKvI0/hqdefault.jpg', 'CAlibre 50', '2019-05-01', '15:00:00', '17:00:00', 'Concurso', 'En el audiovisual', b'1'),
(2, 'Gran jaripeo', 'un super jaripeo aca bien perrona en las instalaciones del tec', 'https://www.elsoldepuebla.com.mx/gossip/c4buaz-jaripeo-int-3/alternates/LANDSCAPE_400/Jaripeo-int-3', 'Jaripeo', '2019-05-01', '15:00:00', '17:00:00', 'Concurso', 'En el audiovisual', b'1'),
(3, 'CUetiza', 'una cuetiza bien perrona', 'https://www.nvinoticias.com/sites/default/files/styles/node/public/notas/2016/12/11/image_16_copia_0.jpg?itok=IMrcuvbI', 'EL firulais', '2019-05-02', '14:00:00', '16:00:00', 'Concurso', 'edifico f', b'1'),
(4, 'Kermes', 'venta detochomorochoi', 'https://pbs.twimg.com/profile_images/1069686497429745664/Ydw1htjp_400x400.jpg', 'EL firulais', '2019-05-02', '14:00:00', '16:00:00', 'Concurso', 'edifico f', b'1'),
(5, 'Conerencia de prensa', 'una cionferencia bien perrona', 'https://images-na.ssl-images-amazon.com/images/I/81VStYnDGrL.jpg', 'Jobs', '2019-05-02', '12:00:00', '14:00:00', 'Conferenci', 'arriba del A', b'1'),
(6, 'Conerencia de prensa 2', 'una cionferencia bien perrona', 'https://assets.entrepreneur.com/content/3x2/2000/20180703190744-rollsafe-meme.jpeg?width=700&crop=2:1', 'Jobs', '2019-05-02', '12:00:00', '14:00:00', 'Conferenci', 'arriba del A', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupo`
--

CREATE TABLE `tbl_grupo` (
  `idgrupo` bigint(20) NOT NULL,
  `nomgrupo` char(1) NOT NULL,
  `semestre` char(1) NOT NULL,
  `carrera` bigint(20) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_grupo`
--

INSERT INTO `tbl_grupo` (`idgrupo`, `nomgrupo`, `semestre`, `carrera`, `existe`) VALUES
(1, 'A', '8', 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pagos`
--

CREATE TABLE `tbl_pagos` (
  `idpago` bigint(20) NOT NULL,
  `nocontrol` bigint(20) NOT NULL,
  `monto` float NOT NULL,
  `idperiodo` bigint(20) NOT NULL,
  `fechapago` date NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pagos`
--

INSERT INTO `tbl_pagos` (`idpago`, `nocontrol`, `monto`, `idperiodo`, `fechapago`, `existe`) VALUES
(1, 1, 200, 1, '2019-01-01', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_periodos`
--

CREATE TABLE `tbl_periodos` (
  `idperiodo` bigint(20) NOT NULL,
  `ano` date NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_periodos`
--

INSERT INTO `tbl_periodos` (`idperiodo`, `ano`, `existe`) VALUES
(1, '2019-01-01', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_talleres`
--

CREATE TABLE `tbl_talleres` (
  `idtaller` bigint(20) NOT NULL,
  `nomtaller` text NOT NULL,
  `destaller` text NOT NULL,
  `imgtaller` text NOT NULL,
  `ponente` text NOT NULL,
  `fecha` date NOT NULL,
  `hinicio` time NOT NULL,
  `hfinal` time NOT NULL,
  `lugar` text NOT NULL,
  `cupo` int(11) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_talleres`
--

INSERT INTO `tbl_talleres` (`idtaller`, `nomtaller`, `destaller`, `imgtaller`, `ponente`, `fecha`, `hinicio`, `hfinal`, `lugar`, `cupo`, `existe`) VALUES
(1, 'TAller de compto', 'un taller chidoliro punchis punchis', 'https://ichef.bbci.co.uk/news/660/cpsprodpb/CF00/production/_102929925_rockstack1.jpg', 'Don roca', '2019-05-01', '14:00:00', '15:00:00', 'aqui mero', 20, b'1'),
(2, 'TAller de memes', 'un taller chidoliro punchis punchis', 'https://images.theconversation.com/files/274721/original/file-20190515-60554-1ti5x8n.png?ixlib=rb-1.1.0&q=45&auto=format&w=668&h=324&fit=crop', 'Don meme', '2019-05-02', '14:00:00', '15:00:00', 'aqui mero', 10, b'1'),
(3, 'TAller de CArros alv', 'un taller chidoliro punchis punchis', 'https://www.diariomotor.com/imagenes/picscache/1440x655c/v12-m120-mercedes_1440x655c.jpg', 'Don TAller', '2019-05-03', '14:00:00', '15:00:00', 'aqui mero', 10, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `idusuario` bigint(20) NOT NULL,
  `usuario` bigint(20) NOT NULL,
  `clave` varchar(10) NOT NULL,
  `tipo` bigint(20) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`idusuario`, `usuario`, `clave`, `tipo`, `existe`) VALUES
(1, 1, '1', 1, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usutipo`
--

CREATE TABLE `tbl_usutipo` (
  `idtipo` bigint(20) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `existe` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usutipo`
--

INSERT INTO `tbl_usutipo` (`idtipo`, `tipo`, `existe`) VALUES
(1, 'Alumno', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD PRIMARY KEY (`nocontrol`),
  ADD KEY `idcarrera` (`idcarrera`);

--
-- Indices de la tabla `tbl_asig_grupo_alumn`
--
ALTER TABLE `tbl_asig_grupo_alumn`
  ADD PRIMARY KEY (`idasiggrpalum`),
  ADD KEY `nocontrol` (`nocontrol`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `tbl_asig_grupo_doc`
--
ALTER TABLE `tbl_asig_grupo_doc`
  ADD PRIMARY KEY (`idasiggrpdoc`),
  ADD KEY `iddoc` (`iddoc`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `tbl_asig_taller`
--
ALTER TABLE `tbl_asig_taller`
  ADD PRIMARY KEY (`idasigtall`),
  ADD KEY `nocontrol` (`nocontrol`),
  ADD KEY `tallid` (`tallid`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  ADD PRIMARY KEY (`idcarrera`);

--
-- Indices de la tabla `tbl_docentes`
--
ALTER TABLE `tbl_docentes`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `tbl_eventos`
--
ALTER TABLE `tbl_eventos`
  ADD PRIMARY KEY (`idevento`);

--
-- Indices de la tabla `tbl_grupo`
--
ALTER TABLE `tbl_grupo`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `tbl_pagos`
--
ALTER TABLE `tbl_pagos`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `nocontrol` (`nocontrol`),
  ADD KEY `idperiodo` (`idperiodo`);

--
-- Indices de la tabla `tbl_periodos`
--
ALTER TABLE `tbl_periodos`
  ADD PRIMARY KEY (`idperiodo`);

--
-- Indices de la tabla `tbl_talleres`
--
ALTER TABLE `tbl_talleres`
  ADD PRIMARY KEY (`idtaller`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `tbl_usutipo`
--
ALTER TABLE `tbl_usutipo`
  ADD PRIMARY KEY (`idtipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_asig_grupo_alumn`
--
ALTER TABLE `tbl_asig_grupo_alumn`
  MODIFY `idasiggrpalum` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_asig_grupo_doc`
--
ALTER TABLE `tbl_asig_grupo_doc`
  MODIFY `idasiggrpdoc` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_asig_taller`
--
ALTER TABLE `tbl_asig_taller`
  MODIFY `idasigtall` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbl_carreras`
--
ALTER TABLE `tbl_carreras`
  MODIFY `idcarrera` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_eventos`
--
ALTER TABLE `tbl_eventos`
  MODIFY `idevento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_grupo`
--
ALTER TABLE `tbl_grupo`
  MODIFY `idgrupo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_pagos`
--
ALTER TABLE `tbl_pagos`
  MODIFY `idpago` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_periodos`
--
ALTER TABLE `tbl_periodos`
  MODIFY `idperiodo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_talleres`
--
ALTER TABLE `tbl_talleres`
  MODIFY `idtaller` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_usutipo`
--
ALTER TABLE `tbl_usutipo`
  MODIFY `idtipo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD CONSTRAINT `tbl_alumnos_ibfk_1` FOREIGN KEY (`idcarrera`) REFERENCES `tbl_carreras` (`idcarrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_asig_grupo_alumn`
--
ALTER TABLE `tbl_asig_grupo_alumn`
  ADD CONSTRAINT `tbl_asig_grupo_alumn_ibfk_1` FOREIGN KEY (`nocontrol`) REFERENCES `tbl_alumnos` (`nocontrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_grupo_alumn_ibfk_2` FOREIGN KEY (`idgrupo`) REFERENCES `tbl_grupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_grupo_alumn_ibfk_3` FOREIGN KEY (`idperiodo`) REFERENCES `tbl_periodos` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_asig_grupo_doc`
--
ALTER TABLE `tbl_asig_grupo_doc`
  ADD CONSTRAINT `tbl_asig_grupo_doc_ibfk_1` FOREIGN KEY (`iddoc`) REFERENCES `tbl_docentes` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_grupo_doc_ibfk_2` FOREIGN KEY (`idgrupo`) REFERENCES `tbl_grupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_grupo_doc_ibfk_3` FOREIGN KEY (`idperiodo`) REFERENCES `tbl_periodos` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_asig_taller`
--
ALTER TABLE `tbl_asig_taller`
  ADD CONSTRAINT `tbl_asig_taller_ibfk_1` FOREIGN KEY (`nocontrol`) REFERENCES `tbl_alumnos` (`nocontrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_taller_ibfk_2` FOREIGN KEY (`tallid`) REFERENCES `tbl_talleres` (`idtaller`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_asig_taller_ibfk_3` FOREIGN KEY (`idperiodo`) REFERENCES `tbl_periodos` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_grupo`
--
ALTER TABLE `tbl_grupo`
  ADD CONSTRAINT `tbl_grupo_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `tbl_carreras` (`idcarrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_pagos`
--
ALTER TABLE `tbl_pagos`
  ADD CONSTRAINT `tbl_pagos_ibfk_1` FOREIGN KEY (`nocontrol`) REFERENCES `tbl_alumnos` (`nocontrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pagos_ibfk_2` FOREIGN KEY (`idperiodo`) REFERENCES `tbl_periodos` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tbl_usutipo` (`idtipo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
