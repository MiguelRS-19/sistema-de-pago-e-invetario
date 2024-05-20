DROP TABLE IF EXISTS cuota;
CREATE TABLE `cuota` (
  `idcuota` int(11) NOT NULL AUTO_INCREMENT,
  `cant_dinero` decimal(12,2) NOT NULL,
  `fecha_pago` datetime NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'no pagado',
  PRIMARY KEY (`idcuota`),
  KEY `idusuario` (`idusuario`,`idpago`),
  KEY `idpago` (`idpago`),
  CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`iduser`),
  CONSTRAINT `cuota_ibfk_2` FOREIGN KEY (`idpago`) REFERENCES `tipo_pago` (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
INSERT INTO cuota VALUES('1', '30.00', '2024-01-18 01:00:00', '1', '1', 'pagado');
INSERT INTO cuota VALUES('2', '30.00', '2024-01-18 09:36:00', '4', '3', 'pagado');
INSERT INTO cuota VALUES('3', '0.00', '2024-01-17 09:37:00', '2', '5', 'no pagado');
INSERT INTO cuota VALUES('4', '40.00', '2024-03-18 09:38:00', '3', '2', 'pagado');
INSERT INTO cuota VALUES('5', '50.00', '2024-01-19 08:12:00', '5', '2', 'pagado');

DROP TABLE IF EXISTS tipo_pago;
CREATE TABLE `tipo_pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `avatar` varchar(80) NOT NULL DEFAULT 'pago_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_pago VALUES('1', 'BCP', '2024-01-17', '65a8853c67e64-bcp.png', 'A');
INSERT INTO tipo_pago VALUES('2', 'YAPE', '2024-01-18', '65a9743133697-yape.png', 'A');
INSERT INTO tipo_pago VALUES('3', 'EFECTIVO', '2024-01-04', 'pago_default.png', 'A');
INSERT INTO tipo_pago VALUES('4', 'Mastercard', '2024-03-05', 'pago_default.png', 'I');
INSERT INTO tipo_pago VALUES('5', 'Ninguna', '2024-01-18', 'pago_default.png', 'A');

DROP TABLE IF EXISTS usuario;
CREATE TABLE `usuario` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `dni` char(8) NOT NULL,
  `user` varchar(80) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` char(10) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT 'user_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
INSERT INTO usuario VALUES('1', '77356057', 'miguelRZ', '12345', 'Miguel', 'Reyes Sanchez', 'AV.El carmen', '938580262', 'miguelRZ@hotmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('2', '72199212', '', '', 'CESAR', 'RINZA', 'CAL.JOSE', '983848474', 'CESAR@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('3', '12334443', 'Juan', '123456', 'FIORELLA TERESA', 'RAMOS', 'AV.UCUPE', '938387772', 'FIORELLAT@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('4', '48246129', '', '', 'JUANA INÉS', 'MENDOZA', 'Av.Tacna', '938448843', 'JUANA@email.com', 'user_default.png', 'I');
INSERT INTO usuario VALUES('5', '40888397', '', '', 'JESSICA', 'Reyes Huaman', 'Av,Pitipo', '983747345', 'jesseca@email.con', 'user_default.png', 'A');

