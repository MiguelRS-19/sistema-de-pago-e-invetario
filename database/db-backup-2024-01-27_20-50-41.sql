DROP TABLE IF EXISTS cuota;
CREATE TABLE `cuota` (
  `idcuota` int(11) NOT NULL AUTO_INCREMENT,
  `cant_dinero` decimal(12,2) NOT NULL,
  `fecha_consumo` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_pago` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_plazo` datetime NOT NULL DEFAULT current_timestamp(),
  `idusuario` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'no pagado',
  PRIMARY KEY (`idcuota`),
  KEY `idusuario` (`idusuario`,`idpago`),
  KEY `idpago` (`idpago`),
  CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`iduser`),
  CONSTRAINT `cuota_ibfk_2` FOREIGN KEY (`idpago`) REFERENCES `tipo_pago` (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO cuota VALUES('1', '30.00', '2023-11-23 10:39:39', '2024-01-18 01:00:00', '2024-01-18 11:18:11', '1', '1', 'pagado');
INSERT INTO cuota VALUES('2', '30.00', '2023-12-12 10:39:39', '2024-01-18 09:36:00', '2024-01-18 11:18:11', '4', '3', 'pagado');
INSERT INTO cuota VALUES('3', '0.00', '2023-12-15 10:39:39', '2023-12-17 09:37:00', '2024-01-23 11:38:09', '2', '5', 'no pagado');
INSERT INTO cuota VALUES('4', '40.00', '2023-12-15 10:39:39', '2023-12-18 09:38:00', '2024-01-23 11:18:11', '3', '2', 'pagado');
INSERT INTO cuota VALUES('5', '50.00', '2023-12-15 10:39:39', '2024-01-19 08:12:00', '2024-01-18 11:18:11', '5', '2', 'pagado');
INSERT INTO cuota VALUES('6', '60.00', '2023-12-15 10:39:39', '2024-01-22 08:28:00', '2024-01-18 11:18:11', '8', '2', 'pagado');
INSERT INTO cuota VALUES('7', '50.00', '2024-01-22 11:05:01', '2024-01-15 11:04:00', '2024-01-18 11:18:11', '7', '1', 'pagado');
INSERT INTO cuota VALUES('8', '30.00', '2024-01-22 11:11:07', '2024-01-23 11:11:00', '2024-01-23 11:18:11', '6', '1', 'pagado');
INSERT INTO cuota VALUES('9', '50.00', '2023-12-22 11:41:58', '2024-01-22 11:41:00', '2024-01-23 11:18:11', '9', '1', 'pagado');
INSERT INTO cuota VALUES('10', '30.00', '2023-12-22 11:48:03', '2024-01-22 11:47:00', '2024-01-23 11:18:11', '10', '1', 'pagado');
INSERT INTO cuota VALUES('11', '30.00', '2024-01-23 16:01:17', '2024-02-15 16:00:00', '2024-02-23 16:01:17', '11', '2', 'pagado');
INSERT INTO cuota VALUES('12', '0.00', '2024-01-24 08:03:36', '2024-01-24 08:03:00', '2024-01-24 08:03:36', '12', '5', 'no pagado');
INSERT INTO cuota VALUES('13', '0.00', '2024-01-24 08:21:29', '2024-01-29 08:21:00', '2024-02-05 08:21:29', '13', '5', 'no pagado');
INSERT INTO cuota VALUES('14', '0.00', '2023-12-05 10:20:00', '2024-01-28 10:20:00', '2024-02-05 10:20:00', '14', '5', 'no pagado');
INSERT INTO cuota VALUES('15', '0.00', '2024-01-25 14:21:00', '2024-01-25 14:18:00', '2024-02-01 16:19:00', '15', '5', 'no pagado');
INSERT INTO cuota VALUES('16', '0.00', '2023-12-07 14:21:00', '2024-01-25 14:21:00', '2024-02-01 17:21:00', '16', '5', 'no pagado');

DROP TABLE IF EXISTS tipo_pago;
CREATE TABLE `tipo_pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `avatar` varchar(80) NOT NULL DEFAULT 'pago_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO tipo_pago VALUES('1', 'AGENTE BCP', '2024-01-17', '65a8853c67e64-bcp.png', 'A');
INSERT INTO tipo_pago VALUES('2', 'YAPE', '2024-01-18', '65a9743133697-yape.png', 'A');
INSERT INTO tipo_pago VALUES('3', 'EFECTIVO', '2024-01-04', 'pago_default.png', 'A');
INSERT INTO tipo_pago VALUES('4', 'TRANSFERENCIA', '2024-03-05', 'pago_default.png', 'I');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO usuario VALUES('1', '77356057', 'miguelRZ', '12345', 'MIGUEL', 'REYES SANCHEZ', 'AV. EL CARMEN 430 U.VECINAL GONZALES PRADA', '939270636', 'miguelRZ@gmail.com', '65ac9d49b436c-miguel.png', 'A');
INSERT INTO usuario VALUES('2', '72199212', 'CESAR', '123455', 'CESAR', 'RINZA', 'CAL.JOSE', '967456377', 'CESAR@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('3', '12334443', 'Juan', '123456', 'FIORELLA TERESA', 'RAMOS', 'AV.UCUPE', '938387772', 'FIORELLAT@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('4', '48246129', 'JUANA INÉS', '1234567', 'JUANA INÉS', 'MENDOZA', 'Av.Tacna', '938448843', 'JUANA@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('5', '40888397', '', '', 'JESSICA', 'Reyes Huaman', 'Av,Pitipo', '983747345', 'jesseca@email.con', 'user_default.png', 'A');
INSERT INTO usuario VALUES('6', '48246126', '', '', 'TATIANA AMAZONA', 'ACOSTUPA VARGAS', 'CUSCO', '934256345', 'tatiana@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('7', '46646466', '', '', 'HERMENIGILDO', 'HUAMANGA BENITO', 'TRUJILLO', '984248482', 'hermenigildo@gmail.com', 'user_default.png', 'I');
INSERT INTO usuario VALUES('8', '17417595', '', '', 'MIGUEL', 'HUAMAN DE LA CRUZ', 'CASERIO UYURPAMPA', '968364771', 'm.huamand@gmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('9', '00087554', '', '', 'MAYER', 'VASQUEZ RIOS', 'UCAYALI', '984757753', 'mayer@hotmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('10', '26626781', '', '', 'MILTON ROBERTO', 'URBINA LINARES', 'LAMBAYEQUE', '934567878', 'milton@gmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('11', '27166698', '', '', 'MARIA ESTHER', 'CONCEPCION JAVE', 'CAJAMARCA', '984657434', 'maria@gmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('12', '28066866', '', '', 'EDWIN MARTIN', 'CORREA CABANILLAS', 'CAJAMARCA', '945677856', 'edwin@gmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('13', '28305403', '', '', 'JUAN JAVIER', 'GONZALEZ HINOSTROZA', 'CAJAMARCA', '978567456', 'juanj@email.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('14', '26681841', '', '', 'NELLY HAYDEE', 'COTRINA ROJAS', 'CAJAMARCA', '957634523', 'nelly@gmail.com', 'user_default.png', 'A');
INSERT INTO usuario VALUES('15', '10484906', '', '', 'ALCIDES', 'FLORES ALTES', 'COMUNIDAD CAMPESINA DE HUALLANCA S/N', '978677567', '', 'user_default.png', 'A');
INSERT INTO usuario VALUES('16', '27820443', '', '', 'OLINDA ABIGAIL', 'JARAMILLO RAMIREZ', 'JR. MARULANDA 230', '958465677', '', 'user_default.png', 'A');

