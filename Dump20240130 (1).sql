CREATE DATABASE  IF NOT EXISTS `db_medico` ;
USE `db_medico`;

DROP TABLE IF EXISTS `cab_historial`;
CREATE TABLE `cab_historial` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `id_cita` int DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_historial`),
  KEY `id_usuario` (`id_usuario`),
  KEY `cab_historial_ibfk_2_idx` (`id_medico`),
  KEY `cab_historial_ibfk_3_idx` (`id_cita`),
  CONSTRAINT `cab_historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `cab_historial_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`),
  CONSTRAINT `cab_historial_ibfk_3` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
LOCK TABLES `cab_historial` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `cita`;

CREATE TABLE `cita` (
  `id_cita` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `fecha_hora_cita` datetime NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  `observacion` text,
  PRIMARY KEY (`id_cita`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=62776 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

UNLOCK TABLES;


DROP TABLE IF EXISTS `citas`;


DROP TABLE IF EXISTS `det_historial`;
CREATE TABLE `det_historial` (
  `id_detalle_historial` int NOT NULL AUTO_INCREMENT,
  `id_historial` int DEFAULT NULL,
  `informacion` text,
  `edad` int DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `estado_civil` varchar(45) DEFAULT NULL,
  `atecedentes` text,
  `medicamentos` int DEFAULT NULL,
  PRIMARY KEY (`id_detalle_historial`),
  KEY `id_historial` (`id_historial`),
  KEY `det_historial_ibfk_2_idx` (`medicamentos`),
  CONSTRAINT `det_historial_ibfk_1` FOREIGN KEY (`id_historial`) REFERENCES `cab_historial` (`id_historial`),
  CONSTRAINT `det_historial_ibfk_2` FOREIGN KEY (`medicamentos`) REFERENCES `medicamento` (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `det_historial` WRITE;
UNLOCK TABLES;


DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE `especialidad` (
  `id_especialidad` int NOT NULL AUTO_INCREMENT,
  `nombre_especialidad` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `especialidad` WRITE;
INSERT INTO `especialidad` VALUES (1,'podologia','2024-01-12 20:42:18',1),(2,'podologia','2024-01-15 21:08:37',1);
UNLOCK TABLES;


DROP TABLE IF EXISTS `medicamento`;;
CREATE TABLE `medicamento` (
  `id_medicamento` int NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `indicaciones` text,
  `stock` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `medicamento` WRITE;
INSERT INTO `medicamento` VALUES (1,'213',321.00,'213',213.00,'2024-01-28 17:09:42',1),(2,'213',3212.00,'213',213.00,'2024-01-28 17:10:29',1);
UNLOCK TABLES;


DROP TABLE IF EXISTS `medicamento_cita`;
CREATE TABLE `medicamento_cita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_medicamento` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `id_cita` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_medicamento` (`id_medicamento`),
  KEY `id_cita` (`id_cita`),
  CONSTRAINT `medicamento_cita_ibfk_1` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id_medicamento`),
  CONSTRAINT `medicamento_cita_ibfk_2` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `medicamento_cita` WRITE;
INSERT INTO `medicamento_cita` VALUES (15,1,321.00,20,62744),(16,1,321.00,20,62744),(17,1,321.00,20,62744),(18,1,321.00,2,62744),(21,1,321.00,20,62744);
UNLOCK TABLES;


DROP TABLE IF EXISTS `medico`;
CREATE TABLE `medico` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `img_medico` varchar(500) DEFAULT NULL,
  `especialidad_id` int DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  `medicocol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_medico`),
  KEY `id_usuario` (`id_usuario`),
  KEY `especialidad_id` (`especialidad_id`),
  CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `medico` WRITE;
INSERT INTO `medico` VALUES (1,6,'Sr',NULL,1,'2024-01-12 20:44:05',1,NULL),(2,1,'Bruno',NULL,1,'2024-01-12 21:30:19',1,NULL),(3,5,'Bruno Cordero',NULL,2,'2024-01-16 05:09:38',1,NULL),(4,3,'Bruno Mateo Cordero',NULL,2,'2024-01-16 05:13:16',1,NULL);
UNLOCK TABLES;


DROP TABLE IF EXISTS `receta`;
CREATE TABLE `receta` (
  `id_receta` int NOT NULL AUTO_INCREMENT,
  `id_historial` int DEFAULT NULL,
  `medicamentos` int DEFAULT NULL,
  `indicaciones` text,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_receta`),
  KEY `id_historial` (`id_historial`),
  KEY `medicamentos` (`medicamentos`),
  CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_historial`) REFERENCES `cab_historial` (`id_historial`),
  CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`medicamentos`) REFERENCES `medicamento` (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `receta` WRITE;
UNLOCK TABLES;

DROP TABLE IF EXISTS `signos_vitales`;
CREATE TABLE `signos_vitales` (
  `id_signos_vitales` int NOT NULL AUTO_INCREMENT,
  `id_historial` int DEFAULT NULL,
  `fecha_hora_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temperatura` decimal(4,2) DEFAULT NULL,
  `presion_arterial` varchar(15) DEFAULT NULL,
  `pulso` int DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int DEFAULT '1',
  PRIMARY KEY (`id_signos_vitales`),
  KEY `id_historial` (`id_historial`),
  CONSTRAINT `signos_vitales_ibfk_1` FOREIGN KEY (`id_historial`) REFERENCES `cab_historial` (`id_historial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `signos_vitales` WRITE;
UNLOCK TABLES;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('paciente','medico','admin') NOT NULL,
  `identicacion` varchar(45) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `tipo_identifacion` enum('ruc','cedula','pasaporte') NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seguro` double DEFAULT NULL,
  `estado` int DEFAULT '1',
  `medic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_medic`(
In _NOMBRE VARCHAR(250),
In _EMAIL VARCHAR(250),
In _PASSWORD VARCHAR(250),
IN _IDENTIDICACION VARCHAR(50),
IN _TELEFONO VARCHAR(50),
IN _ESPECIALIDAD INT
)
BEGIN
	DECLARE ID_USER INT;
	INSERT INTO usuario(name,
						email,
						password,
						tipo_usuario,
						identicacion,
						telefono,
						tipo_identifacion)
				values(_NOMBRE,
						_EMAIL,
						_PASSWORD,
						'medico',
						_IDENTIDICACION,
						_TELEFONO,
						'ruc'
						);
	SET ID_USER = (select max(id_usuario) from usuario);
    INSERT INTO medico(id_usuario,
						nombre,
						especialidad_id)
						VALUES
						( ID_USER, _NOMBRE , _ESPECIALIDAD);
    
END ;;
DELIMITER ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `new_procedure`(
In _NOMBRE VARCHAR(250),
In _EMAIL VARCHAR(250),
In _PASSWORD VARCHAR(250),
IN _IDENTIDICACION VARCHAR(50),
IN _TELEFONO VARCHAR(50),
IN _ESPECIALIDAD INT
)
BEGIN
	DECLARE ID_USER INT;
	INSERT INTO usuario(name,
						email,
						password,
						tipo_usuario,
						identicacion,
						telefono,
						tipo_identifacion)
				values(_NOMBRE,
						_EMAIL,
						_PASSWORD,
						'medico',
						_IDENTIDICACION,
						_TELEFONO,
						'ruc'
						);
	SET ID_USER = (select max(id_usuario) from usuario);
    INSERT INTO medico(id_usuario,
						nombre,
						especialidad_id)
						VALUES
						( ID_USER, _NOMBRE , _ESPECIALIDAD);
    
END ;;
DELIMITER ;