DROP TABLE IF EXISTS categoria;
CREATE TABLE `categoria` (
  `idcat` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idcat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO categoria VALUES('1', 'Tecnologia');
INSERT INTO categoria VALUES('2', 'Suministros');

DROP TABLE IF EXISTS cita;
CREATE TABLE `cita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(80) NOT NULL,
  `fecha_plazo` date NOT NULL,
  `saldo` decimal(12,2) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcliente` (`idcliente`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS cliente;
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documento` varchar(5) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `edad` date DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
INSERT INTO cliente VALUES('1', 'Miguel', 'Reyes sanchez', 'DNI', '77356057', 'AV. El Carmen #430', '939270636', '2002-05-09', 'A');
INSERT INTO cliente VALUES('2', 'JEFFERSON NAPOLEON', 'HUAMAN BERNILLA', 'DNI', '46544641', 'C.POBLADO UYURPAMPA', '941984109', '2000-05-09', 'A');
INSERT INTO cliente VALUES('3', 'CARLOS JOSE', 'MANAYAY CALLACA', 'DNI', '40866644', 'CALLE SANTA ROSA NRO.1453', '974345678', '', 'A');
INSERT INTO cliente VALUES('5', 'HUMBERTO', 'CASIANO BARRERA', 'DNI', '17402585', 'MZ L LT 17 P. JOVEN ERNESTO VILCHEZ ALCANTARA', '192168363', '', 'A');
INSERT INTO cliente VALUES('6', 'JUANA BAUTISTA', 'BARRIOS LUCERO', 'DNI', '40791718', 'CALLE SAN FRANCISCO DE AZIS S/N', '', '', 'A');
INSERT INTO cliente VALUES('7', 'FLOR MARIA', 'ESPINOZA BAJONERO DE YAMPUFE', 'DNI', '17433284', 'PROLONG. SUCRE MZ G LT 5 P. JOVEN ERNESTO VILCHEZ ALCANTARA', '', '', 'A');
INSERT INTO cliente VALUES('8', 'juan', 'perez', 'DNI', '837474', '', '', '', 'I');
INSERT INTO cliente VALUES('9', 'Jesus', 'Reyes Quispe', 'DNI', '0', '-', '941587943', '', 'A');
INSERT INTO cliente VALUES('10', 'JULIA TEREZA', 'SANCHEZ BERNILLA', 'DNI', '41194558', 'PROLONG. AREQUIPA MZ F LT 4 ERNESTO VILCHEZ ALCANTARA', '', '1999-05-06', 'A');
INSERT INTO cliente VALUES('11', 'JESSICA', 'MENDOZA', 'DNI', '12345678', 'LIMA', '932345674', '2024-05-06', 'A');
INSERT INTO cliente VALUES('12', 'TATIANA AMAZONA', 'MENDOZA', 'DNI', '12345677', 'TRUJILLO', '949448583', '2024-05-06', 'A');
INSERT INTO cliente VALUES('13', 'YUDIT MADALEYNE', 'AMAYA PENA', 'DNI', '48344811', 'CALLE FRANCISCO BOLOGNESI MZ I 1 LT 4', '', '2024-05-06', 'A');
INSERT INTO cliente VALUES('14', 'ELMER', 'CESPEDES PURIHUAMAN', 'DNI', '75322885', 'CALLE SAN PEDRO 360 URB MANUEL G. PRADA', '', '1999-04-29', 'A');

DROP TABLE IF EXISTS compra;
CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL DEFAULT '',
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(12,2) NOT NULL,
  `id_tpago` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idcomprobante` int(11) NOT NULL,
  PRIMARY KEY (`idcompra`),
  KEY `id_tpago` (`id_tpago`),
  KEY `idcomprobante` (`idcomprobante`),
  KEY `idproveedor` (`idproveedor`),
  CONSTRAINT `FK_compra_comprobante` FOREIGN KEY (`idcomprobante`) REFERENCES `comprobante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_compra_proveedor` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idprovee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_compra_tipo_pago` FOREIGN KEY (`id_tpago`) REFERENCES `tipo_pago` (`idpago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
INSERT INTO compra VALUES('1', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('2', 'Tinta para impresora de color cian, contenido 65ml', '4', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('3', 'Tinta para impresora de color cian, contenido 65ml', '4', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('4', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('5', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('6', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('7', 'Tinta para impresora de color cian, contenido 65ml', '1', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('9', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');
INSERT INTO compra VALUES('10', 'Tinta para impresora de color cian, contenido 65ml', '2', '45.00', '3', '1', '1');

DROP TABLE IF EXISTS comprobante;
CREATE TABLE `comprobante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
INSERT INTO comprobante VALUES('1', 'Boleta');
INSERT INTO comprobante VALUES('2', 'Factura');

DROP TABLE IF EXISTS cuenta;
CREATE TABLE `cuenta` (
  `idcuenta` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  `fecha_consumo` date NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_plazo` date DEFAULT NULL,
  `deuda` decimal(12,2) NOT NULL,
  `abono` decimal(12,2) NOT NULL,
  `saldo` decimal(12,2) NOT NULL,
  `vuelto` decimal(12,2) DEFAULT NULL,
  `idcliente` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL DEFAULT 'Cancelado',
  PRIMARY KEY (`idcuenta`),
  KEY `idcliente` (`idcliente`),
  KEY `idpago` (`idpago`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `cuenta_ibfk_2` FOREIGN KEY (`idpago`) REFERENCES `tipo_pago` (`idpago`),
  CONSTRAINT `cuenta_ibfk_3` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
INSERT INTO cuenta VALUES('1', 'Plataforma web', '2023-12-28', '2024-02-06', '', '40.00', '40.00', '0.00', '0.00', '5', '3', '5', 'Cancelado');
INSERT INTO cuenta VALUES('2', 'Plataforma web', '2024-02-28', '2024-03-07', '', '30.00', '50.00', '0.00', '20.00', '5', '3', '5', 'Cancelado');
INSERT INTO cuenta VALUES('3', 'Plataforma web', '2024-02-28', '2024-04-10', '0000-00-00', '40.00', '70.00', '0.00', '30.00', '5', '3', '1', 'Cancelado');
INSERT INTO cuenta VALUES('10', 'Plataforma web', '2024-03-28', '2024-04-09', '0000-00-00', '40.00', '50.00', '0.00', '10.00', '1', '3', '1', 'Cancelado');
INSERT INTO cuenta VALUES('11', 'Plataforma web', '2024-04-28', '2024-06-09', '0000-00-00', '35.00', '35.00', '0.00', '0.00', '6', '3', '1', 'Cancelado');
INSERT INTO cuenta VALUES('12', 'Plataforma web', '2024-04-29', '2024-05-09', '2024-05-15', '35.00', '0.00', '35.00', '0.00', '3', '5', '1', 'Pendiente');
INSERT INTO cuenta VALUES('13', 'Plataforma web', '2024-02-28', '2024-03-12', '0000-00-00', '30.00', '50.00', '0.00', '20.00', '11', '3', '1', 'Cancelado');
INSERT INTO cuenta VALUES('14', 'Plataforma web', '2024-03-28', '2024-04-10', '0000-00-00', '35.00', '35.00', '0.00', '0.00', '13', '2', '1', 'Cancelado');
INSERT INTO cuenta VALUES('15', 'Plataforma web', '2024-03-28', '2024-05-07', '0000-00-00', '35.00', '35.00', '0.00', '0.00', '5', '2', '1', 'Cancelado');
INSERT INTO cuenta VALUES('16', 'Plataforma web', '2024-04-28', '2024-05-29', '0000-00-00', '40.00', '40.00', '0.00', '0.00', '1', '3', '1', 'Cancelado');

DROP TABLE IF EXISTS departamento;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
INSERT INTO departamento VALUES('1', 'Amazonas');
INSERT INTO departamento VALUES('2', 'Áncash');
INSERT INTO departamento VALUES('3', 'Apurímac');
INSERT INTO departamento VALUES('4', 'Arequipa');
INSERT INTO departamento VALUES('5', 'Ayacucho');
INSERT INTO departamento VALUES('6', 'Cajamarca');
INSERT INTO departamento VALUES('7', 'Callao');
INSERT INTO departamento VALUES('8', 'Cusco');
INSERT INTO departamento VALUES('9', 'Huancavelica');
INSERT INTO departamento VALUES('10', 'Huánuco');
INSERT INTO departamento VALUES('11', 'Ica');
INSERT INTO departamento VALUES('12', 'Junín');
INSERT INTO departamento VALUES('13', 'La Libertad');
INSERT INTO departamento VALUES('14', 'Lambayeque');
INSERT INTO departamento VALUES('15', 'Lima');
INSERT INTO departamento VALUES('16', 'Loreto');
INSERT INTO departamento VALUES('17', 'Madre de Dios');
INSERT INTO departamento VALUES('18', 'Moquegua');
INSERT INTO departamento VALUES('19', 'Pasco');
INSERT INTO departamento VALUES('20', 'Piura');
INSERT INTO departamento VALUES('21', 'Puno');
INSERT INTO departamento VALUES('22', 'San Martín');
INSERT INTO departamento VALUES('23', 'Tacna');
INSERT INTO departamento VALUES('24', 'Tumbes');
INSERT INTO departamento VALUES('25', 'Ucayali');

DROP TABLE IF EXISTS detalle_compra;
CREATE TABLE `detalle_compra` (
  `id_dcompra` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(12,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`id_dcompra`),
  KEY `idproducto` (`idproducto`),
  KEY `idcompra` (`idcompra`),
  CONSTRAINT `FK_detalle_compra_compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_detalle_compra_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idprod`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
INSERT INTO detalle_compra VALUES('3', '45.00', '2', '90.00', '1', '1');
INSERT INTO detalle_compra VALUES('5', '45.00', '2', '90.00', '9', '2');
INSERT INTO detalle_compra VALUES('6', '45.00', '2', '90.00', '9', '2');

DROP TABLE IF EXISTS detalle_servicio;
CREATE TABLE `detalle_servicio` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `num_orden` varchar(10) NOT NULL,
  `articulo` varchar(80) NOT NULL,
  `fecha_recepcion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_reparacion` datetime NOT NULL DEFAULT current_timestamp(),
  `idcliente` int(11) NOT NULL,
  `idtipo` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `idcliente` (`idcliente`),
  KEY `idtipo` (`idtipo`),
  KEY `idservicio` (`idservicio`),
  CONSTRAINT `detalle_servicio_ibfk_1` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`),
  CONSTRAINT `detalle_servicio_ibfk_2` FOREIGN KEY (`idtipo`) REFERENCES `tipo_servicio` (`idtipo`),
  CONSTRAINT `detalle_servicio_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO detalle_servicio VALUES('1', '0001', 'Laptop', '2024-04-01 09:50:31', '2024-04-02 09:50:31', '1', '1', '3');
INSERT INTO detalle_servicio VALUES('2', '0002', 'Router', '2024-04-01 09:50:31', '2024-04-02 09:50:31', '1', '2', '4');
INSERT INTO detalle_servicio VALUES('3', '0003', 'Router', '2024-04-09 09:52:13', '2024-04-09 09:52:13', '2', '2', '5');

DROP TABLE IF EXISTS detalle_venta;
CREATE TABLE `detalle_venta` (
  `id_dventa` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(12,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `pago` decimal(12,2) NOT NULL,
  `idpago` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`id_dventa`),
  KEY `idpago` (`idpago`),
  KEY `idventa` (`idventa`),
  KEY `idproducto` (`idproducto`),
  CONSTRAINT `FK_detalle_venta_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idprod`),
  CONSTRAINT `FK_detalle_venta_tipo_pago` FOREIGN KEY (`idpago`) REFERENCES `tipo_pago` (`idpago`),
  CONSTRAINT `FK_detalle_venta_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS distrito;
CREATE TABLE `distrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_provincia` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provincia` (`id_provincia`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`),
  CONSTRAINT `distrito_ibfk_2` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250402 DEFAULT CHARSET=utf8mb4;
INSERT INTO distrito VALUES('10101', 'Chachapoyas', '101', '1');
INSERT INTO distrito VALUES('10102', 'Asunción', '101', '1');
INSERT INTO distrito VALUES('10103', 'Balsas', '101', '1');
INSERT INTO distrito VALUES('10104', 'Cheto', '101', '1');
INSERT INTO distrito VALUES('10105', 'Chiliquin', '101', '1');
INSERT INTO distrito VALUES('10106', 'Chuquibamba', '101', '1');
INSERT INTO distrito VALUES('10107', 'Granada', '101', '1');
INSERT INTO distrito VALUES('10108', 'Huancas', '101', '1');
INSERT INTO distrito VALUES('10109', 'La Jalca', '101', '1');
INSERT INTO distrito VALUES('10110', 'Leimebamba', '101', '1');
INSERT INTO distrito VALUES('10111', 'Levanto', '101', '1');
INSERT INTO distrito VALUES('10112', 'Magdalena', '101', '1');
INSERT INTO distrito VALUES('10113', 'Mariscal Castilla', '101', '1');
INSERT INTO distrito VALUES('10114', 'Molinopampa', '101', '1');
INSERT INTO distrito VALUES('10115', 'Montevideo', '101', '1');
INSERT INTO distrito VALUES('10116', 'Olleros', '101', '1');
INSERT INTO distrito VALUES('10117', 'Quinjalca', '101', '1');
INSERT INTO distrito VALUES('10118', 'San Francisco de Daguas', '101', '1');
INSERT INTO distrito VALUES('10119', 'San Isidro de Maino', '101', '1');
INSERT INTO distrito VALUES('10120', 'Soloco', '101', '1');
INSERT INTO distrito VALUES('10121', 'Sonche', '101', '1');
INSERT INTO distrito VALUES('10201', 'Bagua', '102', '1');
INSERT INTO distrito VALUES('10202', 'Aramango', '102', '1');
INSERT INTO distrito VALUES('10203', 'Copallin', '102', '1');
INSERT INTO distrito VALUES('10204', 'El Parco', '102', '1');
INSERT INTO distrito VALUES('10205', 'Imaza', '102', '1');
INSERT INTO distrito VALUES('10206', 'La Peca', '102', '1');
INSERT INTO distrito VALUES('10301', 'Jumbilla', '103', '1');
INSERT INTO distrito VALUES('10302', 'Chisquilla', '103', '1');
INSERT INTO distrito VALUES('10303', 'Churuja', '103', '1');
INSERT INTO distrito VALUES('10304', 'Corosha', '103', '1');
INSERT INTO distrito VALUES('10305', 'Cuispes', '103', '1');
INSERT INTO distrito VALUES('10306', 'Florida', '103', '1');
INSERT INTO distrito VALUES('10307', 'Jazan', '103', '1');
INSERT INTO distrito VALUES('10308', 'Recta', '103', '1');
INSERT INTO distrito VALUES('10309', 'San Carlos', '103', '1');
INSERT INTO distrito VALUES('10310', 'Shipasbamba', '103', '1');
INSERT INTO distrito VALUES('10311', 'Valera', '103', '1');
INSERT INTO distrito VALUES('10312', 'Yambrasbamba', '103', '1');
INSERT INTO distrito VALUES('10401', 'Nieva', '104', '1');
INSERT INTO distrito VALUES('10402', 'El Cenepa', '104', '1');
INSERT INTO distrito VALUES('10403', 'Río Santiago', '104', '1');
INSERT INTO distrito VALUES('10501', 'Lamud', '105', '1');
INSERT INTO distrito VALUES('10502', 'Camporredondo', '105', '1');
INSERT INTO distrito VALUES('10503', 'Cocabamba', '105', '1');
INSERT INTO distrito VALUES('10504', 'Colcamar', '105', '1');
INSERT INTO distrito VALUES('10505', 'Conila', '105', '1');
INSERT INTO distrito VALUES('10506', 'Inguilpata', '105', '1');
INSERT INTO distrito VALUES('10507', 'Longuita', '105', '1');
INSERT INTO distrito VALUES('10508', 'Lonya Chico', '105', '1');
INSERT INTO distrito VALUES('10509', 'Luya', '105', '1');
INSERT INTO distrito VALUES('10510', 'Luya Viejo', '105', '1');
INSERT INTO distrito VALUES('10511', 'María', '105', '1');
INSERT INTO distrito VALUES('10512', 'Ocalli', '105', '1');
INSERT INTO distrito VALUES('10513', 'Ocumal', '105', '1');
INSERT INTO distrito VALUES('10514', 'Pisuquia', '105', '1');
INSERT INTO distrito VALUES('10515', 'Providencia', '105', '1');
INSERT INTO distrito VALUES('10516', 'San Cristóbal', '105', '1');
INSERT INTO distrito VALUES('10517', 'San Francisco de Yeso', '105', '1');
INSERT INTO distrito VALUES('10518', 'San Jerónimo', '105', '1');
INSERT INTO distrito VALUES('10519', 'San Juan de Lopecancha', '105', '1');
INSERT INTO distrito VALUES('10520', 'Santa Catalina', '105', '1');
INSERT INTO distrito VALUES('10521', 'Santo Tomas', '105', '1');
INSERT INTO distrito VALUES('10522', 'Tingo', '105', '1');
INSERT INTO distrito VALUES('10523', 'Trita', '105', '1');
INSERT INTO distrito VALUES('10601', 'San Nicolás', '106', '1');
INSERT INTO distrito VALUES('10602', 'Chirimoto', '106', '1');
INSERT INTO distrito VALUES('10603', 'Cochamal', '106', '1');
INSERT INTO distrito VALUES('10604', 'Huambo', '106', '1');
INSERT INTO distrito VALUES('10605', 'Limabamba', '106', '1');
INSERT INTO distrito VALUES('10606', 'Longar', '106', '1');
INSERT INTO distrito VALUES('10607', 'Mariscal Benavides', '106', '1');
INSERT INTO distrito VALUES('10608', 'Milpuc', '106', '1');
INSERT INTO distrito VALUES('10609', 'Omia', '106', '1');
INSERT INTO distrito VALUES('10610', 'Santa Rosa', '106', '1');
INSERT INTO distrito VALUES('10611', 'Totora', '106', '1');
INSERT INTO distrito VALUES('10612', 'Vista Alegre', '106', '1');
INSERT INTO distrito VALUES('10701', 'Bagua Grande', '107', '1');
INSERT INTO distrito VALUES('10702', 'Cajaruro', '107', '1');
INSERT INTO distrito VALUES('10703', 'Cumba', '107', '1');
INSERT INTO distrito VALUES('10704', 'El Milagro', '107', '1');
INSERT INTO distrito VALUES('10705', 'Jamalca', '107', '1');
INSERT INTO distrito VALUES('10706', 'Lonya Grande', '107', '1');
INSERT INTO distrito VALUES('10707', 'Yamon', '107', '1');
INSERT INTO distrito VALUES('20101', 'Huaraz', '201', '2');
INSERT INTO distrito VALUES('20102', 'Cochabamba', '201', '2');
INSERT INTO distrito VALUES('20103', 'Colcabamba', '201', '2');
INSERT INTO distrito VALUES('20104', 'Huanchay', '201', '2');
INSERT INTO distrito VALUES('20105', 'Independencia', '201', '2');
INSERT INTO distrito VALUES('20106', 'Jangas', '201', '2');
INSERT INTO distrito VALUES('20107', 'La Libertad', '201', '2');
INSERT INTO distrito VALUES('20108', 'Olleros', '201', '2');
INSERT INTO distrito VALUES('20109', 'Pampas Grande', '201', '2');
INSERT INTO distrito VALUES('20110', 'Pariacoto', '201', '2');
INSERT INTO distrito VALUES('20111', 'Pira', '201', '2');
INSERT INTO distrito VALUES('20112', 'Tarica', '201', '2');
INSERT INTO distrito VALUES('20201', 'Aija', '202', '2');
INSERT INTO distrito VALUES('20202', 'Coris', '202', '2');
INSERT INTO distrito VALUES('20203', 'Huacllan', '202', '2');
INSERT INTO distrito VALUES('20204', 'La Merced', '202', '2');
INSERT INTO distrito VALUES('20205', 'Succha', '202', '2');
INSERT INTO distrito VALUES('20301', 'Llamellin', '203', '2');
INSERT INTO distrito VALUES('20302', 'Aczo', '203', '2');
INSERT INTO distrito VALUES('20303', 'Chaccho', '203', '2');
INSERT INTO distrito VALUES('20304', 'Chingas', '203', '2');
INSERT INTO distrito VALUES('20305', 'Mirgas', '203', '2');
INSERT INTO distrito VALUES('20306', 'San Juan de Rontoy', '203', '2');
INSERT INTO distrito VALUES('20401', 'Chacas', '204', '2');
INSERT INTO distrito VALUES('20402', 'Acochaca', '204', '2');
INSERT INTO distrito VALUES('20501', 'Chiquian', '205', '2');
INSERT INTO distrito VALUES('20502', 'Abelardo Pardo Lezameta', '205', '2');
INSERT INTO distrito VALUES('20503', 'Antonio Raymondi', '205', '2');
INSERT INTO distrito VALUES('20504', 'Aquia', '205', '2');
INSERT INTO distrito VALUES('20505', 'Cajacay', '205', '2');
INSERT INTO distrito VALUES('20506', 'Canis', '205', '2');
INSERT INTO distrito VALUES('20507', 'Colquioc', '205', '2');
INSERT INTO distrito VALUES('20508', 'Huallanca', '205', '2');
INSERT INTO distrito VALUES('20509', 'Huasta', '205', '2');
INSERT INTO distrito VALUES('20510', 'Huayllacayan', '205', '2');
INSERT INTO distrito VALUES('20511', 'La Primavera', '205', '2');
INSERT INTO distrito VALUES('20512', 'Mangas', '205', '2');
INSERT INTO distrito VALUES('20513', 'Pacllon', '205', '2');
INSERT INTO distrito VALUES('20514', 'San Miguel de Corpanqui', '205', '2');
INSERT INTO distrito VALUES('20515', 'Ticllos', '205', '2');
INSERT INTO distrito VALUES('20601', 'Carhuaz', '206', '2');
INSERT INTO distrito VALUES('20602', 'Acopampa', '206', '2');
INSERT INTO distrito VALUES('20603', 'Amashca', '206', '2');
INSERT INTO distrito VALUES('20604', 'Anta', '206', '2');
INSERT INTO distrito VALUES('20605', 'Ataquero', '206', '2');
INSERT INTO distrito VALUES('20606', 'Marcara', '206', '2');
INSERT INTO distrito VALUES('20607', 'Pariahuanca', '206', '2');
INSERT INTO distrito VALUES('20608', 'San Miguel de Aco', '206', '2');
INSERT INTO distrito VALUES('20609', 'Shilla', '206', '2');
INSERT INTO distrito VALUES('20610', 'Tinco', '206', '2');
INSERT INTO distrito VALUES('20611', 'Yungar', '206', '2');
INSERT INTO distrito VALUES('20701', 'San Luis', '207', '2');
INSERT INTO distrito VALUES('20702', 'San Nicolás', '207', '2');
INSERT INTO distrito VALUES('20703', 'Yauya', '207', '2');
INSERT INTO distrito VALUES('20801', 'Casma', '208', '2');
INSERT INTO distrito VALUES('20802', 'Buena Vista Alta', '208', '2');
INSERT INTO distrito VALUES('20803', 'Comandante Noel', '208', '2');
INSERT INTO distrito VALUES('20804', 'Yautan', '208', '2');
INSERT INTO distrito VALUES('20901', 'Corongo', '209', '2');
INSERT INTO distrito VALUES('20902', 'Aco', '209', '2');
INSERT INTO distrito VALUES('20903', 'Bambas', '209', '2');
INSERT INTO distrito VALUES('20904', 'Cusca', '209', '2');
INSERT INTO distrito VALUES('20905', 'La Pampa', '209', '2');
INSERT INTO distrito VALUES('20906', 'Yanac', '209', '2');
INSERT INTO distrito VALUES('20907', 'Yupan', '209', '2');
INSERT INTO distrito VALUES('21001', 'Huari', '210', '2');
INSERT INTO distrito VALUES('21002', 'Anra', '210', '2');
INSERT INTO distrito VALUES('21003', 'Cajay', '210', '2');
INSERT INTO distrito VALUES('21004', 'Chavin de Huantar', '210', '2');
INSERT INTO distrito VALUES('21005', 'Huacachi', '210', '2');
INSERT INTO distrito VALUES('21006', 'Huacchis', '210', '2');
INSERT INTO distrito VALUES('21007', 'Huachis', '210', '2');
INSERT INTO distrito VALUES('21008', 'Huantar', '210', '2');
INSERT INTO distrito VALUES('21009', 'Masin', '210', '2');
INSERT INTO distrito VALUES('21010', 'Paucas', '210', '2');
INSERT INTO distrito VALUES('21011', 'Ponto', '210', '2');
INSERT INTO distrito VALUES('21012', 'Rahuapampa', '210', '2');
INSERT INTO distrito VALUES('21013', 'Rapayan', '210', '2');
INSERT INTO distrito VALUES('21014', 'San Marcos', '210', '2');
INSERT INTO distrito VALUES('21015', 'San Pedro de Chana', '210', '2');
INSERT INTO distrito VALUES('21016', 'Uco', '210', '2');
INSERT INTO distrito VALUES('21101', 'Huarmey', '211', '2');
INSERT INTO distrito VALUES('21102', 'Cochapeti', '211', '2');
INSERT INTO distrito VALUES('21103', 'Culebras', '211', '2');
INSERT INTO distrito VALUES('21104', 'Huayan', '211', '2');
INSERT INTO distrito VALUES('21105', 'Malvas', '211', '2');
INSERT INTO distrito VALUES('21201', 'Caraz', '212', '2');
INSERT INTO distrito VALUES('21202', 'Huallanca', '212', '2');
INSERT INTO distrito VALUES('21203', 'Huata', '212', '2');
INSERT INTO distrito VALUES('21204', 'Huaylas', '212', '2');
INSERT INTO distrito VALUES('21205', 'Mato', '212', '2');
INSERT INTO distrito VALUES('21206', 'Pamparomas', '212', '2');
INSERT INTO distrito VALUES('21207', 'Pueblo Libre', '212', '2');
INSERT INTO distrito VALUES('21208', 'Santa Cruz', '212', '2');
INSERT INTO distrito VALUES('21209', 'Santo Toribio', '212', '2');
INSERT INTO distrito VALUES('21210', 'Yuracmarca', '212', '2');
INSERT INTO distrito VALUES('21301', 'Piscobamba', '213', '2');
INSERT INTO distrito VALUES('21302', 'Casca', '213', '2');
INSERT INTO distrito VALUES('21303', 'Eleazar Guzmán Barron', '213', '2');
INSERT INTO distrito VALUES('21304', 'Fidel Olivas Escudero', '213', '2');
INSERT INTO distrito VALUES('21305', 'Llama', '213', '2');
INSERT INTO distrito VALUES('21306', 'Llumpa', '213', '2');
INSERT INTO distrito VALUES('21307', 'Lucma', '213', '2');
INSERT INTO distrito VALUES('21308', 'Musga', '213', '2');
INSERT INTO distrito VALUES('21401', 'Ocros', '214', '2');
INSERT INTO distrito VALUES('21402', 'Acas', '214', '2');
INSERT INTO distrito VALUES('21403', 'Cajamarquilla', '214', '2');
INSERT INTO distrito VALUES('21404', 'Carhuapampa', '214', '2');
INSERT INTO distrito VALUES('21405', 'Cochas', '214', '2');
INSERT INTO distrito VALUES('21406', 'Congas', '214', '2');
INSERT INTO distrito VALUES('21407', 'Llipa', '214', '2');
INSERT INTO distrito VALUES('21408', 'San Cristóbal de Rajan', '214', '2');
INSERT INTO distrito VALUES('21409', 'San Pedro', '214', '2');
INSERT INTO distrito VALUES('21410', 'Santiago de Chilcas', '214', '2');
INSERT INTO distrito VALUES('21501', 'Cabana', '215', '2');
INSERT INTO distrito VALUES('21502', 'Bolognesi', '215', '2');
INSERT INTO distrito VALUES('21503', 'Conchucos', '215', '2');
INSERT INTO distrito VALUES('21504', 'Huacaschuque', '215', '2');
INSERT INTO distrito VALUES('21505', 'Huandoval', '215', '2');
INSERT INTO distrito VALUES('21506', 'Lacabamba', '215', '2');
INSERT INTO distrito VALUES('21507', 'Llapo', '215', '2');
INSERT INTO distrito VALUES('21508', 'Pallasca', '215', '2');
INSERT INTO distrito VALUES('21509', 'Pampas', '215', '2');
INSERT INTO distrito VALUES('21510', 'Santa Rosa', '215', '2');
INSERT INTO distrito VALUES('21511', 'Tauca', '215', '2');
INSERT INTO distrito VALUES('21601', 'Pomabamba', '216', '2');
INSERT INTO distrito VALUES('21602', 'Huayllan', '216', '2');
INSERT INTO distrito VALUES('21603', 'Parobamba', '216', '2');
INSERT INTO distrito VALUES('21604', 'Quinuabamba', '216', '2');
INSERT INTO distrito VALUES('21701', 'Recuay', '217', '2');
INSERT INTO distrito VALUES('21702', 'Catac', '217', '2');
INSERT INTO distrito VALUES('21703', 'Cotaparaco', '217', '2');
INSERT INTO distrito VALUES('21704', 'Huayllapampa', '217', '2');
INSERT INTO distrito VALUES('21705', 'Llacllin', '217', '2');
INSERT INTO distrito VALUES('21706', 'Marca', '217', '2');
INSERT INTO distrito VALUES('21707', 'Pampas Chico', '217', '2');
INSERT INTO distrito VALUES('21708', 'Pararin', '217', '2');
INSERT INTO distrito VALUES('21709', 'Tapacocha', '217', '2');
INSERT INTO distrito VALUES('21710', 'Ticapampa', '217', '2');
INSERT INTO distrito VALUES('21801', 'Chimbote', '218', '2');
INSERT INTO distrito VALUES('21802', 'Cáceres del Perú', '218', '2');
INSERT INTO distrito VALUES('21803', 'Coishco', '218', '2');
INSERT INTO distrito VALUES('21804', 'Macate', '218', '2');
INSERT INTO distrito VALUES('21805', 'Moro', '218', '2');
INSERT INTO distrito VALUES('21806', 'Nepeña', '218', '2');
INSERT INTO distrito VALUES('21807', 'Samanco', '218', '2');
INSERT INTO distrito VALUES('21808', 'Santa', '218', '2');
INSERT INTO distrito VALUES('21809', 'Nuevo Chimbote', '218', '2');
INSERT INTO distrito VALUES('21901', 'Sihuas', '219', '2');
INSERT INTO distrito VALUES('21902', 'Acobamba', '219', '2');
INSERT INTO distrito VALUES('21903', 'Alfonso Ugarte', '219', '2');
INSERT INTO distrito VALUES('21904', 'Cashapampa', '219', '2');
INSERT INTO distrito VALUES('21905', 'Chingalpo', '219', '2');
INSERT INTO distrito VALUES('21906', 'Huayllabamba', '219', '2');
INSERT INTO distrito VALUES('21907', 'Quiches', '219', '2');
INSERT INTO distrito VALUES('21908', 'Ragash', '219', '2');
INSERT INTO distrito VALUES('21909', 'San Juan', '219', '2');
INSERT INTO distrito VALUES('21910', 'Sicsibamba', '219', '2');
INSERT INTO distrito VALUES('22001', 'Yungay', '220', '2');
INSERT INTO distrito VALUES('22002', 'Cascapara', '220', '2');
INSERT INTO distrito VALUES('22003', 'Mancos', '220', '2');
INSERT INTO distrito VALUES('22004', 'Matacoto', '220', '2');
INSERT INTO distrito VALUES('22005', 'Quillo', '220', '2');
INSERT INTO distrito VALUES('22006', 'Ranrahirca', '220', '2');
INSERT INTO distrito VALUES('22007', 'Shupluy', '220', '2');
INSERT INTO distrito VALUES('22008', 'Yanama', '220', '2');
INSERT INTO distrito VALUES('30101', 'Abancay', '301', '3');
INSERT INTO distrito VALUES('30102', 'Chacoche', '301', '3');
INSERT INTO distrito VALUES('30103', 'Circa', '301', '3');
INSERT INTO distrito VALUES('30104', 'Curahuasi', '301', '3');
INSERT INTO distrito VALUES('30105', 'Huanipaca', '301', '3');
INSERT INTO distrito VALUES('30106', 'Lambrama', '301', '3');
INSERT INTO distrito VALUES('30107', 'Pichirhua', '301', '3');
INSERT INTO distrito VALUES('30108', 'San Pedro de Cachora', '301', '3');
INSERT INTO distrito VALUES('30109', 'Tamburco', '301', '3');
INSERT INTO distrito VALUES('30201', 'Andahuaylas', '302', '3');
INSERT INTO distrito VALUES('30202', 'Andarapa', '302', '3');
INSERT INTO distrito VALUES('30203', 'Chiara', '302', '3');
INSERT INTO distrito VALUES('30204', 'Huancarama', '302', '3');
INSERT INTO distrito VALUES('30205', 'Huancaray', '302', '3');
INSERT INTO distrito VALUES('30206', 'Huayana', '302', '3');
INSERT INTO distrito VALUES('30207', 'Kishuara', '302', '3');
INSERT INTO distrito VALUES('30208', 'Pacobamba', '302', '3');
INSERT INTO distrito VALUES('30209', 'Pacucha', '302', '3');
INSERT INTO distrito VALUES('30210', 'Pampachiri', '302', '3');
INSERT INTO distrito VALUES('30211', 'Pomacocha', '302', '3');
INSERT INTO distrito VALUES('30212', 'San Antonio de Cachi', '302', '3');
INSERT INTO distrito VALUES('30213', 'San Jerónimo', '302', '3');
INSERT INTO distrito VALUES('30214', 'San Miguel de Chaccrampa', '302', '3');
INSERT INTO distrito VALUES('30215', 'Santa María de Chicmo', '302', '3');
INSERT INTO distrito VALUES('30216', 'Talavera', '302', '3');
INSERT INTO distrito VALUES('30217', 'Tumay Huaraca', '302', '3');
INSERT INTO distrito VALUES('30218', 'Turpo', '302', '3');
INSERT INTO distrito VALUES('30219', 'Kaquiabamba', '302', '3');
INSERT INTO distrito VALUES('30220', 'José María Arguedas', '302', '3');
INSERT INTO distrito VALUES('30301', 'Antabamba', '303', '3');
INSERT INTO distrito VALUES('30302', 'El Oro', '303', '3');
INSERT INTO distrito VALUES('30303', 'Huaquirca', '303', '3');
INSERT INTO distrito VALUES('30304', 'Juan Espinoza Medrano', '303', '3');
INSERT INTO distrito VALUES('30305', 'Oropesa', '303', '3');
INSERT INTO distrito VALUES('30306', 'Pachaconas', '303', '3');
INSERT INTO distrito VALUES('30307', 'Sabaino', '303', '3');
INSERT INTO distrito VALUES('30401', 'Chalhuanca', '304', '3');
INSERT INTO distrito VALUES('30402', 'Capaya', '304', '3');
INSERT INTO distrito VALUES('30403', 'Caraybamba', '304', '3');
INSERT INTO distrito VALUES('30404', 'Chapimarca', '304', '3');
INSERT INTO distrito VALUES('30405', 'Colcabamba', '304', '3');
INSERT INTO distrito VALUES('30406', 'Cotaruse', '304', '3');
INSERT INTO distrito VALUES('30407', 'Ihuayllo', '304', '3');
INSERT INTO distrito VALUES('30408', 'Justo Apu Sahuaraura', '304', '3');
INSERT INTO distrito VALUES('30409', 'Lucre', '304', '3');
INSERT INTO distrito VALUES('30410', 'Pocohuanca', '304', '3');
INSERT INTO distrito VALUES('30411', 'San Juan de Chacña', '304', '3');
INSERT INTO distrito VALUES('30412', 'Sañayca', '304', '3');
INSERT INTO distrito VALUES('30413', 'Soraya', '304', '3');
INSERT INTO distrito VALUES('30414', 'Tapairihua', '304', '3');
INSERT INTO distrito VALUES('30415', 'Tintay', '304', '3');
INSERT INTO distrito VALUES('30416', 'Toraya', '304', '3');
INSERT INTO distrito VALUES('30417', 'Yanaca', '304', '3');
INSERT INTO distrito VALUES('30501', 'Tambobamba', '305', '3');
INSERT INTO distrito VALUES('30502', 'Cotabambas', '305', '3');
INSERT INTO distrito VALUES('30503', 'Coyllurqui', '305', '3');
INSERT INTO distrito VALUES('30504', 'Haquira', '305', '3');
INSERT INTO distrito VALUES('30505', 'Mara', '305', '3');
INSERT INTO distrito VALUES('30506', 'Challhuahuacho', '305', '3');
INSERT INTO distrito VALUES('30601', 'Chincheros', '306', '3');
INSERT INTO distrito VALUES('30602', 'Anco_Huallo', '306', '3');
INSERT INTO distrito VALUES('30603', 'Cocharcas', '306', '3');
INSERT INTO distrito VALUES('30604', 'Huaccana', '306', '3');
INSERT INTO distrito VALUES('30605', 'Ocobamba', '306', '3');
INSERT INTO distrito VALUES('30606', 'Ongoy', '306', '3');
INSERT INTO distrito VALUES('30607', 'Uranmarca', '306', '3');
INSERT INTO distrito VALUES('30608', 'Ranracancha', '306', '3');
INSERT INTO distrito VALUES('30609', 'Rocchacc', '306', '3');
INSERT INTO distrito VALUES('30610', 'El Porvenir', '306', '3');
INSERT INTO distrito VALUES('30611', 'Los Chankas', '306', '3');
INSERT INTO distrito VALUES('30701', 'Chuquibambilla', '307', '3');
INSERT INTO distrito VALUES('30702', 'Curpahuasi', '307', '3');
INSERT INTO distrito VALUES('30703', 'Gamarra', '307', '3');
INSERT INTO distrito VALUES('30704', 'Huayllati', '307', '3');
INSERT INTO distrito VALUES('30705', 'Mamara', '307', '3');
INSERT INTO distrito VALUES('30706', 'Micaela Bastidas', '307', '3');
INSERT INTO distrito VALUES('30707', 'Pataypampa', '307', '3');
INSERT INTO distrito VALUES('30708', 'Progreso', '307', '3');
INSERT INTO distrito VALUES('30709', 'San Antonio', '307', '3');
INSERT INTO distrito VALUES('30710', 'Santa Rosa', '307', '3');
INSERT INTO distrito VALUES('30711', 'Turpay', '307', '3');
INSERT INTO distrito VALUES('30712', 'Vilcabamba', '307', '3');
INSERT INTO distrito VALUES('30713', 'Virundo', '307', '3');
INSERT INTO distrito VALUES('30714', 'Curasco', '307', '3');
INSERT INTO distrito VALUES('40101', 'Arequipa', '401', '4');
INSERT INTO distrito VALUES('40102', 'Alto Selva Alegre', '401', '4');
INSERT INTO distrito VALUES('40103', 'Cayma', '401', '4');
INSERT INTO distrito VALUES('40104', 'Cerro Colorado', '401', '4');
INSERT INTO distrito VALUES('40105', 'Characato', '401', '4');
INSERT INTO distrito VALUES('40106', 'Chiguata', '401', '4');
INSERT INTO distrito VALUES('40107', 'Jacobo Hunter', '401', '4');
INSERT INTO distrito VALUES('40108', 'La Joya', '401', '4');
INSERT INTO distrito VALUES('40109', 'Mariano Melgar', '401', '4');
INSERT INTO distrito VALUES('40110', 'Miraflores', '401', '4');
INSERT INTO distrito VALUES('40111', 'Mollebaya', '401', '4');
INSERT INTO distrito VALUES('40112', 'Paucarpata', '401', '4');
INSERT INTO distrito VALUES('40113', 'Pocsi', '401', '4');
INSERT INTO distrito VALUES('40114', 'Polobaya', '401', '4');
INSERT INTO distrito VALUES('40115', 'Quequeña', '401', '4');
INSERT INTO distrito VALUES('40116', 'Sabandia', '401', '4');
INSERT INTO distrito VALUES('40117', 'Sachaca', '401', '4');
INSERT INTO distrito VALUES('40118', 'San Juan de Siguas', '401', '4');
INSERT INTO distrito VALUES('40119', 'San Juan de Tarucani', '401', '4');
INSERT INTO distrito VALUES('40120', 'Santa Isabel de Siguas', '401', '4');
INSERT INTO distrito VALUES('40121', 'Santa Rita de Siguas', '401', '4');
INSERT INTO distrito VALUES('40122', 'Socabaya', '401', '4');
INSERT INTO distrito VALUES('40123', 'Tiabaya', '401', '4');
INSERT INTO distrito VALUES('40124', 'Uchumayo', '401', '4');
INSERT INTO distrito VALUES('40125', 'Vitor', '401', '4');
INSERT INTO distrito VALUES('40126', 'Yanahuara', '401', '4');
INSERT INTO distrito VALUES('40127', 'Yarabamba', '401', '4');
INSERT INTO distrito VALUES('40128', 'Yura', '401', '4');
INSERT INTO distrito VALUES('40129', 'José Luis Bustamante Y Rivero', '401', '4');
INSERT INTO distrito VALUES('40201', 'Camaná', '402', '4');
INSERT INTO distrito VALUES('40202', 'José María Quimper', '402', '4');
INSERT INTO distrito VALUES('40203', 'Mariano Nicolás Valcárcel', '402', '4');
INSERT INTO distrito VALUES('40204', 'Mariscal Cáceres', '402', '4');
INSERT INTO distrito VALUES('40205', 'Nicolás de Pierola', '402', '4');
INSERT INTO distrito VALUES('40206', 'Ocoña', '402', '4');
INSERT INTO distrito VALUES('40207', 'Quilca', '402', '4');
INSERT INTO distrito VALUES('40208', 'Samuel Pastor', '402', '4');
INSERT INTO distrito VALUES('40301', 'Caravelí', '403', '4');
INSERT INTO distrito VALUES('40302', 'Acarí', '403', '4');
INSERT INTO distrito VALUES('40303', 'Atico', '403', '4');
INSERT INTO distrito VALUES('40304', 'Atiquipa', '403', '4');
INSERT INTO distrito VALUES('40305', 'Bella Unión', '403', '4');
INSERT INTO distrito VALUES('40306', 'Cahuacho', '403', '4');
INSERT INTO distrito VALUES('40307', 'Chala', '403', '4');
INSERT INTO distrito VALUES('40308', 'Chaparra', '403', '4');
INSERT INTO distrito VALUES('40309', 'Huanuhuanu', '403', '4');
INSERT INTO distrito VALUES('40310', 'Jaqui', '403', '4');
INSERT INTO distrito VALUES('40311', 'Lomas', '403', '4');
INSERT INTO distrito VALUES('40312', 'Quicacha', '403', '4');
INSERT INTO distrito VALUES('40313', 'Yauca', '403', '4');
INSERT INTO distrito VALUES('40401', 'Aplao', '404', '4');
INSERT INTO distrito VALUES('40402', 'Andagua', '404', '4');
INSERT INTO distrito VALUES('40403', 'Ayo', '404', '4');
INSERT INTO distrito VALUES('40404', 'Chachas', '404', '4');
INSERT INTO distrito VALUES('40405', 'Chilcaymarca', '404', '4');
INSERT INTO distrito VALUES('40406', 'Choco', '404', '4');
INSERT INTO distrito VALUES('40407', 'Huancarqui', '404', '4');
INSERT INTO distrito VALUES('40408', 'Machaguay', '404', '4');
INSERT INTO distrito VALUES('40409', 'Orcopampa', '404', '4');
INSERT INTO distrito VALUES('40410', 'Pampacolca', '404', '4');
INSERT INTO distrito VALUES('40411', 'Tipan', '404', '4');
INSERT INTO distrito VALUES('40412', 'Uñon', '404', '4');
INSERT INTO distrito VALUES('40413', 'Uraca', '404', '4');
INSERT INTO distrito VALUES('40414', 'Viraco', '404', '4');
INSERT INTO distrito VALUES('40501', 'Chivay', '405', '4');
INSERT INTO distrito VALUES('40502', 'Achoma', '405', '4');
INSERT INTO distrito VALUES('40503', 'Cabanaconde', '405', '4');
INSERT INTO distrito VALUES('40504', 'Callalli', '405', '4');
INSERT INTO distrito VALUES('40505', 'Caylloma', '405', '4');
INSERT INTO distrito VALUES('40506', 'Coporaque', '405', '4');
INSERT INTO distrito VALUES('40507', 'Huambo', '405', '4');
INSERT INTO distrito VALUES('40508', 'Huanca', '405', '4');
INSERT INTO distrito VALUES('40509', 'Ichupampa', '405', '4');
INSERT INTO distrito VALUES('40510', 'Lari', '405', '4');
INSERT INTO distrito VALUES('40511', 'Lluta', '405', '4');
INSERT INTO distrito VALUES('40512', 'Maca', '405', '4');
INSERT INTO distrito VALUES('40513', 'Madrigal', '405', '4');
INSERT INTO distrito VALUES('40514', 'San Antonio de Chuca', '405', '4');
INSERT INTO distrito VALUES('40515', 'Sibayo', '405', '4');
INSERT INTO distrito VALUES('40516', 'Tapay', '405', '4');
INSERT INTO distrito VALUES('40517', 'Tisco', '405', '4');
INSERT INTO distrito VALUES('40518', 'Tuti', '405', '4');
INSERT INTO distrito VALUES('40519', 'Yanque', '405', '4');
INSERT INTO distrito VALUES('40520', 'Majes', '405', '4');
INSERT INTO distrito VALUES('40601', 'Chuquibamba', '406', '4');
INSERT INTO distrito VALUES('40602', 'Andaray', '406', '4');
INSERT INTO distrito VALUES('40603', 'Cayarani', '406', '4');
INSERT INTO distrito VALUES('40604', 'Chichas', '406', '4');
INSERT INTO distrito VALUES('40605', 'Iray', '406', '4');
INSERT INTO distrito VALUES('40606', 'Río Grande', '406', '4');
INSERT INTO distrito VALUES('40607', 'Salamanca', '406', '4');
INSERT INTO distrito VALUES('40608', 'Yanaquihua', '406', '4');
INSERT INTO distrito VALUES('40701', 'Mollendo', '407', '4');
INSERT INTO distrito VALUES('40702', 'Cocachacra', '407', '4');
INSERT INTO distrito VALUES('40703', 'Dean Valdivia', '407', '4');
INSERT INTO distrito VALUES('40704', 'Islay', '407', '4');
INSERT INTO distrito VALUES('40705', 'Mejia', '407', '4');
INSERT INTO distrito VALUES('40706', 'Punta de Bombón', '407', '4');
INSERT INTO distrito VALUES('40801', 'Cotahuasi', '408', '4');
INSERT INTO distrito VALUES('40802', 'Alca', '408', '4');
INSERT INTO distrito VALUES('40803', 'Charcana', '408', '4');
INSERT INTO distrito VALUES('40804', 'Huaynacotas', '408', '4');
INSERT INTO distrito VALUES('40805', 'Pampamarca', '408', '4');
INSERT INTO distrito VALUES('40806', 'Puyca', '408', '4');
INSERT INTO distrito VALUES('40807', 'Quechualla', '408', '4');
INSERT INTO distrito VALUES('40808', 'Sayla', '408', '4');
INSERT INTO distrito VALUES('40809', 'Tauria', '408', '4');
INSERT INTO distrito VALUES('40810', 'Tomepampa', '408', '4');
INSERT INTO distrito VALUES('40811', 'Toro', '408', '4');
INSERT INTO distrito VALUES('50101', 'Ayacucho', '501', '5');
INSERT INTO distrito VALUES('50102', 'Acocro', '501', '5');
INSERT INTO distrito VALUES('50103', 'Acos Vinchos', '501', '5');
INSERT INTO distrito VALUES('50104', 'Carmen Alto', '501', '5');
INSERT INTO distrito VALUES('50105', 'Chiara', '501', '5');
INSERT INTO distrito VALUES('50106', 'Ocros', '501', '5');
INSERT INTO distrito VALUES('50107', 'Pacaycasa', '501', '5');
INSERT INTO distrito VALUES('50108', 'Quinua', '501', '5');
INSERT INTO distrito VALUES('50109', 'San José de Ticllas', '501', '5');
INSERT INTO distrito VALUES('50110', 'San Juan Bautista', '501', '5');
INSERT INTO distrito VALUES('50111', 'Santiago de Pischa', '501', '5');
INSERT INTO distrito VALUES('50112', 'Socos', '501', '5');
INSERT INTO distrito VALUES('50113', 'Tambillo', '501', '5');
INSERT INTO distrito VALUES('50114', 'Vinchos', '501', '5');
INSERT INTO distrito VALUES('50115', 'Jesús Nazareno', '501', '5');
INSERT INTO distrito VALUES('50116', 'Andrés Avelino Cáceres Dorregaray', '501', '5');
INSERT INTO distrito VALUES('50201', 'Cangallo', '502', '5');
INSERT INTO distrito VALUES('50202', 'Chuschi', '502', '5');
INSERT INTO distrito VALUES('50203', 'Los Morochucos', '502', '5');
INSERT INTO distrito VALUES('50204', 'María Parado de Bellido', '502', '5');
INSERT INTO distrito VALUES('50205', 'Paras', '502', '5');
INSERT INTO distrito VALUES('50206', 'Totos', '502', '5');
INSERT INTO distrito VALUES('50301', 'Sancos', '503', '5');
INSERT INTO distrito VALUES('50302', 'Carapo', '503', '5');
INSERT INTO distrito VALUES('50303', 'Sacsamarca', '503', '5');
INSERT INTO distrito VALUES('50304', 'Santiago de Lucanamarca', '503', '5');
INSERT INTO distrito VALUES('50401', 'Huanta', '504', '5');
INSERT INTO distrito VALUES('50402', 'Ayahuanco', '504', '5');
INSERT INTO distrito VALUES('50403', 'Huamanguilla', '504', '5');
INSERT INTO distrito VALUES('50404', 'Iguain', '504', '5');
INSERT INTO distrito VALUES('50405', 'Luricocha', '504', '5');
INSERT INTO distrito VALUES('50406', 'Santillana', '504', '5');
INSERT INTO distrito VALUES('50407', 'Sivia', '504', '5');
INSERT INTO distrito VALUES('50408', 'Llochegua', '504', '5');
INSERT INTO distrito VALUES('50409', 'Canayre', '504', '5');
INSERT INTO distrito VALUES('50410', 'Uchuraccay', '504', '5');
INSERT INTO distrito VALUES('50411', 'Pucacolpa', '504', '5');
INSERT INTO distrito VALUES('50412', 'Chaca', '504', '5');
INSERT INTO distrito VALUES('50501', 'San Miguel', '505', '5');
INSERT INTO distrito VALUES('50502', 'Anco', '505', '5');
INSERT INTO distrito VALUES('50503', 'Ayna', '505', '5');
INSERT INTO distrito VALUES('50504', 'Chilcas', '505', '5');
INSERT INTO distrito VALUES('50505', 'Chungui', '505', '5');
INSERT INTO distrito VALUES('50506', 'Luis Carranza', '505', '5');
INSERT INTO distrito VALUES('50507', 'Santa Rosa', '505', '5');
INSERT INTO distrito VALUES('50508', 'Tambo', '505', '5');
INSERT INTO distrito VALUES('50509', 'Samugari', '505', '5');
INSERT INTO distrito VALUES('50510', 'Anchihuay', '505', '5');
INSERT INTO distrito VALUES('50511', 'Oronccoy', '505', '5');
INSERT INTO distrito VALUES('50601', 'Puquio', '506', '5');
INSERT INTO distrito VALUES('50602', 'Aucara', '506', '5');
INSERT INTO distrito VALUES('50603', 'Cabana', '506', '5');
INSERT INTO distrito VALUES('50604', 'Carmen Salcedo', '506', '5');
INSERT INTO distrito VALUES('50605', 'Chaviña', '506', '5');
INSERT INTO distrito VALUES('50606', 'Chipao', '506', '5');
INSERT INTO distrito VALUES('50607', 'Huac-Huas', '506', '5');
INSERT INTO distrito VALUES('50608', 'Laramate', '506', '5');
INSERT INTO distrito VALUES('50609', 'Leoncio Prado', '506', '5');
INSERT INTO distrito VALUES('50610', 'Llauta', '506', '5');
INSERT INTO distrito VALUES('50611', 'Lucanas', '506', '5');
INSERT INTO distrito VALUES('50612', 'Ocaña', '506', '5');
INSERT INTO distrito VALUES('50613', 'Otoca', '506', '5');
INSERT INTO distrito VALUES('50614', 'Saisa', '506', '5');
INSERT INTO distrito VALUES('50615', 'San Cristóbal', '506', '5');
INSERT INTO distrito VALUES('50616', 'San Juan', '506', '5');
INSERT INTO distrito VALUES('50617', 'San Pedro', '506', '5');
INSERT INTO distrito VALUES('50618', 'San Pedro de Palco', '506', '5');
INSERT INTO distrito VALUES('50619', 'Sancos', '506', '5');
INSERT INTO distrito VALUES('50620', 'Santa Ana de Huaycahuacho', '506', '5');
INSERT INTO distrito VALUES('50621', 'Santa Lucia', '506', '5');
INSERT INTO distrito VALUES('50701', 'Coracora', '507', '5');
INSERT INTO distrito VALUES('50702', 'Chumpi', '507', '5');
INSERT INTO distrito VALUES('50703', 'Coronel Castañeda', '507', '5');
INSERT INTO distrito VALUES('50704', 'Pacapausa', '507', '5');
INSERT INTO distrito VALUES('50705', 'Pullo', '507', '5');
INSERT INTO distrito VALUES('50706', 'Puyusca', '507', '5');
INSERT INTO distrito VALUES('50707', 'San Francisco de Ravacayco', '507', '5');
INSERT INTO distrito VALUES('50708', 'Upahuacho', '507', '5');
INSERT INTO distrito VALUES('50801', 'Pausa', '508', '5');
INSERT INTO distrito VALUES('50802', 'Colta', '508', '5');
INSERT INTO distrito VALUES('50803', 'Corculla', '508', '5');
INSERT INTO distrito VALUES('50804', 'Lampa', '508', '5');
INSERT INTO distrito VALUES('50805', 'Marcabamba', '508', '5');
INSERT INTO distrito VALUES('50806', 'Oyolo', '508', '5');
INSERT INTO distrito VALUES('50807', 'Pararca', '508', '5');
INSERT INTO distrito VALUES('50808', 'San Javier de Alpabamba', '508', '5');
INSERT INTO distrito VALUES('50809', 'San José de Ushua', '508', '5');
INSERT INTO distrito VALUES('50810', 'Sara Sara', '508', '5');
INSERT INTO distrito VALUES('50901', 'Querobamba', '509', '5');
INSERT INTO distrito VALUES('50902', 'Belén', '509', '5');
INSERT INTO distrito VALUES('50903', 'Chalcos', '509', '5');
INSERT INTO distrito VALUES('50904', 'Chilcayoc', '509', '5');
INSERT INTO distrito VALUES('50905', 'Huacaña', '509', '5');
INSERT INTO distrito VALUES('50906', 'Morcolla', '509', '5');
INSERT INTO distrito VALUES('50907', 'Paico', '509', '5');
INSERT INTO distrito VALUES('50908', 'San Pedro de Larcay', '509', '5');
INSERT INTO distrito VALUES('50909', 'San Salvador de Quije', '509', '5');
INSERT INTO distrito VALUES('50910', 'Santiago de Paucaray', '509', '5');
INSERT INTO distrito VALUES('50911', 'Soras', '509', '5');
INSERT INTO distrito VALUES('51001', 'Huancapi', '510', '5');
INSERT INTO distrito VALUES('51002', 'Alcamenca', '510', '5');
INSERT INTO distrito VALUES('51003', 'Apongo', '510', '5');
INSERT INTO distrito VALUES('51004', 'Asquipata', '510', '5');
INSERT INTO distrito VALUES('51005', 'Canaria', '510', '5');
INSERT INTO distrito VALUES('51006', 'Cayara', '510', '5');
INSERT INTO distrito VALUES('51007', 'Colca', '510', '5');
INSERT INTO distrito VALUES('51008', 'Huamanquiquia', '510', '5');
INSERT INTO distrito VALUES('51009', 'Huancaraylla', '510', '5');
INSERT INTO distrito VALUES('51010', 'Hualla', '510', '5');
INSERT INTO distrito VALUES('51011', 'Sarhua', '510', '5');
INSERT INTO distrito VALUES('51012', 'Vilcanchos', '510', '5');
INSERT INTO distrito VALUES('51101', 'Vilcas Huaman', '511', '5');
INSERT INTO distrito VALUES('51102', 'Accomarca', '511', '5');
INSERT INTO distrito VALUES('51103', 'Carhuanca', '511', '5');
INSERT INTO distrito VALUES('51104', 'Concepción', '511', '5');
INSERT INTO distrito VALUES('51105', 'Huambalpa', '511', '5');
INSERT INTO distrito VALUES('51106', 'Independencia', '511', '5');
INSERT INTO distrito VALUES('51107', 'Saurama', '511', '5');
INSERT INTO distrito VALUES('51108', 'Vischongo', '511', '5');
INSERT INTO distrito VALUES('60101', 'Cajamarca', '601', '6');
INSERT INTO distrito VALUES('60102', 'Asunción', '601', '6');
INSERT INTO distrito VALUES('60103', 'Chetilla', '601', '6');
INSERT INTO distrito VALUES('60104', 'Cospan', '601', '6');
INSERT INTO distrito VALUES('60105', 'Encañada', '601', '6');
INSERT INTO distrito VALUES('60106', 'Jesús', '601', '6');
INSERT INTO distrito VALUES('60107', 'Llacanora', '601', '6');
INSERT INTO distrito VALUES('60108', 'Los Baños del Inca', '601', '6');
INSERT INTO distrito VALUES('60109', 'Magdalena', '601', '6');
INSERT INTO distrito VALUES('60110', 'Matara', '601', '6');
INSERT INTO distrito VALUES('60111', 'Namora', '601', '6');
INSERT INTO distrito VALUES('60112', 'San Juan', '601', '6');
INSERT INTO distrito VALUES('60201', 'Cajabamba', '602', '6');
INSERT INTO distrito VALUES('60202', 'Cachachi', '602', '6');
INSERT INTO distrito VALUES('60203', 'Condebamba', '602', '6');
INSERT INTO distrito VALUES('60204', 'Sitacocha', '602', '6');
INSERT INTO distrito VALUES('60301', 'Celendín', '603', '6');
INSERT INTO distrito VALUES('60302', 'Chumuch', '603', '6');
INSERT INTO distrito VALUES('60303', 'Cortegana', '603', '6');
INSERT INTO distrito VALUES('60304', 'Huasmin', '603', '6');
INSERT INTO distrito VALUES('60305', 'Jorge Chávez', '603', '6');
INSERT INTO distrito VALUES('60306', 'José Gálvez', '603', '6');
INSERT INTO distrito VALUES('60307', 'Miguel Iglesias', '603', '6');
INSERT INTO distrito VALUES('60308', 'Oxamarca', '603', '6');
INSERT INTO distrito VALUES('60309', 'Sorochuco', '603', '6');
INSERT INTO distrito VALUES('60310', 'Sucre', '603', '6');
INSERT INTO distrito VALUES('60311', 'Utco', '603', '6');
INSERT INTO distrito VALUES('60312', 'La Libertad de Pallan', '603', '6');
INSERT INTO distrito VALUES('60401', 'Chota', '604', '6');
INSERT INTO distrito VALUES('60402', 'Anguia', '604', '6');
INSERT INTO distrito VALUES('60403', 'Chadin', '604', '6');
INSERT INTO distrito VALUES('60404', 'Chiguirip', '604', '6');
INSERT INTO distrito VALUES('60405', 'Chimban', '604', '6');
INSERT INTO distrito VALUES('60406', 'Choropampa', '604', '6');
INSERT INTO distrito VALUES('60407', 'Cochabamba', '604', '6');
INSERT INTO distrito VALUES('60408', 'Conchan', '604', '6');
INSERT INTO distrito VALUES('60409', 'Huambos', '604', '6');
INSERT INTO distrito VALUES('60410', 'Lajas', '604', '6');
INSERT INTO distrito VALUES('60411', 'Llama', '604', '6');
INSERT INTO distrito VALUES('60412', 'Miracosta', '604', '6');
INSERT INTO distrito VALUES('60413', 'Paccha', '604', '6');
INSERT INTO distrito VALUES('60414', 'Pion', '604', '6');
INSERT INTO distrito VALUES('60415', 'Querocoto', '604', '6');
INSERT INTO distrito VALUES('60416', 'San Juan de Licupis', '604', '6');
INSERT INTO distrito VALUES('60417', 'Tacabamba', '604', '6');
INSERT INTO distrito VALUES('60418', 'Tocmoche', '604', '6');
INSERT INTO distrito VALUES('60419', 'Chalamarca', '604', '6');
INSERT INTO distrito VALUES('60501', 'Contumaza', '605', '6');
INSERT INTO distrito VALUES('60502', 'Chilete', '605', '6');
INSERT INTO distrito VALUES('60503', 'Cupisnique', '605', '6');
INSERT INTO distrito VALUES('60504', 'Guzmango', '605', '6');
INSERT INTO distrito VALUES('60505', 'San Benito', '605', '6');
INSERT INTO distrito VALUES('60506', 'Santa Cruz de Toledo', '605', '6');
INSERT INTO distrito VALUES('60507', 'Tantarica', '605', '6');
INSERT INTO distrito VALUES('60508', 'Yonan', '605', '6');
INSERT INTO distrito VALUES('60601', 'Cutervo', '606', '6');
INSERT INTO distrito VALUES('60602', 'Callayuc', '606', '6');
INSERT INTO distrito VALUES('60603', 'Choros', '606', '6');
INSERT INTO distrito VALUES('60604', 'Cujillo', '606', '6');
INSERT INTO distrito VALUES('60605', 'La Ramada', '606', '6');
INSERT INTO distrito VALUES('60606', 'Pimpingos', '606', '6');
INSERT INTO distrito VALUES('60607', 'Querocotillo', '606', '6');
INSERT INTO distrito VALUES('60608', 'San Andrés de Cutervo', '606', '6');
INSERT INTO distrito VALUES('60609', 'San Juan de Cutervo', '606', '6');
INSERT INTO distrito VALUES('60610', 'San Luis de Lucma', '606', '6');
INSERT INTO distrito VALUES('60611', 'Santa Cruz', '606', '6');
INSERT INTO distrito VALUES('60612', 'Santo Domingo de la Capilla', '606', '6');
INSERT INTO distrito VALUES('60613', 'Santo Tomas', '606', '6');
INSERT INTO distrito VALUES('60614', 'Socota', '606', '6');
INSERT INTO distrito VALUES('60615', 'Toribio Casanova', '606', '6');
INSERT INTO distrito VALUES('60701', 'Bambamarca', '607', '6');
INSERT INTO distrito VALUES('60702', 'Chugur', '607', '6');
INSERT INTO distrito VALUES('60703', 'Hualgayoc', '607', '6');
INSERT INTO distrito VALUES('60801', 'Jaén', '608', '6');
INSERT INTO distrito VALUES('60802', 'Bellavista', '608', '6');
INSERT INTO distrito VALUES('60803', 'Chontali', '608', '6');
INSERT INTO distrito VALUES('60804', 'Colasay', '608', '6');
INSERT INTO distrito VALUES('60805', 'Huabal', '608', '6');
INSERT INTO distrito VALUES('60806', 'Las Pirias', '608', '6');
INSERT INTO distrito VALUES('60807', 'Pomahuaca', '608', '6');
INSERT INTO distrito VALUES('60808', 'Pucara', '608', '6');
INSERT INTO distrito VALUES('60809', 'Sallique', '608', '6');
INSERT INTO distrito VALUES('60810', 'San Felipe', '608', '6');
INSERT INTO distrito VALUES('60811', 'San José del Alto', '608', '6');
INSERT INTO distrito VALUES('60812', 'Santa Rosa', '608', '6');
INSERT INTO distrito VALUES('60901', 'San Ignacio', '609', '6');
INSERT INTO distrito VALUES('60902', 'Chirinos', '609', '6');
INSERT INTO distrito VALUES('60903', 'Huarango', '609', '6');
INSERT INTO distrito VALUES('60904', 'La Coipa', '609', '6');
INSERT INTO distrito VALUES('60905', 'Namballe', '609', '6');
INSERT INTO distrito VALUES('60906', 'San José de Lourdes', '609', '6');
INSERT INTO distrito VALUES('60907', 'Tabaconas', '609', '6');
INSERT INTO distrito VALUES('61001', 'Pedro Gálvez', '610', '6');
INSERT INTO distrito VALUES('61002', 'Chancay', '610', '6');
INSERT INTO distrito VALUES('61003', 'Eduardo Villanueva', '610', '6');
INSERT INTO distrito VALUES('61004', 'Gregorio Pita', '610', '6');
INSERT INTO distrito VALUES('61005', 'Ichocan', '610', '6');
INSERT INTO distrito VALUES('61006', 'José Manuel Quiroz', '610', '6');
INSERT INTO distrito VALUES('61007', 'José Sabogal', '610', '6');
INSERT INTO distrito VALUES('61101', 'San Miguel', '611', '6');
INSERT INTO distrito VALUES('61102', 'Bolívar', '611', '6');
INSERT INTO distrito VALUES('61103', 'Calquis', '611', '6');
INSERT INTO distrito VALUES('61104', 'Catilluc', '611', '6');
INSERT INTO distrito VALUES('61105', 'El Prado', '611', '6');
INSERT INTO distrito VALUES('61106', 'La Florida', '611', '6');
INSERT INTO distrito VALUES('61107', 'Llapa', '611', '6');
INSERT INTO distrito VALUES('61108', 'Nanchoc', '611', '6');
INSERT INTO distrito VALUES('61109', 'Niepos', '611', '6');
INSERT INTO distrito VALUES('61110', 'San Gregorio', '611', '6');
INSERT INTO distrito VALUES('61111', 'San Silvestre de Cochan', '611', '6');
INSERT INTO distrito VALUES('61112', 'Tongod', '611', '6');
INSERT INTO distrito VALUES('61113', 'Unión Agua Blanca', '611', '6');
INSERT INTO distrito VALUES('61201', 'San Pablo', '612', '6');
INSERT INTO distrito VALUES('61202', 'San Bernardino', '612', '6');
INSERT INTO distrito VALUES('61203', 'San Luis', '612', '6');
INSERT INTO distrito VALUES('61204', 'Tumbaden', '612', '6');
INSERT INTO distrito VALUES('61301', 'Santa Cruz', '613', '6');
INSERT INTO distrito VALUES('61302', 'Andabamba', '613', '6');
INSERT INTO distrito VALUES('61303', 'Catache', '613', '6');
INSERT INTO distrito VALUES('61304', 'Chancaybaños', '613', '6');
INSERT INTO distrito VALUES('61305', 'La Esperanza', '613', '6');
INSERT INTO distrito VALUES('61306', 'Ninabamba', '613', '6');
INSERT INTO distrito VALUES('61307', 'Pulan', '613', '6');
INSERT INTO distrito VALUES('61308', 'Saucepampa', '613', '6');
INSERT INTO distrito VALUES('61309', 'Sexi', '613', '6');
INSERT INTO distrito VALUES('61310', 'Uticyacu', '613', '6');
INSERT INTO distrito VALUES('61311', 'Yauyucan', '613', '6');
INSERT INTO distrito VALUES('70101', 'Callao', '701', '7');
INSERT INTO distrito VALUES('70102', 'Bellavista', '701', '7');
INSERT INTO distrito VALUES('70103', 'Carmen de la Legua Reynoso', '701', '7');
INSERT INTO distrito VALUES('70104', 'La Perla', '701', '7');
INSERT INTO distrito VALUES('70105', 'La Punta', '701', '7');
INSERT INTO distrito VALUES('70106', 'Ventanilla', '701', '7');
INSERT INTO distrito VALUES('70107', 'Mi Perú', '701', '7');
INSERT INTO distrito VALUES('80101', 'Cusco', '801', '8');
INSERT INTO distrito VALUES('80102', 'Ccorca', '801', '8');
INSERT INTO distrito VALUES('80103', 'Poroy', '801', '8');
INSERT INTO distrito VALUES('80104', 'San Jerónimo', '801', '8');
INSERT INTO distrito VALUES('80105', 'San Sebastian', '801', '8');
INSERT INTO distrito VALUES('80106', 'Santiago', '801', '8');
INSERT INTO distrito VALUES('80107', 'Saylla', '801', '8');
INSERT INTO distrito VALUES('80108', 'Wanchaq', '801', '8');
INSERT INTO distrito VALUES('80201', 'Acomayo', '802', '8');
INSERT INTO distrito VALUES('80202', 'Acopia', '802', '8');
INSERT INTO distrito VALUES('80203', 'Acos', '802', '8');
INSERT INTO distrito VALUES('80204', 'Mosoc Llacta', '802', '8');
INSERT INTO distrito VALUES('80205', 'Pomacanchi', '802', '8');
INSERT INTO distrito VALUES('80206', 'Rondocan', '802', '8');
INSERT INTO distrito VALUES('80207', 'Sangarara', '802', '8');
INSERT INTO distrito VALUES('80301', 'Anta', '803', '8');
INSERT INTO distrito VALUES('80302', 'Ancahuasi', '803', '8');
INSERT INTO distrito VALUES('80303', 'Cachimayo', '803', '8');
INSERT INTO distrito VALUES('80304', 'Chinchaypujio', '803', '8');
INSERT INTO distrito VALUES('80305', 'Huarocondo', '803', '8');
INSERT INTO distrito VALUES('80306', 'Limatambo', '803', '8');
INSERT INTO distrito VALUES('80307', 'Mollepata', '803', '8');
INSERT INTO distrito VALUES('80308', 'Pucyura', '803', '8');
INSERT INTO distrito VALUES('80309', 'Zurite', '803', '8');
INSERT INTO distrito VALUES('80401', 'Calca', '804', '8');
INSERT INTO distrito VALUES('80402', 'Coya', '804', '8');
INSERT INTO distrito VALUES('80403', 'Lamay', '804', '8');
INSERT INTO distrito VALUES('80404', 'Lares', '804', '8');
INSERT INTO distrito VALUES('80405', 'Pisac', '804', '8');
INSERT INTO distrito VALUES('80406', 'San Salvador', '804', '8');
INSERT INTO distrito VALUES('80407', 'Taray', '804', '8');
INSERT INTO distrito VALUES('80408', 'Yanatile', '804', '8');
INSERT INTO distrito VALUES('80501', 'Yanaoca', '805', '8');
INSERT INTO distrito VALUES('80502', 'Checca', '805', '8');
INSERT INTO distrito VALUES('80503', 'Kunturkanki', '805', '8');
INSERT INTO distrito VALUES('80504', 'Langui', '805', '8');
INSERT INTO distrito VALUES('80505', 'Layo', '805', '8');
INSERT INTO distrito VALUES('80506', 'Pampamarca', '805', '8');
INSERT INTO distrito VALUES('80507', 'Quehue', '805', '8');
INSERT INTO distrito VALUES('80508', 'Tupac Amaru', '805', '8');
INSERT INTO distrito VALUES('80601', 'Sicuani', '806', '8');
INSERT INTO distrito VALUES('80602', 'Checacupe', '806', '8');
INSERT INTO distrito VALUES('80603', 'Combapata', '806', '8');
INSERT INTO distrito VALUES('80604', 'Marangani', '806', '8');
INSERT INTO distrito VALUES('80605', 'Pitumarca', '806', '8');
INSERT INTO distrito VALUES('80606', 'San Pablo', '806', '8');
INSERT INTO distrito VALUES('80607', 'San Pedro', '806', '8');
INSERT INTO distrito VALUES('80608', 'Tinta', '806', '8');
INSERT INTO distrito VALUES('80701', 'Santo Tomas', '807', '8');
INSERT INTO distrito VALUES('80702', 'Capacmarca', '807', '8');
INSERT INTO distrito VALUES('80703', 'Chamaca', '807', '8');
INSERT INTO distrito VALUES('80704', 'Colquemarca', '807', '8');
INSERT INTO distrito VALUES('80705', 'Livitaca', '807', '8');
INSERT INTO distrito VALUES('80706', 'Llusco', '807', '8');
INSERT INTO distrito VALUES('80707', 'Quiñota', '807', '8');
INSERT INTO distrito VALUES('80708', 'Velille', '807', '8');
INSERT INTO distrito VALUES('80801', 'Espinar', '808', '8');
INSERT INTO distrito VALUES('80802', 'Condoroma', '808', '8');
INSERT INTO distrito VALUES('80803', 'Coporaque', '808', '8');
INSERT INTO distrito VALUES('80804', 'Ocoruro', '808', '8');
INSERT INTO distrito VALUES('80805', 'Pallpata', '808', '8');
INSERT INTO distrito VALUES('80806', 'Pichigua', '808', '8');
INSERT INTO distrito VALUES('80807', 'Suyckutambo', '808', '8');
INSERT INTO distrito VALUES('80808', 'Alto Pichigua', '808', '8');
INSERT INTO distrito VALUES('80901', 'Santa Ana', '809', '8');
INSERT INTO distrito VALUES('80902', 'Echarate', '809', '8');
INSERT INTO distrito VALUES('80903', 'Huayopata', '809', '8');
INSERT INTO distrito VALUES('80904', 'Maranura', '809', '8');
INSERT INTO distrito VALUES('80905', 'Ocobamba', '809', '8');
INSERT INTO distrito VALUES('80906', 'Quellouno', '809', '8');
INSERT INTO distrito VALUES('80907', 'Kimbiri', '809', '8');
INSERT INTO distrito VALUES('80908', 'Santa Teresa', '809', '8');
INSERT INTO distrito VALUES('80909', 'Vilcabamba', '809', '8');
INSERT INTO distrito VALUES('80910', 'Pichari', '809', '8');
INSERT INTO distrito VALUES('80911', 'Inkawasi', '809', '8');
INSERT INTO distrito VALUES('80912', 'Villa Virgen', '809', '8');
INSERT INTO distrito VALUES('80913', 'Villa Kintiarina', '809', '8');
INSERT INTO distrito VALUES('80914', 'Megantoni', '809', '8');
INSERT INTO distrito VALUES('81001', 'Paruro', '810', '8');
INSERT INTO distrito VALUES('81002', 'Accha', '810', '8');
INSERT INTO distrito VALUES('81003', 'Ccapi', '810', '8');
INSERT INTO distrito VALUES('81004', 'Colcha', '810', '8');
INSERT INTO distrito VALUES('81005', 'Huanoquite', '810', '8');
INSERT INTO distrito VALUES('81006', 'Omachaç', '810', '8');
INSERT INTO distrito VALUES('81007', 'Paccaritambo', '810', '8');
INSERT INTO distrito VALUES('81008', 'Pillpinto', '810', '8');
INSERT INTO distrito VALUES('81009', 'Yaurisque', '810', '8');
INSERT INTO distrito VALUES('81101', 'Paucartambo', '811', '8');
INSERT INTO distrito VALUES('81102', 'Caicay', '811', '8');
INSERT INTO distrito VALUES('81103', 'Challabamba', '811', '8');
INSERT INTO distrito VALUES('81104', 'Colquepata', '811', '8');
INSERT INTO distrito VALUES('81105', 'Huancarani', '811', '8');
INSERT INTO distrito VALUES('81106', 'Kosñipata', '811', '8');
INSERT INTO distrito VALUES('81201', 'Urcos', '812', '8');
INSERT INTO distrito VALUES('81202', 'Andahuaylillas', '812', '8');
INSERT INTO distrito VALUES('81203', 'Camanti', '812', '8');
INSERT INTO distrito VALUES('81204', 'Ccarhuayo', '812', '8');
INSERT INTO distrito VALUES('81205', 'Ccatca', '812', '8');
INSERT INTO distrito VALUES('81206', 'Cusipata', '812', '8');
INSERT INTO distrito VALUES('81207', 'Huaro', '812', '8');
INSERT INTO distrito VALUES('81208', 'Lucre', '812', '8');
INSERT INTO distrito VALUES('81209', 'Marcapata', '812', '8');
INSERT INTO distrito VALUES('81210', 'Ocongate', '812', '8');
INSERT INTO distrito VALUES('81211', 'Oropesa', '812', '8');
INSERT INTO distrito VALUES('81212', 'Quiquijana', '812', '8');
INSERT INTO distrito VALUES('81301', 'Urubamba', '813', '8');
INSERT INTO distrito VALUES('81302', 'Chinchero', '813', '8');
INSERT INTO distrito VALUES('81303', 'Huayllabamba', '813', '8');
INSERT INTO distrito VALUES('81304', 'Machupicchu', '813', '8');
INSERT INTO distrito VALUES('81305', 'Maras', '813', '8');
INSERT INTO distrito VALUES('81306', 'Ollantaytambo', '813', '8');
INSERT INTO distrito VALUES('81307', 'Yucay', '813', '8');
INSERT INTO distrito VALUES('90101', 'Huancavelica', '901', '9');
INSERT INTO distrito VALUES('90102', 'Acobambilla', '901', '9');
INSERT INTO distrito VALUES('90103', 'Acoria', '901', '9');
INSERT INTO distrito VALUES('90104', 'Conayca', '901', '9');
INSERT INTO distrito VALUES('90105', 'Cuenca', '901', '9');
INSERT INTO distrito VALUES('90106', 'Huachocolpa', '901', '9');
INSERT INTO distrito VALUES('90107', 'Huayllahuara', '901', '9');
INSERT INTO distrito VALUES('90108', 'Izcuchaca', '901', '9');
INSERT INTO distrito VALUES('90109', 'Laria', '901', '9');
INSERT INTO distrito VALUES('90110', 'Manta', '901', '9');
INSERT INTO distrito VALUES('90111', 'Mariscal Cáceres', '901', '9');
INSERT INTO distrito VALUES('90112', 'Moya', '901', '9');
INSERT INTO distrito VALUES('90113', 'Nuevo Occoro', '901', '9');
INSERT INTO distrito VALUES('90114', 'Palca', '901', '9');
INSERT INTO distrito VALUES('90115', 'Pilchaca', '901', '9');
INSERT INTO distrito VALUES('90116', 'Vilca', '901', '9');
INSERT INTO distrito VALUES('90117', 'Yauli', '901', '9');
INSERT INTO distrito VALUES('90118', 'Ascensión', '901', '9');
INSERT INTO distrito VALUES('90119', 'Huando', '901', '9');
INSERT INTO distrito VALUES('90201', 'Acobamba', '902', '9');
INSERT INTO distrito VALUES('90202', 'Andabamba', '902', '9');
INSERT INTO distrito VALUES('90203', 'Anta', '902', '9');
INSERT INTO distrito VALUES('90204', 'Caja', '902', '9');
INSERT INTO distrito VALUES('90205', 'Marcas', '902', '9');
INSERT INTO distrito VALUES('90206', 'Paucara', '902', '9');
INSERT INTO distrito VALUES('90207', 'Pomacocha', '902', '9');
INSERT INTO distrito VALUES('90208', 'Rosario', '902', '9');
INSERT INTO distrito VALUES('90301', 'Lircay', '903', '9');
INSERT INTO distrito VALUES('90302', 'Anchonga', '903', '9');
INSERT INTO distrito VALUES('90303', 'Callanmarca', '903', '9');
INSERT INTO distrito VALUES('90304', 'Ccochaccasa', '903', '9');
INSERT INTO distrito VALUES('90305', 'Chincho', '903', '9');
INSERT INTO distrito VALUES('90306', 'Congalla', '903', '9');
INSERT INTO distrito VALUES('90307', 'Huanca-Huanca', '903', '9');
INSERT INTO distrito VALUES('90308', 'Huayllay Grande', '903', '9');
INSERT INTO distrito VALUES('90309', 'Julcamarca', '903', '9');
INSERT INTO distrito VALUES('90310', 'San Antonio de Antaparco', '903', '9');
INSERT INTO distrito VALUES('90311', 'Santo Tomas de Pata', '903', '9');
INSERT INTO distrito VALUES('90312', 'Secclla', '903', '9');
INSERT INTO distrito VALUES('90401', 'Castrovirreyna', '904', '9');
INSERT INTO distrito VALUES('90402', 'Arma', '904', '9');
INSERT INTO distrito VALUES('90403', 'Aurahua', '904', '9');
INSERT INTO distrito VALUES('90404', 'Capillas', '904', '9');
INSERT INTO distrito VALUES('90405', 'Chupamarca', '904', '9');
INSERT INTO distrito VALUES('90406', 'Cocas', '904', '9');
INSERT INTO distrito VALUES('90407', 'Huachos', '904', '9');
INSERT INTO distrito VALUES('90408', 'Huamatambo', '904', '9');
INSERT INTO distrito VALUES('90409', 'Mollepampa', '904', '9');
INSERT INTO distrito VALUES('90410', 'San Juan', '904', '9');
INSERT INTO distrito VALUES('90411', 'Santa Ana', '904', '9');
INSERT INTO distrito VALUES('90412', 'Tantara', '904', '9');
INSERT INTO distrito VALUES('90413', 'Ticrapo', '904', '9');
INSERT INTO distrito VALUES('90501', 'Churcampa', '905', '9');
INSERT INTO distrito VALUES('90502', 'Anco', '905', '9');
INSERT INTO distrito VALUES('90503', 'Chinchihuasi', '905', '9');
INSERT INTO distrito VALUES('90504', 'El Carmen', '905', '9');
INSERT INTO distrito VALUES('90505', 'La Merced', '905', '9');
INSERT INTO distrito VALUES('90506', 'Locroja', '905', '9');
INSERT INTO distrito VALUES('90507', 'Paucarbamba', '905', '9');
INSERT INTO distrito VALUES('90508', 'San Miguel de Mayocc', '905', '9');
INSERT INTO distrito VALUES('90509', 'San Pedro de Coris', '905', '9');
INSERT INTO distrito VALUES('90510', 'Pachamarca', '905', '9');
INSERT INTO distrito VALUES('90511', 'Cosme', '905', '9');
INSERT INTO distrito VALUES('90601', 'Huaytara', '906', '9');
INSERT INTO distrito VALUES('90602', 'Ayavi', '906', '9');
INSERT INTO distrito VALUES('90603', 'Córdova', '906', '9');
INSERT INTO distrito VALUES('90604', 'Huayacundo Arma', '906', '9');
INSERT INTO distrito VALUES('90605', 'Laramarca', '906', '9');
INSERT INTO distrito VALUES('90606', 'Ocoyo', '906', '9');
INSERT INTO distrito VALUES('90607', 'Pilpichaca', '906', '9');
INSERT INTO distrito VALUES('90608', 'Querco', '906', '9');
INSERT INTO distrito VALUES('90609', 'Quito-Arma', '906', '9');
INSERT INTO distrito VALUES('90610', 'San Antonio de Cusicancha', '906', '9');
INSERT INTO distrito VALUES('90611', 'San Francisco de Sangayaico', '906', '9');
INSERT INTO distrito VALUES('90612', 'San Isidro', '906', '9');
INSERT INTO distrito VALUES('90613', 'Santiago de Chocorvos', '906', '9');
INSERT INTO distrito VALUES('90614', 'Santiago de Quirahuara', '906', '9');
INSERT INTO distrito VALUES('90615', 'Santo Domingo de Capillas', '906', '9');
INSERT INTO distrito VALUES('90616', 'Tambo', '906', '9');
INSERT INTO distrito VALUES('90701', 'Pampas', '907', '9');
INSERT INTO distrito VALUES('90702', 'Acostambo', '907', '9');
INSERT INTO distrito VALUES('90703', 'Acraquia', '907', '9');
INSERT INTO distrito VALUES('90704', 'Ahuaycha', '907', '9');
INSERT INTO distrito VALUES('90705', 'Colcabamba', '907', '9');
INSERT INTO distrito VALUES('90706', 'Daniel Hernández', '907', '9');
INSERT INTO distrito VALUES('90707', 'Huachocolpa', '907', '9');
INSERT INTO distrito VALUES('90709', 'Huaribamba', '907', '9');
INSERT INTO distrito VALUES('90710', 'Ñahuimpuquio', '907', '9');
INSERT INTO distrito VALUES('90711', 'Pazos', '907', '9');
INSERT INTO distrito VALUES('90713', 'Quishuar', '907', '9');
INSERT INTO distrito VALUES('90714', 'Salcabamba', '907', '9');
INSERT INTO distrito VALUES('90715', 'Salcahuasi', '907', '9');
INSERT INTO distrito VALUES('90716', 'San Marcos de Rocchac', '907', '9');
INSERT INTO distrito VALUES('90717', 'Surcubamba', '907', '9');
INSERT INTO distrito VALUES('90718', 'Tintay Puncu', '907', '9');
INSERT INTO distrito VALUES('90719', 'Quichuas', '907', '9');
INSERT INTO distrito VALUES('90720', 'Andaymarca', '907', '9');
INSERT INTO distrito VALUES('90721', 'Roble', '907', '9');
INSERT INTO distrito VALUES('90722', 'Pichos', '907', '9');
INSERT INTO distrito VALUES('90723', 'Santiago de Tucuma', '907', '9');
INSERT INTO distrito VALUES('100101', 'Huanuco', '1001', '10');
INSERT INTO distrito VALUES('100102', 'Amarilis', '1001', '10');
INSERT INTO distrito VALUES('100103', 'Chinchao', '1001', '10');
INSERT INTO distrito VALUES('100104', 'Churubamba', '1001', '10');
INSERT INTO distrito VALUES('100105', 'Margos', '1001', '10');
INSERT INTO distrito VALUES('100106', 'Quisqui (Kichki)', '1001', '10');
INSERT INTO distrito VALUES('100107', 'San Francisco de Cayran', '1001', '10');
INSERT INTO distrito VALUES('100108', 'San Pedro de Chaulan', '1001', '10');
INSERT INTO distrito VALUES('100109', 'Santa María del Valle', '1001', '10');
INSERT INTO distrito VALUES('100110', 'Yarumayo', '1001', '10');
INSERT INTO distrito VALUES('100111', 'Pillco Marca', '1001', '10');
INSERT INTO distrito VALUES('100112', 'Yacus', '1001', '10');
INSERT INTO distrito VALUES('100113', 'San Pablo de Pillao', '1001', '10');
INSERT INTO distrito VALUES('100201', 'Ambo', '1002', '10');
INSERT INTO distrito VALUES('100202', 'Cayna', '1002', '10');
INSERT INTO distrito VALUES('100203', 'Colpas', '1002', '10');
INSERT INTO distrito VALUES('100204', 'Conchamarca', '1002', '10');
INSERT INTO distrito VALUES('100205', 'Huacar', '1002', '10');
INSERT INTO distrito VALUES('100206', 'San Francisco', '1002', '10');
INSERT INTO distrito VALUES('100207', 'San Rafael', '1002', '10');
INSERT INTO distrito VALUES('100208', 'Tomay Kichwa', '1002', '10');
INSERT INTO distrito VALUES('100301', 'La Unión', '1003', '10');
INSERT INTO distrito VALUES('100307', 'Chuquis', '1003', '10');
INSERT INTO distrito VALUES('100311', 'Marías', '1003', '10');
INSERT INTO distrito VALUES('100313', 'Pachas', '1003', '10');
INSERT INTO distrito VALUES('100316', 'Quivilla', '1003', '10');
INSERT INTO distrito VALUES('100317', 'Ripan', '1003', '10');
INSERT INTO distrito VALUES('100321', 'Shunqui', '1003', '10');
INSERT INTO distrito VALUES('100322', 'Sillapata', '1003', '10');
INSERT INTO distrito VALUES('100323', 'Yanas', '1003', '10');
INSERT INTO distrito VALUES('100401', 'Huacaybamba', '1004', '10');
INSERT INTO distrito VALUES('100402', 'Canchabamba', '1004', '10');
INSERT INTO distrito VALUES('100403', 'Cochabamba', '1004', '10');
INSERT INTO distrito VALUES('100404', 'Pinra', '1004', '10');
INSERT INTO distrito VALUES('100501', 'Llata', '1005', '10');
INSERT INTO distrito VALUES('100502', 'Arancay', '1005', '10');
INSERT INTO distrito VALUES('100503', 'Chavín de Pariarca', '1005', '10');
INSERT INTO distrito VALUES('100504', 'Jacas Grande', '1005', '10');
INSERT INTO distrito VALUES('100505', 'Jircan', '1005', '10');
INSERT INTO distrito VALUES('100506', 'Miraflores', '1005', '10');
INSERT INTO distrito VALUES('100507', 'Monzón', '1005', '10');
INSERT INTO distrito VALUES('100508', 'Punchao', '1005', '10');
INSERT INTO distrito VALUES('100509', 'Puños', '1005', '10');
INSERT INTO distrito VALUES('100510', 'Singa', '1005', '10');
INSERT INTO distrito VALUES('100511', 'Tantamayo', '1005', '10');
INSERT INTO distrito VALUES('100601', 'Rupa-Rupa', '1006', '10');
INSERT INTO distrito VALUES('100602', 'Daniel Alomía Robles', '1006', '10');
INSERT INTO distrito VALUES('100603', 'Hermílio Valdizan', '1006', '10');
INSERT INTO distrito VALUES('100604', 'José Crespo y Castillo', '1006', '10');
INSERT INTO distrito VALUES('100605', 'Luyando', '1006', '10');
INSERT INTO distrito VALUES('100606', 'Mariano Damaso Beraun', '1006', '10');
INSERT INTO distrito VALUES('100607', 'Pucayacu', '1006', '10');
INSERT INTO distrito VALUES('100608', 'Castillo Grande', '1006', '10');
INSERT INTO distrito VALUES('100609', 'Pueblo Nuevo', '1006', '10');
INSERT INTO distrito VALUES('100610', 'Santo Domingo de Anda', '1006', '10');
INSERT INTO distrito VALUES('100701', 'Huacrachuco', '1007', '10');
INSERT INTO distrito VALUES('100702', 'Cholon', '1007', '10');
INSERT INTO distrito VALUES('100703', 'San Buenaventura', '1007', '10');
INSERT INTO distrito VALUES('100704', 'La Morada', '1007', '10');
INSERT INTO distrito VALUES('100705', 'Santa Rosa de Alto Yanajanca', '1007', '10');
INSERT INTO distrito VALUES('100801', 'Panao', '1008', '10');
INSERT INTO distrito VALUES('100802', 'Chaglla', '1008', '10');
INSERT INTO distrito VALUES('100803', 'Molino', '1008', '10');
INSERT INTO distrito VALUES('100804', 'Umari', '1008', '10');
INSERT INTO distrito VALUES('100901', 'Puerto Inca', '1009', '10');
INSERT INTO distrito VALUES('100902', 'Codo del Pozuzo', '1009', '10');
INSERT INTO distrito VALUES('100903', 'Honoria', '1009', '10');
INSERT INTO distrito VALUES('100904', 'Tournavista', '1009', '10');
INSERT INTO distrito VALUES('100905', 'Yuyapichis', '1009', '10');
INSERT INTO distrito VALUES('101001', 'Jesús', '1010', '10');
INSERT INTO distrito VALUES('101002', 'Baños', '1010', '10');
INSERT INTO distrito VALUES('101003', 'Jivia', '1010', '10');
INSERT INTO distrito VALUES('101004', 'Queropalca', '1010', '10');
INSERT INTO distrito VALUES('101005', 'Rondos', '1010', '10');
INSERT INTO distrito VALUES('101006', 'San Francisco de Asís', '1010', '10');
INSERT INTO distrito VALUES('101007', 'San Miguel de Cauri', '1010', '10');
INSERT INTO distrito VALUES('101101', 'Chavinillo', '1011', '10');
INSERT INTO distrito VALUES('101102', 'Cahuac', '1011', '10');
INSERT INTO distrito VALUES('101103', 'Chacabamba', '1011', '10');
INSERT INTO distrito VALUES('101104', 'Aparicio Pomares', '1011', '10');
INSERT INTO distrito VALUES('101105', 'Jacas Chico', '1011', '10');
INSERT INTO distrito VALUES('101106', 'Obas', '1011', '10');
INSERT INTO distrito VALUES('101107', 'Pampamarca', '1011', '10');
INSERT INTO distrito VALUES('101108', 'Choras', '1011', '10');
INSERT INTO distrito VALUES('110101', 'Ica', '1101', '11');
INSERT INTO distrito VALUES('110102', 'La Tinguiña', '1101', '11');
INSERT INTO distrito VALUES('110103', 'Los Aquijes', '1101', '11');
INSERT INTO distrito VALUES('110104', 'Ocucaje', '1101', '11');
INSERT INTO distrito VALUES('110105', 'Pachacutec', '1101', '11');
INSERT INTO distrito VALUES('110106', 'Parcona', '1101', '11');
INSERT INTO distrito VALUES('110107', 'Pueblo Nuevo', '1101', '11');
INSERT INTO distrito VALUES('110108', 'Salas', '1101', '11');
INSERT INTO distrito VALUES('110109', 'San José de Los Molinos', '1101', '11');
INSERT INTO distrito VALUES('110110', 'San Juan Bautista', '1101', '11');
INSERT INTO distrito VALUES('110111', 'Santiago', '1101', '11');
INSERT INTO distrito VALUES('110112', 'Subtanjalla', '1101', '11');
INSERT INTO distrito VALUES('110113', 'Tate', '1101', '11');
INSERT INTO distrito VALUES('110114', 'Yauca del Rosario', '1101', '11');
INSERT INTO distrito VALUES('110201', 'Chincha Alta', '1102', '11');
INSERT INTO distrito VALUES('110202', 'Alto Laran', '1102', '11');
INSERT INTO distrito VALUES('110203', 'Chavin', '1102', '11');
INSERT INTO distrito VALUES('110204', 'Chincha Baja', '1102', '11');
INSERT INTO distrito VALUES('110205', 'El Carmen', '1102', '11');
INSERT INTO distrito VALUES('110206', 'Grocio Prado', '1102', '11');
INSERT INTO distrito VALUES('110207', 'Pueblo Nuevo', '1102', '11');
INSERT INTO distrito VALUES('110208', 'San Juan de Yanac', '1102', '11');
INSERT INTO distrito VALUES('110209', 'San Pedro de Huacarpana', '1102', '11');
INSERT INTO distrito VALUES('110210', 'Sunampe', '1102', '11');
INSERT INTO distrito VALUES('110211', 'Tambo de Mora', '1102', '11');
INSERT INTO distrito VALUES('110301', 'Nasca', '1103', '11');
INSERT INTO distrito VALUES('110302', 'Changuillo', '1103', '11');
INSERT INTO distrito VALUES('110303', 'El Ingenio', '1103', '11');
INSERT INTO distrito VALUES('110304', 'Marcona', '1103', '11');
INSERT INTO distrito VALUES('110305', 'Vista Alegre', '1103', '11');
INSERT INTO distrito VALUES('110401', 'Palpa', '1104', '11');
INSERT INTO distrito VALUES('110402', 'Llipata', '1104', '11');
INSERT INTO distrito VALUES('110403', 'Río Grande', '1104', '11');
INSERT INTO distrito VALUES('110404', 'Santa Cruz', '1104', '11');
INSERT INTO distrito VALUES('110405', 'Tibillo', '1104', '11');
INSERT INTO distrito VALUES('110501', 'Pisco', '1105', '11');
INSERT INTO distrito VALUES('110502', 'Huancano', '1105', '11');
INSERT INTO distrito VALUES('110503', 'Humay', '1105', '11');
INSERT INTO distrito VALUES('110504', 'Independencia', '1105', '11');
INSERT INTO distrito VALUES('110505', 'Paracas', '1105', '11');
INSERT INTO distrito VALUES('110506', 'San Andrés', '1105', '11');
INSERT INTO distrito VALUES('110507', 'San Clemente', '1105', '11');
INSERT INTO distrito VALUES('110508', 'Tupac Amaru Inca', '1105', '11');
INSERT INTO distrito VALUES('120101', 'Huancayo', '1201', '12');
INSERT INTO distrito VALUES('120104', 'Carhuacallanga', '1201', '12');
INSERT INTO distrito VALUES('120105', 'Chacapampa', '1201', '12');
INSERT INTO distrito VALUES('120106', 'Chicche', '1201', '12');
INSERT INTO distrito VALUES('120107', 'Chilca', '1201', '12');
INSERT INTO distrito VALUES('120108', 'Chongos Alto', '1201', '12');
INSERT INTO distrito VALUES('120111', 'Chupuro', '1201', '12');
INSERT INTO distrito VALUES('120112', 'Colca', '1201', '12');
INSERT INTO distrito VALUES('120113', 'Cullhuas', '1201', '12');
INSERT INTO distrito VALUES('120114', 'El Tambo', '1201', '12');
INSERT INTO distrito VALUES('120116', 'Huacrapuquio', '1201', '12');
INSERT INTO distrito VALUES('120117', 'Hualhuas', '1201', '12');
INSERT INTO distrito VALUES('120119', 'Huancan', '1201', '12');
INSERT INTO distrito VALUES('120120', 'Huasicancha', '1201', '12');
INSERT INTO distrito VALUES('120121', 'Huayucachi', '1201', '12');
INSERT INTO distrito VALUES('120122', 'Ingenio', '1201', '12');
INSERT INTO distrito VALUES('120124', 'Pariahuanca', '1201', '12');
INSERT INTO distrito VALUES('120125', 'Pilcomayo', '1201', '12');
INSERT INTO distrito VALUES('120126', 'Pucara', '1201', '12');
INSERT INTO distrito VALUES('120127', 'Quichuay', '1201', '12');
INSERT INTO distrito VALUES('120128', 'Quilcas', '1201', '12');
INSERT INTO distrito VALUES('120129', 'San Agustín', '1201', '12');
INSERT INTO distrito VALUES('120130', 'San Jerónimo de Tunan', '1201', '12');
INSERT INTO distrito VALUES('120132', 'Saño', '1201', '12');
INSERT INTO distrito VALUES('120133', 'Sapallanga', '1201', '12');
INSERT INTO distrito VALUES('120134', 'Sicaya', '1201', '12');
INSERT INTO distrito VALUES('120135', 'Santo Domingo de Acobamba', '1201', '12');
INSERT INTO distrito VALUES('120136', 'Viques', '1201', '12');
INSERT INTO distrito VALUES('120201', 'Concepción', '1202', '12');
INSERT INTO distrito VALUES('120202', 'Aco', '1202', '12');
INSERT INTO distrito VALUES('120203', 'Andamarca', '1202', '12');
INSERT INTO distrito VALUES('120204', 'Chambara', '1202', '12');
INSERT INTO distrito VALUES('120205', 'Cochas', '1202', '12');
INSERT INTO distrito VALUES('120206', 'Comas', '1202', '12');
INSERT INTO distrito VALUES('120207', 'Heroínas Toledo', '1202', '12');
INSERT INTO distrito VALUES('120208', 'Manzanares', '1202', '12');
INSERT INTO distrito VALUES('120209', 'Mariscal Castilla', '1202', '12');
INSERT INTO distrito VALUES('120210', 'Matahuasi', '1202', '12');
INSERT INTO distrito VALUES('120211', 'Mito', '1202', '12');
INSERT INTO distrito VALUES('120212', 'Nueve de Julio', '1202', '12');
INSERT INTO distrito VALUES('120213', 'Orcotuna', '1202', '12');
INSERT INTO distrito VALUES('120214', 'San José de Quero', '1202', '12');
INSERT INTO distrito VALUES('120215', 'Santa Rosa de Ocopa', '1202', '12');
INSERT INTO distrito VALUES('120301', 'Chanchamayo', '1203', '12');
INSERT INTO distrito VALUES('120302', 'Perene', '1203', '12');
INSERT INTO distrito VALUES('120303', 'Pichanaqui', '1203', '12');
INSERT INTO distrito VALUES('120304', 'San Luis de Shuaro', '1203', '12');
INSERT INTO distrito VALUES('120305', 'San Ramón', '1203', '12');
INSERT INTO distrito VALUES('120306', 'Vitoc', '1203', '12');
INSERT INTO distrito VALUES('120401', 'Jauja', '1204', '12');
INSERT INTO distrito VALUES('120402', 'Acolla', '1204', '12');
INSERT INTO distrito VALUES('120403', 'Apata', '1204', '12');
INSERT INTO distrito VALUES('120404', 'Ataura', '1204', '12');
INSERT INTO distrito VALUES('120405', 'Canchayllo', '1204', '12');
INSERT INTO distrito VALUES('120406', 'Curicaca', '1204', '12');
INSERT INTO distrito VALUES('120407', 'El Mantaro', '1204', '12');
INSERT INTO distrito VALUES('120408', 'Huamali', '1204', '12');
INSERT INTO distrito VALUES('120409', 'Huaripampa', '1204', '12');
INSERT INTO distrito VALUES('120410', 'Huertas', '1204', '12');
INSERT INTO distrito VALUES('120411', 'Janjaillo', '1204', '12');
INSERT INTO distrito VALUES('120412', 'Julcán', '1204', '12');
INSERT INTO distrito VALUES('120413', 'Leonor Ordóñez', '1204', '12');
INSERT INTO distrito VALUES('120414', 'Llocllapampa', '1204', '12');
INSERT INTO distrito VALUES('120415', 'Marco', '1204', '12');
INSERT INTO distrito VALUES('120416', 'Masma', '1204', '12');
INSERT INTO distrito VALUES('120417', 'Masma Chicche', '1204', '12');
INSERT INTO distrito VALUES('120418', 'Molinos', '1204', '12');
INSERT INTO distrito VALUES('120419', 'Monobamba', '1204', '12');
INSERT INTO distrito VALUES('120420', 'Muqui', '1204', '12');
INSERT INTO distrito VALUES('120421', 'Muquiyauyo', '1204', '12');
INSERT INTO distrito VALUES('120422', 'Paca', '1204', '12');
INSERT INTO distrito VALUES('120423', 'Paccha', '1204', '12');
INSERT INTO distrito VALUES('120424', 'Pancan', '1204', '12');
INSERT INTO distrito VALUES('120425', 'Parco', '1204', '12');
INSERT INTO distrito VALUES('120426', 'Pomacancha', '1204', '12');
INSERT INTO distrito VALUES('120427', 'Ricran', '1204', '12');
INSERT INTO distrito VALUES('120428', 'San Lorenzo', '1204', '12');
INSERT INTO distrito VALUES('120429', 'San Pedro de Chunan', '1204', '12');
INSERT INTO distrito VALUES('120430', 'Sausa', '1204', '12');
INSERT INTO distrito VALUES('120431', 'Sincos', '1204', '12');
INSERT INTO distrito VALUES('120432', 'Tunan Marca', '1204', '12');
INSERT INTO distrito VALUES('120433', 'Yauli', '1204', '12');
INSERT INTO distrito VALUES('120434', 'Yauyos', '1204', '12');
INSERT INTO distrito VALUES('120501', 'Junin', '1205', '12');
INSERT INTO distrito VALUES('120502', 'Carhuamayo', '1205', '12');
INSERT INTO distrito VALUES('120503', 'Ondores', '1205', '12');
INSERT INTO distrito VALUES('120504', 'Ulcumayo', '1205', '12');
INSERT INTO distrito VALUES('120601', 'Satipo', '1206', '12');
INSERT INTO distrito VALUES('120602', 'Coviriali', '1206', '12');
INSERT INTO distrito VALUES('120603', 'Llaylla', '1206', '12');
INSERT INTO distrito VALUES('120604', 'Mazamari', '1206', '12');
INSERT INTO distrito VALUES('120605', 'Pampa Hermosa', '1206', '12');
INSERT INTO distrito VALUES('120606', 'Pangoa', '1206', '12');
INSERT INTO distrito VALUES('120607', 'Río Negro', '1206', '12');
INSERT INTO distrito VALUES('120608', 'Río Tambo', '1206', '12');
INSERT INTO distrito VALUES('120609', 'Vizcatan del Ene', '1206', '12');
INSERT INTO distrito VALUES('120701', 'Tarma', '1207', '12');
INSERT INTO distrito VALUES('120702', 'Acobamba', '1207', '12');
INSERT INTO distrito VALUES('120703', 'Huaricolca', '1207', '12');
INSERT INTO distrito VALUES('120704', 'Huasahuasi', '1207', '12');
INSERT INTO distrito VALUES('120705', 'La Unión', '1207', '12');
INSERT INTO distrito VALUES('120706', 'Palca', '1207', '12');
INSERT INTO distrito VALUES('120707', 'Palcamayo', '1207', '12');
INSERT INTO distrito VALUES('120708', 'San Pedro de Cajas', '1207', '12');
INSERT INTO distrito VALUES('120709', 'Tapo', '1207', '12');
INSERT INTO distrito VALUES('120801', 'La Oroya', '1208', '12');
INSERT INTO distrito VALUES('120802', 'Chacapalpa', '1208', '12');
INSERT INTO distrito VALUES('120803', 'Huay-Huay', '1208', '12');
INSERT INTO distrito VALUES('120804', 'Marcapomacocha', '1208', '12');
INSERT INTO distrito VALUES('120805', 'Morococha', '1208', '12');
INSERT INTO distrito VALUES('120806', 'Paccha', '1208', '12');
INSERT INTO distrito VALUES('120807', 'Santa Bárbara de Carhuacayan', '1208', '12');
INSERT INTO distrito VALUES('120808', 'Santa Rosa de Sacco', '1208', '12');
INSERT INTO distrito VALUES('120809', 'Suitucancha', '1208', '12');
INSERT INTO distrito VALUES('120810', 'Yauli', '1208', '12');
INSERT INTO distrito VALUES('120901', 'Chupaca', '1209', '12');
INSERT INTO distrito VALUES('120902', 'Ahuac', '1209', '12');
INSERT INTO distrito VALUES('120903', 'Chongos Bajo', '1209', '12');
INSERT INTO distrito VALUES('120904', 'Huachac', '1209', '12');
INSERT INTO distrito VALUES('120905', 'Huamancaca Chico', '1209', '12');
INSERT INTO distrito VALUES('120906', 'San Juan de Iscos', '1209', '12');
INSERT INTO distrito VALUES('120907', 'San Juan de Jarpa', '1209', '12');
INSERT INTO distrito VALUES('120908', 'Tres de Diciembre', '1209', '12');
INSERT INTO distrito VALUES('120909', 'Yanacancha', '1209', '12');
INSERT INTO distrito VALUES('130101', 'Trujillo', '1301', '13');
INSERT INTO distrito VALUES('130102', 'El Porvenir', '1301', '13');
INSERT INTO distrito VALUES('130103', 'Florencia de Mora', '1301', '13');
INSERT INTO distrito VALUES('130104', 'Huanchaco', '1301', '13');
INSERT INTO distrito VALUES('130105', 'La Esperanza', '1301', '13');
INSERT INTO distrito VALUES('130106', 'Laredo', '1301', '13');
INSERT INTO distrito VALUES('130107', 'Moche', '1301', '13');
INSERT INTO distrito VALUES('130108', 'Poroto', '1301', '13');
INSERT INTO distrito VALUES('130109', 'Salaverry', '1301', '13');
INSERT INTO distrito VALUES('130110', 'Simbal', '1301', '13');
INSERT INTO distrito VALUES('130111', 'Victor Larco Herrera', '1301', '13');
INSERT INTO distrito VALUES('130201', 'Ascope', '1302', '13');
INSERT INTO distrito VALUES('130202', 'Chicama', '1302', '13');
INSERT INTO distrito VALUES('130203', 'Chocope', '1302', '13');
INSERT INTO distrito VALUES('130204', 'Magdalena de Cao', '1302', '13');
INSERT INTO distrito VALUES('130205', 'Paijan', '1302', '13');
INSERT INTO distrito VALUES('130206', 'Rázuri', '1302', '13');
INSERT INTO distrito VALUES('130207', 'Santiago de Cao', '1302', '13');
INSERT INTO distrito VALUES('130208', 'Casa Grande', '1302', '13');
INSERT INTO distrito VALUES('130301', 'Bolívar', '1303', '13');
INSERT INTO distrito VALUES('130302', 'Bambamarca', '1303', '13');
INSERT INTO distrito VALUES('130303', 'Condormarca', '1303', '13');
INSERT INTO distrito VALUES('130304', 'Longotea', '1303', '13');
INSERT INTO distrito VALUES('130305', 'Uchumarca', '1303', '13');
INSERT INTO distrito VALUES('130306', 'Ucuncha', '1303', '13');
INSERT INTO distrito VALUES('130401', 'Chepen', '1304', '13');
INSERT INTO distrito VALUES('130402', 'Pacanga', '1304', '13');
INSERT INTO distrito VALUES('130403', 'Pueblo Nuevo', '1304', '13');
INSERT INTO distrito VALUES('130501', 'Julcan', '1305', '13');
INSERT INTO distrito VALUES('130502', 'Calamarca', '1305', '13');
INSERT INTO distrito VALUES('130503', 'Carabamba', '1305', '13');
INSERT INTO distrito VALUES('130504', 'Huaso', '1305', '13');
INSERT INTO distrito VALUES('130601', 'Otuzco', '1306', '13');
INSERT INTO distrito VALUES('130602', 'Agallpampa', '1306', '13');
INSERT INTO distrito VALUES('130604', 'Charat', '1306', '13');
INSERT INTO distrito VALUES('130605', 'Huaranchal', '1306', '13');
INSERT INTO distrito VALUES('130606', 'La Cuesta', '1306', '13');
INSERT INTO distrito VALUES('130608', 'Mache', '1306', '13');
INSERT INTO distrito VALUES('130610', 'Paranday', '1306', '13');
INSERT INTO distrito VALUES('130611', 'Salpo', '1306', '13');
INSERT INTO distrito VALUES('130613', 'Sinsicap', '1306', '13');
INSERT INTO distrito VALUES('130614', 'Usquil', '1306', '13');
INSERT INTO distrito VALUES('130701', 'San Pedro de Lloc', '1307', '13');
INSERT INTO distrito VALUES('130702', 'Guadalupe', '1307', '13');
INSERT INTO distrito VALUES('130703', 'Jequetepeque', '1307', '13');
INSERT INTO distrito VALUES('130704', 'Pacasmayo', '1307', '13');
INSERT INTO distrito VALUES('130705', 'San José', '1307', '13');
INSERT INTO distrito VALUES('130801', 'Tayabamba', '1308', '13');
INSERT INTO distrito VALUES('130802', 'Buldibuyo', '1308', '13');
INSERT INTO distrito VALUES('130803', 'Chillia', '1308', '13');
INSERT INTO distrito VALUES('130804', 'Huancaspata', '1308', '13');
INSERT INTO distrito VALUES('130805', 'Huaylillas', '1308', '13');
INSERT INTO distrito VALUES('130806', 'Huayo', '1308', '13');
INSERT INTO distrito VALUES('130807', 'Ongon', '1308', '13');
INSERT INTO distrito VALUES('130808', 'Parcoy', '1308', '13');
INSERT INTO distrito VALUES('130809', 'Pataz', '1308', '13');
INSERT INTO distrito VALUES('130810', 'Pias', '1308', '13');
INSERT INTO distrito VALUES('130811', 'Santiago de Challas', '1308', '13');
INSERT INTO distrito VALUES('130812', 'Taurija', '1308', '13');
INSERT INTO distrito VALUES('130813', 'Urpay', '1308', '13');
INSERT INTO distrito VALUES('130901', 'Huamachuco', '1309', '13');
INSERT INTO distrito VALUES('130902', 'Chugay', '1309', '13');
INSERT INTO distrito VALUES('130903', 'Cochorco', '1309', '13');
INSERT INTO distrito VALUES('130904', 'Curgos', '1309', '13');
INSERT INTO distrito VALUES('130905', 'Marcabal', '1309', '13');
INSERT INTO distrito VALUES('130906', 'Sanagoran', '1309', '13');
INSERT INTO distrito VALUES('130907', 'Sarin', '1309', '13');
INSERT INTO distrito VALUES('130908', 'Sartimbamba', '1309', '13');
INSERT INTO distrito VALUES('131001', 'Santiago de Chuco', '1310', '13');
INSERT INTO distrito VALUES('131002', 'Angasmarca', '1310', '13');
INSERT INTO distrito VALUES('131003', 'Cachicadan', '1310', '13');
INSERT INTO distrito VALUES('131004', 'Mollebamba', '1310', '13');
INSERT INTO distrito VALUES('131005', 'Mollepata', '1310', '13');
INSERT INTO distrito VALUES('131006', 'Quiruvilca', '1310', '13');
INSERT INTO distrito VALUES('131007', 'Santa Cruz de Chuca', '1310', '13');
INSERT INTO distrito VALUES('131008', 'Sitabamba', '1310', '13');
INSERT INTO distrito VALUES('131101', 'Cascas', '1311', '13');
INSERT INTO distrito VALUES('131102', 'Lucma', '1311', '13');
INSERT INTO distrito VALUES('131103', 'Marmot', '1311', '13');
INSERT INTO distrito VALUES('131104', 'Sayapullo', '1311', '13');
INSERT INTO distrito VALUES('131201', 'Viru', '1312', '13');
INSERT INTO distrito VALUES('131202', 'Chao', '1312', '13');
INSERT INTO distrito VALUES('131203', 'Guadalupito', '1312', '13');
INSERT INTO distrito VALUES('140101', 'Chiclayo', '1401', '14');
INSERT INTO distrito VALUES('140102', 'Chongoyape', '1401', '14');
INSERT INTO distrito VALUES('140103', 'Eten', '1401', '14');
INSERT INTO distrito VALUES('140104', 'Eten Puerto', '1401', '14');
INSERT INTO distrito VALUES('140105', 'José Leonardo Ortiz', '1401', '14');
INSERT INTO distrito VALUES('140106', 'La Victoria', '1401', '14');
INSERT INTO distrito VALUES('140107', 'Lagunas', '1401', '14');
INSERT INTO distrito VALUES('140108', 'Monsefu', '1401', '14');
INSERT INTO distrito VALUES('140109', 'Nueva Arica', '1401', '14');
INSERT INTO distrito VALUES('140110', 'Oyotun', '1401', '14');
INSERT INTO distrito VALUES('140111', 'Picsi', '1401', '14');
INSERT INTO distrito VALUES('140112', 'Pimentel', '1401', '14');
INSERT INTO distrito VALUES('140113', 'Reque', '1401', '14');
INSERT INTO distrito VALUES('140114', 'Santa Rosa', '1401', '14');
INSERT INTO distrito VALUES('140115', 'Saña', '1401', '14');
INSERT INTO distrito VALUES('140116', 'Cayalti', '1401', '14');
INSERT INTO distrito VALUES('140117', 'Patapo', '1401', '14');
INSERT INTO distrito VALUES('140118', 'Pomalca', '1401', '14');
INSERT INTO distrito VALUES('140119', 'Pucala', '1401', '14');
INSERT INTO distrito VALUES('140120', 'Tuman', '1401', '14');
INSERT INTO distrito VALUES('140201', 'Ferreñafe', '1402', '14');
INSERT INTO distrito VALUES('140202', 'Cañaris', '1402', '14');
INSERT INTO distrito VALUES('140203', 'Incahuasi', '1402', '14');
INSERT INTO distrito VALUES('140204', 'Manuel Antonio Mesones Muro', '1402', '14');
INSERT INTO distrito VALUES('140205', 'Pitipo', '1402', '14');
INSERT INTO distrito VALUES('140206', 'Pueblo Nuevo', '1402', '14');
INSERT INTO distrito VALUES('140301', 'Lambayeque', '1403', '14');
INSERT INTO distrito VALUES('140302', 'Chochope', '1403', '14');
INSERT INTO distrito VALUES('140303', 'Illimo', '1403', '14');
INSERT INTO distrito VALUES('140304', 'Jayanca', '1403', '14');
INSERT INTO distrito VALUES('140305', 'Mochumi', '1403', '14');
INSERT INTO distrito VALUES('140306', 'Morrope', '1403', '14');
INSERT INTO distrito VALUES('140307', 'Motupe', '1403', '14');
INSERT INTO distrito VALUES('140308', 'Olmos', '1403', '14');
INSERT INTO distrito VALUES('140309', 'Pacora', '1403', '14');
INSERT INTO distrito VALUES('140310', 'Salas', '1403', '14');
INSERT INTO distrito VALUES('140311', 'San José', '1403', '14');
INSERT INTO distrito VALUES('140312', 'Tucume', '1403', '14');
INSERT INTO distrito VALUES('150101', 'Lima', '1501', '15');
INSERT INTO distrito VALUES('150102', 'Ancón', '1501', '15');
INSERT INTO distrito VALUES('150103', 'Ate', '1501', '15');
INSERT INTO distrito VALUES('150104', 'Barranco', '1501', '15');
INSERT INTO distrito VALUES('150105', 'Breña', '1501', '15');
INSERT INTO distrito VALUES('150106', 'Carabayllo', '1501', '15');
INSERT INTO distrito VALUES('150107', 'Chaclacayo', '1501', '15');
INSERT INTO distrito VALUES('150108', 'Chorrillos', '1501', '15');
INSERT INTO distrito VALUES('150109', 'Cieneguilla', '1501', '15');
INSERT INTO distrito VALUES('150110', 'Comas', '1501', '15');
INSERT INTO distrito VALUES('150111', 'El Agustino', '1501', '15');
INSERT INTO distrito VALUES('150112', 'Independencia', '1501', '15');
INSERT INTO distrito VALUES('150113', 'Jesús María', '1501', '15');
INSERT INTO distrito VALUES('150114', 'La Molina', '1501', '15');
INSERT INTO distrito VALUES('150115', 'La Victoria', '1501', '15');
INSERT INTO distrito VALUES('150116', 'Lince', '1501', '15');
INSERT INTO distrito VALUES('150117', 'Los Olivos', '1501', '15');
INSERT INTO distrito VALUES('150118', 'Lurigancho', '1501', '15');
INSERT INTO distrito VALUES('150119', 'Lurin', '1501', '15');
INSERT INTO distrito VALUES('150120', 'Magdalena del Mar', '1501', '15');
INSERT INTO distrito VALUES('150121', 'Pueblo Libre', '1501', '15');
INSERT INTO distrito VALUES('150122', 'Miraflores', '1501', '15');
INSERT INTO distrito VALUES('150123', 'Pachacamac', '1501', '15');
INSERT INTO distrito VALUES('150124', 'Pucusana', '1501', '15');
INSERT INTO distrito VALUES('150125', 'Puente Piedra', '1501', '15');
INSERT INTO distrito VALUES('150126', 'Punta Hermosa', '1501', '15');
INSERT INTO distrito VALUES('150127', 'Punta Negra', '1501', '15');
INSERT INTO distrito VALUES('150128', 'Rímac', '1501', '15');
INSERT INTO distrito VALUES('150129', 'San Bartolo', '1501', '15');
INSERT INTO distrito VALUES('150130', 'San Borja', '1501', '15');
INSERT INTO distrito VALUES('150131', 'San Isidro', '1501', '15');
INSERT INTO distrito VALUES('150132', 'San Juan de Lurigancho', '1501', '15');
INSERT INTO distrito VALUES('150133', 'San Juan de Miraflores', '1501', '15');
INSERT INTO distrito VALUES('150134', 'San Luis', '1501', '15');
INSERT INTO distrito VALUES('150135', 'San Martín de Porres', '1501', '15');
INSERT INTO distrito VALUES('150136', 'San Miguel', '1501', '15');
INSERT INTO distrito VALUES('150137', 'Santa Anita', '1501', '15');
INSERT INTO distrito VALUES('150138', 'Santa María del Mar', '1501', '15');
INSERT INTO distrito VALUES('150139', 'Santa Rosa', '1501', '15');
INSERT INTO distrito VALUES('150140', 'Santiago de Surco', '1501', '15');
INSERT INTO distrito VALUES('150141', 'Surquillo', '1501', '15');
INSERT INTO distrito VALUES('150142', 'Villa El Salvador', '1501', '15');
INSERT INTO distrito VALUES('150143', 'Villa María del Triunfo', '1501', '15');
INSERT INTO distrito VALUES('150201', 'Barranca', '1502', '15');
INSERT INTO distrito VALUES('150202', 'Paramonga', '1502', '15');
INSERT INTO distrito VALUES('150203', 'Pativilca', '1502', '15');
INSERT INTO distrito VALUES('150204', 'Supe', '1502', '15');
INSERT INTO distrito VALUES('150205', 'Supe Puerto', '1502', '15');
INSERT INTO distrito VALUES('150301', 'Cajatambo', '1503', '15');
INSERT INTO distrito VALUES('150302', 'Copa', '1503', '15');
INSERT INTO distrito VALUES('150303', 'Gorgor', '1503', '15');
INSERT INTO distrito VALUES('150304', 'Huancapon', '1503', '15');
INSERT INTO distrito VALUES('150305', 'Manas', '1503', '15');
INSERT INTO distrito VALUES('150401', 'Canta', '1504', '15');
INSERT INTO distrito VALUES('150402', 'Arahuay', '1504', '15');
INSERT INTO distrito VALUES('150403', 'Huamantanga', '1504', '15');
INSERT INTO distrito VALUES('150404', 'Huaros', '1504', '15');
INSERT INTO distrito VALUES('150405', 'Lachaqui', '1504', '15');
INSERT INTO distrito VALUES('150406', 'San Buenaventura', '1504', '15');
INSERT INTO distrito VALUES('150407', 'Santa Rosa de Quives', '1504', '15');
INSERT INTO distrito VALUES('150501', 'San Vicente de Cañete', '1505', '15');
INSERT INTO distrito VALUES('150502', 'Asia', '1505', '15');
INSERT INTO distrito VALUES('150503', 'Calango', '1505', '15');
INSERT INTO distrito VALUES('150504', 'Cerro Azul', '1505', '15');
INSERT INTO distrito VALUES('150505', 'Chilca', '1505', '15');
INSERT INTO distrito VALUES('150506', 'Coayllo', '1505', '15');
INSERT INTO distrito VALUES('150507', 'Imperial', '1505', '15');
INSERT INTO distrito VALUES('150508', 'Lunahuana', '1505', '15');
INSERT INTO distrito VALUES('150509', 'Mala', '1505', '15');
INSERT INTO distrito VALUES('150510', 'Nuevo Imperial', '1505', '15');
INSERT INTO distrito VALUES('150511', 'Pacaran', '1505', '15');
INSERT INTO distrito VALUES('150512', 'Quilmana', '1505', '15');
INSERT INTO distrito VALUES('150513', 'San Antonio', '1505', '15');
INSERT INTO distrito VALUES('150514', 'San Luis', '1505', '15');
INSERT INTO distrito VALUES('150515', 'Santa Cruz de Flores', '1505', '15');
INSERT INTO distrito VALUES('150516', 'Zúñiga', '1505', '15');
INSERT INTO distrito VALUES('150601', 'Huaral', '1506', '15');
INSERT INTO distrito VALUES('150602', 'Atavillos Alto', '1506', '15');
INSERT INTO distrito VALUES('150603', 'Atavillos Bajo', '1506', '15');
INSERT INTO distrito VALUES('150604', 'Aucallama', '1506', '15');
INSERT INTO distrito VALUES('150605', 'Chancay', '1506', '15');
INSERT INTO distrito VALUES('150606', 'Ihuari', '1506', '15');
INSERT INTO distrito VALUES('150607', 'Lampian', '1506', '15');
INSERT INTO distrito VALUES('150608', 'Pacaraos', '1506', '15');
INSERT INTO distrito VALUES('150609', 'San Miguel de Acos', '1506', '15');
INSERT INTO distrito VALUES('150610', 'Santa Cruz de Andamarca', '1506', '15');
INSERT INTO distrito VALUES('150611', 'Sumbilca', '1506', '15');
INSERT INTO distrito VALUES('150612', 'Veintisiete de Noviembre', '1506', '15');
INSERT INTO distrito VALUES('150701', 'Matucana', '1507', '15');
INSERT INTO distrito VALUES('150702', 'Antioquia', '1507', '15');
INSERT INTO distrito VALUES('150703', 'Callahuanca', '1507', '15');
INSERT INTO distrito VALUES('150704', 'Carampoma', '1507', '15');
INSERT INTO distrito VALUES('150705', 'Chicla', '1507', '15');
INSERT INTO distrito VALUES('150706', 'Cuenca', '1507', '15');
INSERT INTO distrito VALUES('150707', 'Huachupampa', '1507', '15');
INSERT INTO distrito VALUES('150708', 'Huanza', '1507', '15');
INSERT INTO distrito VALUES('150709', 'Huarochiri', '1507', '15');
INSERT INTO distrito VALUES('150710', 'Lahuaytambo', '1507', '15');
INSERT INTO distrito VALUES('150711', 'Langa', '1507', '15');
INSERT INTO distrito VALUES('150712', 'Laraos', '1507', '15');
INSERT INTO distrito VALUES('150713', 'Mariatana', '1507', '15');
INSERT INTO distrito VALUES('150714', 'Ricardo Palma', '1507', '15');
INSERT INTO distrito VALUES('150715', 'San Andrés de Tupicocha', '1507', '15');
INSERT INTO distrito VALUES('150716', 'San Antonio', '1507', '15');
INSERT INTO distrito VALUES('150717', 'San Bartolomé', '1507', '15');
INSERT INTO distrito VALUES('150718', 'San Damian', '1507', '15');
INSERT INTO distrito VALUES('150719', 'San Juan de Iris', '1507', '15');
INSERT INTO distrito VALUES('150720', 'San Juan de Tantaranche', '1507', '15');
INSERT INTO distrito VALUES('150721', 'San Lorenzo de Quinti', '1507', '15');
INSERT INTO distrito VALUES('150722', 'San Mateo', '1507', '15');
INSERT INTO distrito VALUES('150723', 'San Mateo de Otao', '1507', '15');
INSERT INTO distrito VALUES('150724', 'San Pedro de Casta', '1507', '15');
INSERT INTO distrito VALUES('150725', 'San Pedro de Huancayre', '1507', '15');
INSERT INTO distrito VALUES('150726', 'Sangallaya', '1507', '15');
INSERT INTO distrito VALUES('150727', 'Santa Cruz de Cocachacra', '1507', '15');
INSERT INTO distrito VALUES('150728', 'Santa Eulalia', '1507', '15');
INSERT INTO distrito VALUES('150729', 'Santiago de Anchucaya', '1507', '15');
INSERT INTO distrito VALUES('150730', 'Santiago de Tuna', '1507', '15');
INSERT INTO distrito VALUES('150731', 'Santo Domingo de Los Olleros', '1507', '15');
INSERT INTO distrito VALUES('150732', 'Surco', '1507', '15');
INSERT INTO distrito VALUES('150801', 'Huacho', '1508', '15');
INSERT INTO distrito VALUES('150802', 'Ambar', '1508', '15');
INSERT INTO distrito VALUES('150803', 'Caleta de Carquin', '1508', '15');
INSERT INTO distrito VALUES('150804', 'Checras', '1508', '15');
INSERT INTO distrito VALUES('150805', 'Hualmay', '1508', '15');
INSERT INTO distrito VALUES('150806', 'Huaura', '1508', '15');
INSERT INTO distrito VALUES('150807', 'Leoncio Prado', '1508', '15');
INSERT INTO distrito VALUES('150808', 'Paccho', '1508', '15');
INSERT INTO distrito VALUES('150809', 'Santa Leonor', '1508', '15');
INSERT INTO distrito VALUES('150810', 'Santa María', '1508', '15');
INSERT INTO distrito VALUES('150811', 'Sayan', '1508', '15');
INSERT INTO distrito VALUES('150812', 'Vegueta', '1508', '15');
INSERT INTO distrito VALUES('150901', 'Oyon', '1509', '15');
INSERT INTO distrito VALUES('150902', 'Andajes', '1509', '15');
INSERT INTO distrito VALUES('150903', 'Caujul', '1509', '15');
INSERT INTO distrito VALUES('150904', 'Cochamarca', '1509', '15');
INSERT INTO distrito VALUES('150905', 'Navan', '1509', '15');
INSERT INTO distrito VALUES('150906', 'Pachangara', '1509', '15');
INSERT INTO distrito VALUES('151001', 'Yauyos', '1510', '15');
INSERT INTO distrito VALUES('151002', 'Alis', '1510', '15');
INSERT INTO distrito VALUES('151003', 'Allauca', '1510', '15');
INSERT INTO distrito VALUES('151004', 'Ayaviri', '1510', '15');
INSERT INTO distrito VALUES('151005', 'Azángaro', '1510', '15');
INSERT INTO distrito VALUES('151006', 'Cacra', '1510', '15');
INSERT INTO distrito VALUES('151007', 'Carania', '1510', '15');
INSERT INTO distrito VALUES('151008', 'Catahuasi', '1510', '15');
INSERT INTO distrito VALUES('151009', 'Chocos', '1510', '15');
INSERT INTO distrito VALUES('151010', 'Cochas', '1510', '15');
INSERT INTO distrito VALUES('151011', 'Colonia', '1510', '15');
INSERT INTO distrito VALUES('151012', 'Hongos', '1510', '15');
INSERT INTO distrito VALUES('151013', 'Huampara', '1510', '15');
INSERT INTO distrito VALUES('151014', 'Huancaya', '1510', '15');
INSERT INTO distrito VALUES('151015', 'Huangascar', '1510', '15');
INSERT INTO distrito VALUES('151016', 'Huantan', '1510', '15');
INSERT INTO distrito VALUES('151017', 'Huañec', '1510', '15');
INSERT INTO distrito VALUES('151018', 'Laraos', '1510', '15');
INSERT INTO distrito VALUES('151019', 'Lincha', '1510', '15');
INSERT INTO distrito VALUES('151020', 'Madean', '1510', '15');
INSERT INTO distrito VALUES('151021', 'Miraflores', '1510', '15');
INSERT INTO distrito VALUES('151022', 'Omas', '1510', '15');
INSERT INTO distrito VALUES('151023', 'Putinza', '1510', '15');
INSERT INTO distrito VALUES('151024', 'Quinches', '1510', '15');
INSERT INTO distrito VALUES('151025', 'Quinocay', '1510', '15');
INSERT INTO distrito VALUES('151026', 'San Joaquín', '1510', '15');
INSERT INTO distrito VALUES('151027', 'San Pedro de Pilas', '1510', '15');
INSERT INTO distrito VALUES('151028', 'Tanta', '1510', '15');
INSERT INTO distrito VALUES('151029', 'Tauripampa', '1510', '15');
INSERT INTO distrito VALUES('151030', 'Tomas', '1510', '15');
INSERT INTO distrito VALUES('151031', 'Tupe', '1510', '15');
INSERT INTO distrito VALUES('151032', 'Viñac', '1510', '15');
INSERT INTO distrito VALUES('151033', 'Vitis', '1510', '15');
INSERT INTO distrito VALUES('160101', 'Iquitos', '1601', '16');
INSERT INTO distrito VALUES('160102', 'Alto Nanay', '1601', '16');
INSERT INTO distrito VALUES('160103', 'Fernando Lores', '1601', '16');
INSERT INTO distrito VALUES('160104', 'Indiana', '1601', '16');
INSERT INTO distrito VALUES('160105', 'Las Amazonas', '1601', '16');
INSERT INTO distrito VALUES('160106', 'Mazan', '1601', '16');
INSERT INTO distrito VALUES('160107', 'Napo', '1601', '16');
INSERT INTO distrito VALUES('160108', 'Punchana', '1601', '16');
INSERT INTO distrito VALUES('160110', 'Torres Causana', '1601', '16');
INSERT INTO distrito VALUES('160112', 'Belén', '1601', '16');
INSERT INTO distrito VALUES('160113', 'San Juan Bautista', '1601', '16');
INSERT INTO distrito VALUES('160201', 'Yurimaguas', '1602', '16');
INSERT INTO distrito VALUES('160202', 'Balsapuerto', '1602', '16');
INSERT INTO distrito VALUES('160205', 'Jeberos', '1602', '16');
INSERT INTO distrito VALUES('160206', 'Lagunas', '1602', '16');
INSERT INTO distrito VALUES('160210', 'Santa Cruz', '1602', '16');
INSERT INTO distrito VALUES('160211', 'Teniente Cesar López Rojas', '1602', '16');
INSERT INTO distrito VALUES('160301', 'Nauta', '1603', '16');
INSERT INTO distrito VALUES('160302', 'Parinari', '1603', '16');
INSERT INTO distrito VALUES('160303', 'Tigre', '1603', '16');
INSERT INTO distrito VALUES('160304', 'Trompeteros', '1603', '16');
INSERT INTO distrito VALUES('160305', 'Urarinas', '1603', '16');
INSERT INTO distrito VALUES('160401', 'Ramón Castilla', '1604', '16');
INSERT INTO distrito VALUES('160402', 'Pebas', '1604', '16');
INSERT INTO distrito VALUES('160403', 'Yavari', '1604', '16');
INSERT INTO distrito VALUES('160404', 'San Pablo', '1604', '16');
INSERT INTO distrito VALUES('160501', 'Requena', '1605', '16');
INSERT INTO distrito VALUES('160502', 'Alto Tapiche', '1605', '16');
INSERT INTO distrito VALUES('160503', 'Capelo', '1605', '16');
INSERT INTO distrito VALUES('160504', 'Emilio San Martín', '1605', '16');
INSERT INTO distrito VALUES('160505', 'Maquia', '1605', '16');
INSERT INTO distrito VALUES('160506', 'Puinahua', '1605', '16');
INSERT INTO distrito VALUES('160507', 'Saquena', '1605', '16');
INSERT INTO distrito VALUES('160508', 'Soplin', '1605', '16');
INSERT INTO distrito VALUES('160509', 'Tapiche', '1605', '16');
INSERT INTO distrito VALUES('160510', 'Jenaro Herrera', '1605', '16');
INSERT INTO distrito VALUES('160511', 'Yaquerana', '1605', '16');
INSERT INTO distrito VALUES('160601', 'Contamana', '1606', '16');
INSERT INTO distrito VALUES('160602', 'Inahuaya', '1606', '16');
INSERT INTO distrito VALUES('160603', 'Padre Márquez', '1606', '16');
INSERT INTO distrito VALUES('160604', 'Pampa Hermosa', '1606', '16');
INSERT INTO distrito VALUES('160605', 'Sarayacu', '1606', '16');
INSERT INTO distrito VALUES('160606', 'Vargas Guerra', '1606', '16');
INSERT INTO distrito VALUES('160701', 'Barranca', '1607', '16');
INSERT INTO distrito VALUES('160702', 'Cahuapanas', '1607', '16');
INSERT INTO distrito VALUES('160703', 'Manseriche', '1607', '16');
INSERT INTO distrito VALUES('160704', 'Morona', '1607', '16');
INSERT INTO distrito VALUES('160705', 'Pastaza', '1607', '16');
INSERT INTO distrito VALUES('160706', 'Andoas', '1607', '16');
INSERT INTO distrito VALUES('160801', 'Putumayo', '1608', '16');
INSERT INTO distrito VALUES('160802', 'Rosa Panduro', '1608', '16');
INSERT INTO distrito VALUES('160803', 'Teniente Manuel Clavero', '1608', '16');
INSERT INTO distrito VALUES('160804', 'Yaguas', '1608', '16');
INSERT INTO distrito VALUES('170101', 'Tambopata', '1701', '17');
INSERT INTO distrito VALUES('170102', 'Inambari', '1701', '17');
INSERT INTO distrito VALUES('170103', 'Las Piedras', '1701', '17');
INSERT INTO distrito VALUES('170104', 'Laberinto', '1701', '17');
INSERT INTO distrito VALUES('170201', 'Manu', '1702', '17');
INSERT INTO distrito VALUES('170202', 'Fitzcarrald', '1702', '17');
INSERT INTO distrito VALUES('170203', 'Madre de Dios', '1702', '17');
INSERT INTO distrito VALUES('170204', 'Huepetuhe', '1702', '17');
INSERT INTO distrito VALUES('170301', 'Iñapari', '1703', '17');
INSERT INTO distrito VALUES('170302', 'Iberia', '1703', '17');
INSERT INTO distrito VALUES('170303', 'Tahuamanu', '1703', '17');
INSERT INTO distrito VALUES('180101', 'Moquegua', '1801', '18');
INSERT INTO distrito VALUES('180102', 'Carumas', '1801', '18');
INSERT INTO distrito VALUES('180103', 'Cuchumbaya', '1801', '18');
INSERT INTO distrito VALUES('180104', 'Samegua', '1801', '18');
INSERT INTO distrito VALUES('180105', 'San Cristóbal', '1801', '18');
INSERT INTO distrito VALUES('180106', 'Torata', '1801', '18');
INSERT INTO distrito VALUES('180201', 'Omate', '1802', '18');
INSERT INTO distrito VALUES('180202', 'Chojata', '1802', '18');
INSERT INTO distrito VALUES('180203', 'Coalaque', '1802', '18');
INSERT INTO distrito VALUES('180204', 'Ichuña', '1802', '18');
INSERT INTO distrito VALUES('180205', 'La Capilla', '1802', '18');
INSERT INTO distrito VALUES('180206', 'Lloque', '1802', '18');
INSERT INTO distrito VALUES('180207', 'Matalaque', '1802', '18');
INSERT INTO distrito VALUES('180208', 'Puquina', '1802', '18');
INSERT INTO distrito VALUES('180209', 'Quinistaquillas', '1802', '18');
INSERT INTO distrito VALUES('180210', 'Ubinas', '1802', '18');
INSERT INTO distrito VALUES('180211', 'Yunga', '1802', '18');
INSERT INTO distrito VALUES('180301', 'Ilo', '1803', '18');
INSERT INTO distrito VALUES('180302', 'El Algarrobal', '1803', '18');
INSERT INTO distrito VALUES('180303', 'Pacocha', '1803', '18');
INSERT INTO distrito VALUES('190101', 'Chaupimarca', '1901', '19');
INSERT INTO distrito VALUES('190102', 'Huachon', '1901', '19');
INSERT INTO distrito VALUES('190103', 'Huariaca', '1901', '19');
INSERT INTO distrito VALUES('190104', 'Huayllay', '1901', '19');
INSERT INTO distrito VALUES('190105', 'Ninacaca', '1901', '19');
INSERT INTO distrito VALUES('190106', 'Pallanchacra', '1901', '19');
INSERT INTO distrito VALUES('190107', 'Paucartambo', '1901', '19');
INSERT INTO distrito VALUES('190108', 'San Francisco de Asís de Yarusyacan', '1901', '19');
INSERT INTO distrito VALUES('190109', 'Simon Bolívar', '1901', '19');
INSERT INTO distrito VALUES('190110', 'Ticlacayan', '1901', '19');
INSERT INTO distrito VALUES('190111', 'Tinyahuarco', '1901', '19');
INSERT INTO distrito VALUES('190112', 'Vicco', '1901', '19');
INSERT INTO distrito VALUES('190113', 'Yanacancha', '1901', '19');
INSERT INTO distrito VALUES('190201', 'Yanahuanca', '1902', '19');
INSERT INTO distrito VALUES('190202', 'Chacayan', '1902', '19');
INSERT INTO distrito VALUES('190203', 'Goyllarisquizga', '1902', '19');
INSERT INTO distrito VALUES('190204', 'Paucar', '1902', '19');
INSERT INTO distrito VALUES('190205', 'San Pedro de Pillao', '1902', '19');
INSERT INTO distrito VALUES('190206', 'Santa Ana de Tusi', '1902', '19');
INSERT INTO distrito VALUES('190207', 'Tapuc', '1902', '19');
INSERT INTO distrito VALUES('190208', 'Vilcabamba', '1902', '19');
INSERT INTO distrito VALUES('190301', 'Oxapampa', '1903', '19');
INSERT INTO distrito VALUES('190302', 'Chontabamba', '1903', '19');
INSERT INTO distrito VALUES('190303', 'Huancabamba', '1903', '19');
INSERT INTO distrito VALUES('190304', 'Palcazu', '1903', '19');
INSERT INTO distrito VALUES('190305', 'Pozuzo', '1903', '19');
INSERT INTO distrito VALUES('190306', 'Puerto Bermúdez', '1903', '19');
INSERT INTO distrito VALUES('190307', 'Villa Rica', '1903', '19');
INSERT INTO distrito VALUES('190308', 'Constitución', '1903', '19');
INSERT INTO distrito VALUES('200101', 'Piura', '2001', '20');
INSERT INTO distrito VALUES('200104', 'Castilla', '2001', '20');
INSERT INTO distrito VALUES('200105', 'Catacaos', '2001', '20');
INSERT INTO distrito VALUES('200107', 'Cura Mori', '2001', '20');
INSERT INTO distrito VALUES('200108', 'El Tallan', '2001', '20');
INSERT INTO distrito VALUES('200109', 'La Arena', '2001', '20');
INSERT INTO distrito VALUES('200110', 'La Unión', '2001', '20');
INSERT INTO distrito VALUES('200111', 'Las Lomas', '2001', '20');
INSERT INTO distrito VALUES('200114', 'Tambo Grande', '2001', '20');
INSERT INTO distrito VALUES('200115', 'Veintiseis de Octubre', '2001', '20');
INSERT INTO distrito VALUES('200201', 'Ayabaca', '2002', '20');
INSERT INTO distrito VALUES('200202', 'Frias', '2002', '20');
INSERT INTO distrito VALUES('200203', 'Jilili', '2002', '20');
INSERT INTO distrito VALUES('200204', 'Lagunas', '2002', '20');
INSERT INTO distrito VALUES('200205', 'Montero', '2002', '20');
INSERT INTO distrito VALUES('200206', 'Pacaipampa', '2002', '20');
INSERT INTO distrito VALUES('200207', 'Paimas', '2002', '20');
INSERT INTO distrito VALUES('200208', 'Sapillica', '2002', '20');
INSERT INTO distrito VALUES('200209', 'Sicchez', '2002', '20');
INSERT INTO distrito VALUES('200210', 'Suyo', '2002', '20');
INSERT INTO distrito VALUES('200301', 'Huancabamba', '2003', '20');
INSERT INTO distrito VALUES('200302', 'Canchaque', '2003', '20');
INSERT INTO distrito VALUES('200303', 'El Carmen de la Frontera', '2003', '20');
INSERT INTO distrito VALUES('200304', 'Huarmaca', '2003', '20');
INSERT INTO distrito VALUES('200305', 'Lalaquiz', '2003', '20');
INSERT INTO distrito VALUES('200306', 'San Miguel de El Faique', '2003', '20');
INSERT INTO distrito VALUES('200307', 'Sondor', '2003', '20');
INSERT INTO distrito VALUES('200308', 'Sondorillo', '2003', '20');
INSERT INTO distrito VALUES('200401', 'Chulucanas', '2004', '20');
INSERT INTO distrito VALUES('200402', 'Buenos Aires', '2004', '20');
INSERT INTO distrito VALUES('200403', 'Chalaco', '2004', '20');
INSERT INTO distrito VALUES('200404', 'La Matanza', '2004', '20');
INSERT INTO distrito VALUES('200405', 'Morropon', '2004', '20');
INSERT INTO distrito VALUES('200406', 'Salitral', '2004', '20');
INSERT INTO distrito VALUES('200407', 'San Juan de Bigote', '2004', '20');
INSERT INTO distrito VALUES('200408', 'Santa Catalina de Mossa', '2004', '20');
INSERT INTO distrito VALUES('200409', 'Santo Domingo', '2004', '20');
INSERT INTO distrito VALUES('200410', 'Yamango', '2004', '20');
INSERT INTO distrito VALUES('200501', 'Paita', '2005', '20');
INSERT INTO distrito VALUES('200502', 'Amotape', '2005', '20');
INSERT INTO distrito VALUES('200503', 'Arenal', '2005', '20');
INSERT INTO distrito VALUES('200504', 'Colan', '2005', '20');
INSERT INTO distrito VALUES('200505', 'La Huaca', '2005', '20');
INSERT INTO distrito VALUES('200506', 'Tamarindo', '2005', '20');
INSERT INTO distrito VALUES('200507', 'Vichayal', '2005', '20');
INSERT INTO distrito VALUES('200601', 'Sullana', '2006', '20');
INSERT INTO distrito VALUES('200602', 'Bellavista', '2006', '20');
INSERT INTO distrito VALUES('200603', 'Ignacio Escudero', '2006', '20');
INSERT INTO distrito VALUES('200604', 'Lancones', '2006', '20');
INSERT INTO distrito VALUES('200605', 'Marcavelica', '2006', '20');
INSERT INTO distrito VALUES('200606', 'Miguel Checa', '2006', '20');
INSERT INTO distrito VALUES('200607', 'Querecotillo', '2006', '20');
INSERT INTO distrito VALUES('200608', 'Salitral', '2006', '20');
INSERT INTO distrito VALUES('200701', 'Pariñas', '2007', '20');
INSERT INTO distrito VALUES('200702', 'El Alto', '2007', '20');
INSERT INTO distrito VALUES('200703', 'La Brea', '2007', '20');
INSERT INTO distrito VALUES('200704', 'Lobitos', '2007', '20');
INSERT INTO distrito VALUES('200705', 'Los Organos', '2007', '20');
INSERT INTO distrito VALUES('200706', 'Mancora', '2007', '20');
INSERT INTO distrito VALUES('200801', 'Sechura', '2008', '20');
INSERT INTO distrito VALUES('200802', 'Bellavista de la Unión', '2008', '20');
INSERT INTO distrito VALUES('200803', 'Bernal', '2008', '20');
INSERT INTO distrito VALUES('200804', 'Cristo Nos Valga', '2008', '20');
INSERT INTO distrito VALUES('200805', 'Vice', '2008', '20');
INSERT INTO distrito VALUES('200806', 'Rinconada Llicuar', '2008', '20');
INSERT INTO distrito VALUES('210101', 'Puno', '2101', '21');
INSERT INTO distrito VALUES('210102', 'Acora', '2101', '21');
INSERT INTO distrito VALUES('210103', 'Amantani', '2101', '21');
INSERT INTO distrito VALUES('210104', 'Atuncolla', '2101', '21');
INSERT INTO distrito VALUES('210105', 'Capachica', '2101', '21');
INSERT INTO distrito VALUES('210106', 'Chucuito', '2101', '21');
INSERT INTO distrito VALUES('210107', 'Coata', '2101', '21');
INSERT INTO distrito VALUES('210108', 'Huata', '2101', '21');
INSERT INTO distrito VALUES('210109', 'Mañazo', '2101', '21');
INSERT INTO distrito VALUES('210110', 'Paucarcolla', '2101', '21');
INSERT INTO distrito VALUES('210111', 'Pichacani', '2101', '21');
INSERT INTO distrito VALUES('210112', 'Plateria', '2101', '21');
INSERT INTO distrito VALUES('210113', 'San Antonio', '2101', '21');
INSERT INTO distrito VALUES('210114', 'Tiquillaca', '2101', '21');
INSERT INTO distrito VALUES('210115', 'Vilque', '2101', '21');
INSERT INTO distrito VALUES('210201', 'Azángaro', '2102', '21');
INSERT INTO distrito VALUES('210202', 'Achaya', '2102', '21');
INSERT INTO distrito VALUES('210203', 'Arapa', '2102', '21');
INSERT INTO distrito VALUES('210204', 'Asillo', '2102', '21');
INSERT INTO distrito VALUES('210205', 'Caminaca', '2102', '21');
INSERT INTO distrito VALUES('210206', 'Chupa', '2102', '21');
INSERT INTO distrito VALUES('210207', 'José Domingo Choquehuanca', '2102', '21');
INSERT INTO distrito VALUES('210208', 'Muñani', '2102', '21');
INSERT INTO distrito VALUES('210209', 'Potoni', '2102', '21');
INSERT INTO distrito VALUES('210210', 'Saman', '2102', '21');
INSERT INTO distrito VALUES('210211', 'San Anton', '2102', '21');
INSERT INTO distrito VALUES('210212', 'San José', '2102', '21');
INSERT INTO distrito VALUES('210213', 'San Juan de Salinas', '2102', '21');
INSERT INTO distrito VALUES('210214', 'Santiago de Pupuja', '2102', '21');
INSERT INTO distrito VALUES('210215', 'Tirapata', '2102', '21');
INSERT INTO distrito VALUES('210301', 'Macusani', '2103', '21');
INSERT INTO distrito VALUES('210302', 'Ajoyani', '2103', '21');
INSERT INTO distrito VALUES('210303', 'Ayapata', '2103', '21');
INSERT INTO distrito VALUES('210304', 'Coasa', '2103', '21');
INSERT INTO distrito VALUES('210305', 'Corani', '2103', '21');
INSERT INTO distrito VALUES('210306', 'Crucero', '2103', '21');
INSERT INTO distrito VALUES('210307', 'Ituata', '2103', '21');
INSERT INTO distrito VALUES('210308', 'Ollachea', '2103', '21');
INSERT INTO distrito VALUES('210309', 'San Gaban', '2103', '21');
INSERT INTO distrito VALUES('210310', 'Usicayos', '2103', '21');
INSERT INTO distrito VALUES('210401', 'Juli', '2104', '21');
INSERT INTO distrito VALUES('210402', 'Desaguadero', '2104', '21');
INSERT INTO distrito VALUES('210403', 'Huacullani', '2104', '21');
INSERT INTO distrito VALUES('210404', 'Kelluyo', '2104', '21');
INSERT INTO distrito VALUES('210405', 'Pisacoma', '2104', '21');
INSERT INTO distrito VALUES('210406', 'Pomata', '2104', '21');
INSERT INTO distrito VALUES('210407', 'Zepita', '2104', '21');
INSERT INTO distrito VALUES('210501', 'Ilave', '2105', '21');
INSERT INTO distrito VALUES('210502', 'Capazo', '2105', '21');
INSERT INTO distrito VALUES('210503', 'Pilcuyo', '2105', '21');
INSERT INTO distrito VALUES('210504', 'Santa Rosa', '2105', '21');
INSERT INTO distrito VALUES('210505', 'Conduriri', '2105', '21');
INSERT INTO distrito VALUES('210601', 'Huancane', '2106', '21');
INSERT INTO distrito VALUES('210602', 'Cojata', '2106', '21');
INSERT INTO distrito VALUES('210603', 'Huatasani', '2106', '21');
INSERT INTO distrito VALUES('210604', 'Inchupalla', '2106', '21');
INSERT INTO distrito VALUES('210605', 'Pusi', '2106', '21');
INSERT INTO distrito VALUES('210606', 'Rosaspata', '2106', '21');
INSERT INTO distrito VALUES('210607', 'Taraco', '2106', '21');
INSERT INTO distrito VALUES('210608', 'Vilque Chico', '2106', '21');
INSERT INTO distrito VALUES('210701', 'Lampa', '2107', '21');
INSERT INTO distrito VALUES('210702', 'Cabanilla', '2107', '21');
INSERT INTO distrito VALUES('210703', 'Calapuja', '2107', '21');
INSERT INTO distrito VALUES('210704', 'Nicasio', '2107', '21');
INSERT INTO distrito VALUES('210705', 'Ocuviri', '2107', '21');
INSERT INTO distrito VALUES('210706', 'Palca', '2107', '21');
INSERT INTO distrito VALUES('210707', 'Paratia', '2107', '21');
INSERT INTO distrito VALUES('210708', 'Pucara', '2107', '21');
INSERT INTO distrito VALUES('210709', 'Santa Lucia', '2107', '21');
INSERT INTO distrito VALUES('210710', 'Vilavila', '2107', '21');
INSERT INTO distrito VALUES('210801', 'Ayaviri', '2108', '21');
INSERT INTO distrito VALUES('210802', 'Antauta', '2108', '21');
INSERT INTO distrito VALUES('210803', 'Cupi', '2108', '21');
INSERT INTO distrito VALUES('210804', 'Llalli', '2108', '21');
INSERT INTO distrito VALUES('210805', 'Macari', '2108', '21');
INSERT INTO distrito VALUES('210806', 'Nuñoa', '2108', '21');
INSERT INTO distrito VALUES('210807', 'Orurillo', '2108', '21');
INSERT INTO distrito VALUES('210808', 'Santa Rosa', '2108', '21');
INSERT INTO distrito VALUES('210809', 'Umachiri', '2108', '21');
INSERT INTO distrito VALUES('210901', 'Moho', '2109', '21');
INSERT INTO distrito VALUES('210902', 'Conima', '2109', '21');
INSERT INTO distrito VALUES('210903', 'Huayrapata', '2109', '21');
INSERT INTO distrito VALUES('210904', 'Tilali', '2109', '21');
INSERT INTO distrito VALUES('211001', 'Putina', '2110', '21');
INSERT INTO distrito VALUES('211002', 'Ananea', '2110', '21');
INSERT INTO distrito VALUES('211003', 'Pedro Vilca Apaza', '2110', '21');
INSERT INTO distrito VALUES('211004', 'Quilcapuncu', '2110', '21');
INSERT INTO distrito VALUES('211005', 'Sina', '2110', '21');
INSERT INTO distrito VALUES('211101', 'Juliaca', '2111', '21');
INSERT INTO distrito VALUES('211102', 'Cabana', '2111', '21');
INSERT INTO distrito VALUES('211103', 'Cabanillas', '2111', '21');
INSERT INTO distrito VALUES('211104', 'Caracoto', '2111', '21');
INSERT INTO distrito VALUES('211105', 'San Miguel', '2111', '21');
INSERT INTO distrito VALUES('211201', 'Sandia', '2112', '21');
INSERT INTO distrito VALUES('211202', 'Cuyocuyo', '2112', '21');
INSERT INTO distrito VALUES('211203', 'Limbani', '2112', '21');
INSERT INTO distrito VALUES('211204', 'Patambuco', '2112', '21');
INSERT INTO distrito VALUES('211205', 'Phara', '2112', '21');
INSERT INTO distrito VALUES('211206', 'Quiaca', '2112', '21');
INSERT INTO distrito VALUES('211207', 'San Juan del Oro', '2112', '21');
INSERT INTO distrito VALUES('211208', 'Yanahuaya', '2112', '21');
INSERT INTO distrito VALUES('211209', 'Alto Inambari', '2112', '21');
INSERT INTO distrito VALUES('211210', 'San Pedro de Putina Punco', '2112', '21');
INSERT INTO distrito VALUES('211301', 'Yunguyo', '2113', '21');
INSERT INTO distrito VALUES('211302', 'Anapia', '2113', '21');
INSERT INTO distrito VALUES('211303', 'Copani', '2113', '21');
INSERT INTO distrito VALUES('211304', 'Cuturapi', '2113', '21');
INSERT INTO distrito VALUES('211305', 'Ollaraya', '2113', '21');
INSERT INTO distrito VALUES('211306', 'Tinicachi', '2113', '21');
INSERT INTO distrito VALUES('211307', 'Unicachi', '2113', '21');
INSERT INTO distrito VALUES('220101', 'Moyobamba', '2201', '22');
INSERT INTO distrito VALUES('220102', 'Calzada', '2201', '22');
INSERT INTO distrito VALUES('220103', 'Habana', '2201', '22');
INSERT INTO distrito VALUES('220104', 'Jepelacio', '2201', '22');
INSERT INTO distrito VALUES('220105', 'Soritor', '2201', '22');
INSERT INTO distrito VALUES('220106', 'Yantalo', '2201', '22');
INSERT INTO distrito VALUES('220201', 'Bellavista', '2202', '22');
INSERT INTO distrito VALUES('220202', 'Alto Biavo', '2202', '22');
INSERT INTO distrito VALUES('220203', 'Bajo Biavo', '2202', '22');
INSERT INTO distrito VALUES('220204', 'Huallaga', '2202', '22');
INSERT INTO distrito VALUES('220205', 'San Pablo', '2202', '22');
INSERT INTO distrito VALUES('220206', 'San Rafael', '2202', '22');
INSERT INTO distrito VALUES('220301', 'San José de Sisa', '2203', '22');
INSERT INTO distrito VALUES('220302', 'Agua Blanca', '2203', '22');
INSERT INTO distrito VALUES('220303', 'San Martín', '2203', '22');
INSERT INTO distrito VALUES('220304', 'Santa Rosa', '2203', '22');
INSERT INTO distrito VALUES('220305', 'Shatoja', '2203', '22');
INSERT INTO distrito VALUES('220401', 'Saposoa', '2204', '22');
INSERT INTO distrito VALUES('220402', 'Alto Saposoa', '2204', '22');
INSERT INTO distrito VALUES('220403', 'El Eslabón', '2204', '22');
INSERT INTO distrito VALUES('220404', 'Piscoyacu', '2204', '22');
INSERT INTO distrito VALUES('220405', 'Sacanche', '2204', '22');
INSERT INTO distrito VALUES('220406', 'Tingo de Saposoa', '2204', '22');
INSERT INTO distrito VALUES('220501', 'Lamas', '2205', '22');
INSERT INTO distrito VALUES('220502', 'Alonso de Alvarado', '2205', '22');
INSERT INTO distrito VALUES('220503', 'Barranquita', '2205', '22');
INSERT INTO distrito VALUES('220504', 'Caynarachi', '2205', '22');
INSERT INTO distrito VALUES('220505', 'Cuñumbuqui', '2205', '22');
INSERT INTO distrito VALUES('220506', 'Pinto Recodo', '2205', '22');
INSERT INTO distrito VALUES('220507', 'Rumisapa', '2205', '22');
INSERT INTO distrito VALUES('220508', 'San Roque de Cumbaza', '2205', '22');
INSERT INTO distrito VALUES('220509', 'Shanao', '2205', '22');
INSERT INTO distrito VALUES('220510', 'Tabalosos', '2205', '22');
INSERT INTO distrito VALUES('220511', 'Zapatero', '2205', '22');
INSERT INTO distrito VALUES('220601', 'Juanjuí', '2206', '22');
INSERT INTO distrito VALUES('220602', 'Campanilla', '2206', '22');
INSERT INTO distrito VALUES('220603', 'Huicungo', '2206', '22');
INSERT INTO distrito VALUES('220604', 'Pachiza', '2206', '22');
INSERT INTO distrito VALUES('220605', 'Pajarillo', '2206', '22');
INSERT INTO distrito VALUES('220701', 'Picota', '2207', '22');
INSERT INTO distrito VALUES('220702', 'Buenos Aires', '2207', '22');
INSERT INTO distrito VALUES('220703', 'Caspisapa', '2207', '22');
INSERT INTO distrito VALUES('220704', 'Pilluana', '2207', '22');
INSERT INTO distrito VALUES('220705', 'Pucacaca', '2207', '22');
INSERT INTO distrito VALUES('220706', 'San Cristóbal', '2207', '22');
INSERT INTO distrito VALUES('220707', 'San Hilarión', '2207', '22');
INSERT INTO distrito VALUES('220708', 'Shamboyacu', '2207', '22');
INSERT INTO distrito VALUES('220709', 'Tingo de Ponasa', '2207', '22');
INSERT INTO distrito VALUES('220710', 'Tres Unidos', '2207', '22');
INSERT INTO distrito VALUES('220801', 'Rioja', '2208', '22');
INSERT INTO distrito VALUES('220802', 'Awajun', '2208', '22');
INSERT INTO distrito VALUES('220803', 'Elías Soplin Vargas', '2208', '22');
INSERT INTO distrito VALUES('220804', 'Nueva Cajamarca', '2208', '22');
INSERT INTO distrito VALUES('220805', 'Pardo Miguel', '2208', '22');
INSERT INTO distrito VALUES('220806', 'Posic', '2208', '22');
INSERT INTO distrito VALUES('220807', 'San Fernando', '2208', '22');
INSERT INTO distrito VALUES('220808', 'Yorongos', '2208', '22');
INSERT INTO distrito VALUES('220809', 'Yuracyacu', '2208', '22');
INSERT INTO distrito VALUES('220901', 'Tarapoto', '2209', '22');
INSERT INTO distrito VALUES('220902', 'Alberto Leveau', '2209', '22');
INSERT INTO distrito VALUES('220903', 'Cacatachi', '2209', '22');
INSERT INTO distrito VALUES('220904', 'Chazuta', '2209', '22');
INSERT INTO distrito VALUES('220905', 'Chipurana', '2209', '22');
INSERT INTO distrito VALUES('220906', 'El Porvenir', '2209', '22');
INSERT INTO distrito VALUES('220907', 'Huimbayoc', '2209', '22');
INSERT INTO distrito VALUES('220908', 'Juan Guerra', '2209', '22');
INSERT INTO distrito VALUES('220909', 'La Banda de Shilcayo', '2209', '22');
INSERT INTO distrito VALUES('220910', 'Morales', '2209', '22');
INSERT INTO distrito VALUES('220911', 'Papaplaya', '2209', '22');
INSERT INTO distrito VALUES('220912', 'San Antonio', '2209', '22');
INSERT INTO distrito VALUES('220913', 'Sauce', '2209', '22');
INSERT INTO distrito VALUES('220914', 'Shapaja', '2209', '22');
INSERT INTO distrito VALUES('221001', 'Tocache', '2210', '22');
INSERT INTO distrito VALUES('221002', 'Nuevo Progreso', '2210', '22');
INSERT INTO distrito VALUES('221003', 'Polvora', '2210', '22');
INSERT INTO distrito VALUES('221004', 'Shunte', '2210', '22');
INSERT INTO distrito VALUES('221005', 'Uchiza', '2210', '22');
INSERT INTO distrito VALUES('230101', 'Tacna', '2301', '23');
INSERT INTO distrito VALUES('230102', 'Alto de la Alianza', '2301', '23');
INSERT INTO distrito VALUES('230103', 'Calana', '2301', '23');
INSERT INTO distrito VALUES('230104', 'Ciudad Nueva', '2301', '23');
INSERT INTO distrito VALUES('230105', 'Inclan', '2301', '23');
INSERT INTO distrito VALUES('230106', 'Pachia', '2301', '23');
INSERT INTO distrito VALUES('230107', 'Palca', '2301', '23');
INSERT INTO distrito VALUES('230108', 'Pocollay', '2301', '23');
INSERT INTO distrito VALUES('230109', 'Sama', '2301', '23');
INSERT INTO distrito VALUES('230110', 'Coronel Gregorio Albarracín Lanchipa', '2301', '23');
INSERT INTO distrito VALUES('230111', 'La Yarada los Palos', '2301', '23');
INSERT INTO distrito VALUES('230201', 'Candarave', '2302', '23');
INSERT INTO distrito VALUES('230202', 'Cairani', '2302', '23');
INSERT INTO distrito VALUES('230203', 'Camilaca', '2302', '23');
INSERT INTO distrito VALUES('230204', 'Curibaya', '2302', '23');
INSERT INTO distrito VALUES('230205', 'Huanuara', '2302', '23');
INSERT INTO distrito VALUES('230206', 'Quilahuani', '2302', '23');
INSERT INTO distrito VALUES('230301', 'Locumba', '2303', '23');
INSERT INTO distrito VALUES('230302', 'Ilabaya', '2303', '23');
INSERT INTO distrito VALUES('230303', 'Ite', '2303', '23');
INSERT INTO distrito VALUES('230401', 'Tarata', '2304', '23');
INSERT INTO distrito VALUES('230402', 'Héroes Albarracín', '2304', '23');
INSERT INTO distrito VALUES('230403', 'Estique', '2304', '23');
INSERT INTO distrito VALUES('230404', 'Estique-Pampa', '2304', '23');
INSERT INTO distrito VALUES('230405', 'Sitajara', '2304', '23');
INSERT INTO distrito VALUES('230406', 'Susapaya', '2304', '23');
INSERT INTO distrito VALUES('230407', 'Tarucachi', '2304', '23');
INSERT INTO distrito VALUES('230408', 'Ticaco', '2304', '23');
INSERT INTO distrito VALUES('240101', 'Tumbes', '2401', '24');
INSERT INTO distrito VALUES('240102', 'Corrales', '2401', '24');
INSERT INTO distrito VALUES('240103', 'La Cruz', '2401', '24');
INSERT INTO distrito VALUES('240104', 'Pampas de Hospital', '2401', '24');
INSERT INTO distrito VALUES('240105', 'San Jacinto', '2401', '24');
INSERT INTO distrito VALUES('240106', 'San Juan de la Virgen', '2401', '24');
INSERT INTO distrito VALUES('240201', 'Zorritos', '2402', '24');
INSERT INTO distrito VALUES('240202', 'Casitas', '2402', '24');
INSERT INTO distrito VALUES('240203', 'Canoas de Punta Sal', '2402', '24');
INSERT INTO distrito VALUES('240301', 'Zarumilla', '2403', '24');
INSERT INTO distrito VALUES('240302', 'Aguas Verdes', '2403', '24');
INSERT INTO distrito VALUES('240303', 'Matapalo', '2403', '24');
INSERT INTO distrito VALUES('240304', 'Papayal', '2403', '24');
INSERT INTO distrito VALUES('250101', 'Calleria', '2501', '25');
INSERT INTO distrito VALUES('250102', 'Campoverde', '2501', '25');
INSERT INTO distrito VALUES('250103', 'Iparia', '2501', '25');
INSERT INTO distrito VALUES('250104', 'Masisea', '2501', '25');
INSERT INTO distrito VALUES('250105', 'Yarinacocha', '2501', '25');
INSERT INTO distrito VALUES('250106', 'Nueva Requena', '2501', '25');
INSERT INTO distrito VALUES('250107', 'Manantay', '2501', '25');
INSERT INTO distrito VALUES('250201', 'Raymondi', '2502', '25');
INSERT INTO distrito VALUES('250202', 'Sepahua', '2502', '25');
INSERT INTO distrito VALUES('250203', 'Tahuania', '2502', '25');
INSERT INTO distrito VALUES('250204', 'Yurua', '2502', '25');
INSERT INTO distrito VALUES('250301', 'Padre Abad', '2503', '25');
INSERT INTO distrito VALUES('250302', 'Irazola', '2503', '25');
INSERT INTO distrito VALUES('250303', 'Curimana', '2503', '25');
INSERT INTO distrito VALUES('250304', 'Neshuya', '2503', '25');
INSERT INTO distrito VALUES('250305', 'Alexander Von Humboldt', '2503', '25');
INSERT INTO distrito VALUES('250401', 'Purus', '2504', '25');

DROP TABLE IF EXISTS historial;
CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) NOT NULL,
  `fecha_consumo` date NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_plazo` date NOT NULL,
  `deuda` decimal(12,2) NOT NULL,
  `abono` decimal(12,2) NOT NULL,
  `saldo` decimal(12,2) NOT NULL,
  `vuelto` decimal(12,2) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `Opcion` varchar(10) NOT NULL DEFAULT 'Creado',
  PRIMARY KEY (`idhistorial`),
  KEY `idcliente` (`idcliente`),
  KEY `idusuario` (`idusuario`),
  KEY `idpago` (`idpago`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
INSERT INTO historial VALUES('1', 'Plataforma web', '2024-02-28', '2024-03-12', '0000-00-00', '30.00', '50.00', '0.00', '20.00', '11', '3', '1', 'Cancelado', 'Creado');
INSERT INTO historial VALUES('2', 'Plataforma web', '2024-03-28', '2024-04-10', '0000-00-00', '35.00', '20.00', '15.00', '0.00', '13', '3', '1', 'Pendiente', 'Creado');
INSERT INTO historial VALUES('3', 'Plataforma web', '2024-03-28', '2024-04-11', '0000-00-00', '35.00', '20.00', '15.00', '0.00', '5', '3', '1', 'Pendiente', 'Creado');
INSERT INTO historial VALUES('4', 'Plataforma web', '2024-03-28', '2024-05-07', '0000-00-00', '35.00', '35.00', '0.00', '0.00', '5', '2', '1', 'Cancelado', 'Editado');
INSERT INTO historial VALUES('5', 'Plataforma web', '2024-04-28', '2024-05-08', '0000-00-00', '40.00', '20.00', '20.00', '0.00', '1', '2', '1', 'Pendiente', 'Creado');
INSERT INTO historial VALUES('6', 'Plataforma web', '2024-04-28', '2024-05-29', '0000-00-00', '40.00', '40.00', '0.00', '0.00', '1', '3', '1', 'Cancelado', 'Editado');

DROP TABLE IF EXISTS marca;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
INSERT INTO marca VALUES('1', 'Epson');
INSERT INTO marca VALUES('2', 'HP');
INSERT INTO marca VALUES('3', 'Canon');
INSERT INTO marca VALUES('4', 'Brother');

DROP TABLE IF EXISTS movimiento;
CREATE TABLE `movimiento` (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(12,0) NOT NULL DEFAULT 0,
  `precio_compra` decimal(12,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `lote` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `idcompra` int(11) DEFAULT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) NOT NULL,
  `idtipo_movim` int(11) NOT NULL,
  PRIMARY KEY (`idmovimiento`),
  KEY `idproducto` (`idproducto`),
  KEY `idtipo_movim` (`idtipo_movim`),
  KEY `idcompra` (`idcompra`),
  KEY `idventa` (`idventa`),
  CONSTRAINT `FK_movimiento_compra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_movimiento_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idprod`),
  CONSTRAINT `FK_movimiento_tipo_movimiento` FOREIGN KEY (`idtipo_movim`) REFERENCES `tipo_movimiento` (`id_movi`),
  CONSTRAINT `FK_movimiento_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS permisos;
CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
INSERT INTO permisos VALUES('1', 'Escritorio');
INSERT INTO permisos VALUES('2', 'Almacen');

DROP TABLE IF EXISTS producto;
CREATE TABLE `producto` (
  `idprod` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `presentacion` varchar(100) NOT NULL,
  `precio_compra` double(12,2) NOT NULL,
  `precio_venta` double(12,2) NOT NULL,
  `stock` int(100) NOT NULL DEFAULT 0,
  `stock_minimo` int(100) NOT NULL DEFAULT 5,
  `imagen` varchar(30) NOT NULL DEFAULT 'prod_default.png',
  `idmarca` int(11) NOT NULL,
  `idcat` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idprod`),
  KEY `idmarca` (`idmarca`),
  KEY `idcat` (`idcat`),
  CONSTRAINT `FK_producto_categoria` FOREIGN KEY (`idcat`) REFERENCES `categoria` (`idcat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_producto_marca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
INSERT INTO producto VALUES('1', 'P001', 'Tinta para impresora', 'Tinta para impresora de color amarillo, contenido 65ml', 'BOTELLA DE TINTA EPSON AMARILLO T544 -320', '48.00', '38.00', '8', '5', 'prod_default.png', '1', '2', 'A');
INSERT INTO producto VALUES('2', 'P002', 'Tinta para impresora', 'Tinta para impresora de color cian, contenido 65ml', 'BOTELLA DE TINTA EPSON CIAN T544 -320', '45.00', '38.00', '20', '5', 'prod_default.png', '1', '2', 'A');
INSERT INTO producto VALUES('3', 'P003', 'Tinta para impresora', 'Tinta para impresora de color magenta, contenido 65ml', 'BOTELLA DE TINTA EPSON MAGENTA T544 -320', '45.00', '38.00', '10', '5', 'prod_default.png', '1', '2', 'A');
INSERT INTO producto VALUES('4', 'P004', 'Tinta para impresora', 'Tinta para impresora de color negro, contenido 65ml', 'BOTELLA DE TINTA EPSON NEGRO T544 -120', '45.00', '38.00', '10', '5', 'prod_default.png', '1', '2', 'A');

DROP TABLE IF EXISTS proveedor;
CREATE TABLE `proveedor` (
  `idprovee` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` int(12) NOT NULL DEFAULT 0,
  `razon_social` varchar(100) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `telefono` char(20) NOT NULL DEFAULT '',
  `correo` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(20) NOT NULL DEFAULT 'provee_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idprovee`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
INSERT INTO proveedor VALUES('1', '2147483647', 'Naypaqman sac', 'null', 'null', 'naypaqman@gmail.com', 'provee_default.png', 'A');

DROP TABLE IF EXISTS provincia;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departamento` (`id_departamento`),
  CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2505 DEFAULT CHARSET=utf8mb4;
INSERT INTO provincia VALUES('101', 'Chachapoyas', '1');
INSERT INTO provincia VALUES('102', 'Bagua', '1');
INSERT INTO provincia VALUES('103', 'Bongará', '1');
INSERT INTO provincia VALUES('104', 'Condorcanqui', '1');
INSERT INTO provincia VALUES('105', 'Luya', '1');
INSERT INTO provincia VALUES('106', 'Rodríguez de Mendoza', '1');
INSERT INTO provincia VALUES('107', 'Utcubamba', '1');
INSERT INTO provincia VALUES('201', 'Huaraz', '2');
INSERT INTO provincia VALUES('202', 'Aija', '2');
INSERT INTO provincia VALUES('203', 'Antonio Raymondi', '2');
INSERT INTO provincia VALUES('204', 'Asunción', '2');
INSERT INTO provincia VALUES('205', 'Bolognesi', '2');
INSERT INTO provincia VALUES('206', 'Carhuaz', '2');
INSERT INTO provincia VALUES('207', 'Carlos Fermín Fitzcarrald', '2');
INSERT INTO provincia VALUES('208', 'Casma', '2');
INSERT INTO provincia VALUES('209', 'Corongo', '2');
INSERT INTO provincia VALUES('210', 'Huari', '2');
INSERT INTO provincia VALUES('211', 'Huarmey', '2');
INSERT INTO provincia VALUES('212', 'Huaylas', '2');
INSERT INTO provincia VALUES('213', 'Mariscal Luzuriaga', '2');
INSERT INTO provincia VALUES('214', 'Ocros', '2');
INSERT INTO provincia VALUES('215', 'Pallasca', '2');
INSERT INTO provincia VALUES('216', 'Pomabamba', '2');
INSERT INTO provincia VALUES('217', 'Recuay', '2');
INSERT INTO provincia VALUES('218', 'Santa', '2');
INSERT INTO provincia VALUES('219', 'Sihuas', '2');
INSERT INTO provincia VALUES('220', 'Yungay', '2');
INSERT INTO provincia VALUES('301', 'Abancay', '3');
INSERT INTO provincia VALUES('302', 'Andahuaylas', '3');
INSERT INTO provincia VALUES('303', 'Antabamba', '3');
INSERT INTO provincia VALUES('304', 'Aymaraes', '3');
INSERT INTO provincia VALUES('305', 'Cotabambas', '3');
INSERT INTO provincia VALUES('306', 'Chincheros', '3');
INSERT INTO provincia VALUES('307', 'Grau', '3');
INSERT INTO provincia VALUES('401', 'Arequipa', '4');
INSERT INTO provincia VALUES('402', 'Camaná', '4');
INSERT INTO provincia VALUES('403', 'Caravelí', '4');
INSERT INTO provincia VALUES('404', 'Castilla', '4');
INSERT INTO provincia VALUES('405', 'Caylloma', '4');
INSERT INTO provincia VALUES('406', 'Condesuyos', '4');
INSERT INTO provincia VALUES('407', 'Islay', '4');
INSERT INTO provincia VALUES('408', 'La Uniòn', '4');
INSERT INTO provincia VALUES('501', 'Huamanga', '5');
INSERT INTO provincia VALUES('502', 'Cangallo', '5');
INSERT INTO provincia VALUES('503', 'Huanca Sancos', '5');
INSERT INTO provincia VALUES('504', 'Huanta', '5');
INSERT INTO provincia VALUES('505', 'La Mar', '5');
INSERT INTO provincia VALUES('506', 'Lucanas', '5');
INSERT INTO provincia VALUES('507', 'Parinacochas', '5');
INSERT INTO provincia VALUES('508', 'Pàucar del Sara Sara', '5');
INSERT INTO provincia VALUES('509', 'Sucre', '5');
INSERT INTO provincia VALUES('510', 'Víctor Fajardo', '5');
INSERT INTO provincia VALUES('511', 'Vilcas Huamán', '5');
INSERT INTO provincia VALUES('601', 'Cajamarca', '6');
INSERT INTO provincia VALUES('602', 'Cajabamba', '6');
INSERT INTO provincia VALUES('603', 'Celendín', '6');
INSERT INTO provincia VALUES('604', 'Chota', '6');
INSERT INTO provincia VALUES('605', 'Contumazá', '6');
INSERT INTO provincia VALUES('606', 'Cutervo', '6');
INSERT INTO provincia VALUES('607', 'Hualgayoc', '6');
INSERT INTO provincia VALUES('608', 'Jaén', '6');
INSERT INTO provincia VALUES('609', 'San Ignacio', '6');
INSERT INTO provincia VALUES('610', 'San Marcos', '6');
INSERT INTO provincia VALUES('611', 'San Miguel', '6');
INSERT INTO provincia VALUES('612', 'San Pablo', '6');
INSERT INTO provincia VALUES('613', 'Santa Cruz', '6');
INSERT INTO provincia VALUES('701', 'Prov. Const. del Callao', '7');
INSERT INTO provincia VALUES('801', 'Cusco', '8');
INSERT INTO provincia VALUES('802', 'Acomayo', '8');
INSERT INTO provincia VALUES('803', 'Anta', '8');
INSERT INTO provincia VALUES('804', 'Calca', '8');
INSERT INTO provincia VALUES('805', 'Canas', '8');
INSERT INTO provincia VALUES('806', 'Canchis', '8');
INSERT INTO provincia VALUES('807', 'Chumbivilcas', '8');
INSERT INTO provincia VALUES('808', 'Espinar', '8');
INSERT INTO provincia VALUES('809', 'La Convención', '8');
INSERT INTO provincia VALUES('810', 'Paruro', '8');
INSERT INTO provincia VALUES('811', 'Paucartambo', '8');
INSERT INTO provincia VALUES('812', 'Quispicanchi', '8');
INSERT INTO provincia VALUES('813', 'Urubamba', '8');
INSERT INTO provincia VALUES('901', 'Huancavelica', '9');
INSERT INTO provincia VALUES('902', 'Acobamba', '9');
INSERT INTO provincia VALUES('903', 'Angaraes', '9');
INSERT INTO provincia VALUES('904', 'Castrovirreyna', '9');
INSERT INTO provincia VALUES('905', 'Churcampa', '9');
INSERT INTO provincia VALUES('906', 'Huaytará', '9');
INSERT INTO provincia VALUES('907', 'Tayacaja', '9');
INSERT INTO provincia VALUES('1001', 'Huánuco', '10');
INSERT INTO provincia VALUES('1002', 'Ambo', '10');
INSERT INTO provincia VALUES('1003', 'Dos de Mayo', '10');
INSERT INTO provincia VALUES('1004', 'Huacaybamba', '10');
INSERT INTO provincia VALUES('1005', 'Huamalíes', '10');
INSERT INTO provincia VALUES('1006', 'Leoncio Prado', '10');
INSERT INTO provincia VALUES('1007', 'Marañón', '10');
INSERT INTO provincia VALUES('1008', 'Pachitea', '10');
INSERT INTO provincia VALUES('1009', 'Puerto Inca', '10');
INSERT INTO provincia VALUES('1010', 'Lauricocha ', '10');
INSERT INTO provincia VALUES('1011', 'Yarowilca ', '10');
INSERT INTO provincia VALUES('1101', 'Ica ', '11');
INSERT INTO provincia VALUES('1102', 'Chincha ', '11');
INSERT INTO provincia VALUES('1103', 'Nasca ', '11');
INSERT INTO provincia VALUES('1104', 'Palpa ', '11');
INSERT INTO provincia VALUES('1105', 'Pisco ', '11');
INSERT INTO provincia VALUES('1201', 'Huancayo ', '12');
INSERT INTO provincia VALUES('1202', 'Concepción ', '12');
INSERT INTO provincia VALUES('1203', 'Chanchamayo ', '12');
INSERT INTO provincia VALUES('1204', 'Jauja ', '12');
INSERT INTO provincia VALUES('1205', 'Junín ', '12');
INSERT INTO provincia VALUES('1206', 'Satipo ', '12');
INSERT INTO provincia VALUES('1207', 'Tarma ', '12');
INSERT INTO provincia VALUES('1208', 'Yauli ', '12');
INSERT INTO provincia VALUES('1209', 'Chupaca ', '12');
INSERT INTO provincia VALUES('1301', 'Trujillo ', '13');
INSERT INTO provincia VALUES('1302', 'Ascope ', '13');
INSERT INTO provincia VALUES('1303', 'Bolívar ', '13');
INSERT INTO provincia VALUES('1304', 'Chepén ', '13');
INSERT INTO provincia VALUES('1305', 'Julcán ', '13');
INSERT INTO provincia VALUES('1306', 'Otuzco ', '13');
INSERT INTO provincia VALUES('1307', 'Pacasmayo ', '13');
INSERT INTO provincia VALUES('1308', 'Pataz ', '13');
INSERT INTO provincia VALUES('1309', 'Sánchez Carrión ', '13');
INSERT INTO provincia VALUES('1310', 'Santiago de Chuco ', '13');
INSERT INTO provincia VALUES('1311', 'Gran Chimú ', '13');
INSERT INTO provincia VALUES('1312', 'Virú ', '13');
INSERT INTO provincia VALUES('1401', 'Chiclayo ', '14');
INSERT INTO provincia VALUES('1402', 'Ferreñafe ', '14');
INSERT INTO provincia VALUES('1403', 'Lambayeque ', '14');
INSERT INTO provincia VALUES('1501', 'Lima ', '15');
INSERT INTO provincia VALUES('1502', 'Barranca ', '15');
INSERT INTO provincia VALUES('1503', 'Cajatambo ', '15');
INSERT INTO provincia VALUES('1504', 'Canta ', '15');
INSERT INTO provincia VALUES('1505', 'Cañete ', '15');
INSERT INTO provincia VALUES('1506', 'Huaral ', '15');
INSERT INTO provincia VALUES('1507', 'Huarochirí ', '15');
INSERT INTO provincia VALUES('1508', 'Huaura ', '15');
INSERT INTO provincia VALUES('1509', 'Oyón ', '15');
INSERT INTO provincia VALUES('1510', 'Yauyos ', '15');
INSERT INTO provincia VALUES('1601', 'Maynas ', '16');
INSERT INTO provincia VALUES('1602', 'Alto Amazonas ', '16');
INSERT INTO provincia VALUES('1603', 'Loreto ', '16');
INSERT INTO provincia VALUES('1604', 'Mariscal Ramón Castilla ', '16');
INSERT INTO provincia VALUES('1605', 'Requena ', '16');
INSERT INTO provincia VALUES('1606', 'Ucayali ', '16');
INSERT INTO provincia VALUES('1607', 'Datem del Marañón ', '16');
INSERT INTO provincia VALUES('1608', 'Putumayo', '16');
INSERT INTO provincia VALUES('1701', 'Tambopata ', '17');
INSERT INTO provincia VALUES('1702', 'Manu ', '17');
INSERT INTO provincia VALUES('1703', 'Tahuamanu ', '17');
INSERT INTO provincia VALUES('1801', 'Mariscal Nieto ', '18');
INSERT INTO provincia VALUES('1802', 'General Sánchez Cerro ', '18');
INSERT INTO provincia VALUES('1803', 'Ilo ', '18');
INSERT INTO provincia VALUES('1901', 'Pasco ', '19');
INSERT INTO provincia VALUES('1902', 'Daniel Alcides Carrión ', '19');
INSERT INTO provincia VALUES('1903', 'Oxapampa ', '19');
INSERT INTO provincia VALUES('2001', 'Piura ', '20');
INSERT INTO provincia VALUES('2002', 'Ayabaca ', '20');
INSERT INTO provincia VALUES('2003', 'Huancabamba ', '20');
INSERT INTO provincia VALUES('2004', 'Morropón ', '20');
INSERT INTO provincia VALUES('2005', 'Paita ', '20');
INSERT INTO provincia VALUES('2006', 'Sullana ', '20');
INSERT INTO provincia VALUES('2007', 'Talara ', '20');
INSERT INTO provincia VALUES('2008', 'Sechura ', '20');
INSERT INTO provincia VALUES('2101', 'Puno ', '21');
INSERT INTO provincia VALUES('2102', 'Azángaro ', '21');
INSERT INTO provincia VALUES('2103', 'Carabaya ', '21');
INSERT INTO provincia VALUES('2104', 'Chucuito ', '21');
INSERT INTO provincia VALUES('2105', 'El Collao ', '21');
INSERT INTO provincia VALUES('2106', 'Huancané ', '21');
INSERT INTO provincia VALUES('2107', 'Lampa ', '21');
INSERT INTO provincia VALUES('2108', 'Melgar ', '21');
INSERT INTO provincia VALUES('2109', 'Moho ', '21');
INSERT INTO provincia VALUES('2110', 'San Antonio de Putina ', '21');
INSERT INTO provincia VALUES('2111', 'San Román ', '21');
INSERT INTO provincia VALUES('2112', 'Sandia ', '21');
INSERT INTO provincia VALUES('2113', 'Yunguyo ', '21');
INSERT INTO provincia VALUES('2201', 'Moyobamba ', '22');
INSERT INTO provincia VALUES('2202', 'Bellavista ', '22');
INSERT INTO provincia VALUES('2203', 'El Dorado ', '22');
INSERT INTO provincia VALUES('2204', 'Huallaga ', '22');
INSERT INTO provincia VALUES('2205', 'Lamas ', '22');
INSERT INTO provincia VALUES('2206', 'Mariscal Cáceres ', '22');
INSERT INTO provincia VALUES('2207', 'Picota ', '22');
INSERT INTO provincia VALUES('2208', 'Rioja ', '22');
INSERT INTO provincia VALUES('2209', 'San Martín ', '22');
INSERT INTO provincia VALUES('2210', 'Tocache ', '22');
INSERT INTO provincia VALUES('2301', 'Tacna ', '23');
INSERT INTO provincia VALUES('2302', 'Candarave ', '23');
INSERT INTO provincia VALUES('2303', 'Jorge Basadre ', '23');
INSERT INTO provincia VALUES('2304', 'Tarata ', '23');
INSERT INTO provincia VALUES('2401', 'Tumbes ', '24');
INSERT INTO provincia VALUES('2402', 'Contralmirante Villar ', '24');
INSERT INTO provincia VALUES('2403', 'Zarumilla ', '24');
INSERT INTO provincia VALUES('2501', 'Coronel Portillo ', '25');
INSERT INTO provincia VALUES('2502', 'Atalaya ', '25');
INSERT INTO provincia VALUES('2503', 'Padre Abad ', '25');
INSERT INTO provincia VALUES('2504', 'Purús', '25');

DROP TABLE IF EXISTS servicio;
CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `num_orden` varchar(10) NOT NULL,
  `articulo` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `serie` varchar(80) NOT NULL,
  `sintomas` varchar(255) NOT NULL,
  `diagnostico` varchar(255) NOT NULL,
  `num_ip` varchar(20) NOT NULL,
  `observacion` varchar(80) DEFAULT NULL,
  `imagen` varchar(20) NOT NULL DEFAULT 'serv_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
INSERT INTO servicio VALUES('3', '0001', 'Laptop', 'lenovo', 'GT-00987', '838747477', 'Falla de pantalla', 'necesita cambio de pantalla', '', 'Pantalla nueva', 'serv_default.png', 'A');
INSERT INTO servicio VALUES('4', '0002', 'Router', '', '', '', 'Parpadeo de luz roja', 'cambio de cable', '192.168.32.12', '', 'serv_default.png', 'A');
INSERT INTO servicio VALUES('5', '0003', 'Router', '', '', '', 'parpadeo de luz roja', 'cambio de cable', '192.168.23.1', '', 'serv_default.png', 'A');

DROP TABLE IF EXISTS tipo_documento;
CREATE TABLE `tipo_documento` (
  `idtipo_doc` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idtipo_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_documento VALUES('1', 'DNI');
INSERT INTO tipo_documento VALUES('2', 'RUC');
INSERT INTO tipo_documento VALUES('3', 'C/N');
INSERT INTO tipo_documento VALUES('4', 'U/N');

DROP TABLE IF EXISTS tipo_movimiento;
CREATE TABLE `tipo_movimiento` (
  `id_movi` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_movi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_movimiento VALUES('1', 'Entrada');
INSERT INTO tipo_movimiento VALUES('2', 'Salida');

DROP TABLE IF EXISTS tipo_pago;
CREATE TABLE `tipo_pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `avatar` varchar(80) NOT NULL DEFAULT 'pago_default.png',
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_pago VALUES('1', 'AGENTE BCP', '65a8853c67e64-bcp.png', 'A');
INSERT INTO tipo_pago VALUES('2', 'YAPE', '65a9743133697-yape.png', 'A');
INSERT INTO tipo_pago VALUES('3', 'EFECTIVO', '663be36d8fb99-Money.jpg', 'A');
INSERT INTO tipo_pago VALUES('4', 'TRANSFERENCIA', 'pago_default.png', 'I');
INSERT INTO tipo_pago VALUES('5', 'Ninguna', 'pago_default.png', 'A');
INSERT INTO tipo_pago VALUES('6', 'Plin', 'pago_default.png', 'A');

DROP TABLE IF EXISTS tipo_servicio;
CREATE TABLE `tipo_servicio` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_servicio VALUES('1', 'Soporte Técnico');
INSERT INTO tipo_servicio VALUES('2', 'Telecomunicacion');

DROP TABLE IF EXISTS tipo_usuario;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
INSERT INTO tipo_usuario VALUES('1', 'Administrador');
INSERT INTO tipo_usuario VALUES('2', 'Tecnico');
INSERT INTO tipo_usuario VALUES('3', 'Vendedor');

DROP TABLE IF EXISTS usuario;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documento` char(10) NOT NULL,
  `numero` varchar(8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` char(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `login` char(10) NOT NULL,
  `idtipo` int(11) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'user_default.png',
  `estado` char(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idusuario`),
  KEY `idtipoUser` (`idtipo`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipo_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
INSERT INTO usuario VALUES('1', 'Jefferson', 'Huaman Bernilla', 'DNI', '46544641', 'CAL.JOSE SUCRE MZA. G LOTE. 7 P.J. ERNESTO VILCHEZ ALARCON', '941984109', 'jeffersonhuaman@gmail.com', '12345', 'admin', '1', '663a8b4863091-avatar.png', 'A');
INSERT INTO usuario VALUES('5', 'MIGUEL', 'REYES SANCHEZ', 'DNI', '77356057', 'AV.EL CARMEN #430', '939580262', 'miguel@gmail.com', 'FZLJmybxb0xBWiTshCUPQA==', 'Tecnico', '2', '663a829518dce-avatar4.png', 'A');
INSERT INTO usuario VALUES('6', 'JEFFERSON NAPOLEON', 'HUAMAN BERNILLA', 'DNI', '46544645', 'C.POBLADO UYURPAMPA', '', '', '12345', 'Tecnico', '2', 'user_default.png', 'A');
INSERT INTO usuario VALUES('7', 'JULIA TEREZA', 'SANCHEZ BERNILLA', 'DNI', '41194558', 'PROLONG. AREQUIPA MZ F LT 4 ERNESTO VILCHEZ ALCANTARA', '', '', '123456', 'vendedor', '3', 'user_default.png', 'A');
INSERT INTO usuario VALUES('8', 'SILVIA', 'MENDOZA', 'U/N', '0', '', '', '', '123456', 'vendedor', '3', 'user_default.png', 'A');
INSERT INTO usuario VALUES('9', 'JESUS', 'DURAND GONZALES', 'DNI', '17446693', 'VILLA MERCEDES S/N P.JOVEN GONZALES PRADA', '', '', '123456', 'vendedor', '2', 'user_default.png', 'A');
INSERT INTO usuario VALUES('10', 'TATIANA AMAZONA', 'MENDOZA', 'DNI', '12345678', '', '', '', '123456', 'vendedor', '3', 'user_default.png', 'I');
INSERT INTO usuario VALUES('11', 'YUDIT MADALEYNE', 'AMAYA PENA', 'DNI', '48344811', 'CALLE FRANCISCO BOLOGNESI MZ I 1 LT 4', '', '', '1234567', 'vendedora', '3', 'user_default.png', 'A');

DROP TABLE IF EXISTS venta;
CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `idcliente` (`idcliente`),
  KEY `vendedor` (`vendedor`),
  CONSTRAINT `FK_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_venta_usuario` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

