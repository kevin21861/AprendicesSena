-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sena_db
CREATE DATABASE IF NOT EXISTS `sena_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sena_db`;

-- Volcando estructura para tabla sena_db.aprendices
CREATE TABLE IF NOT EXISTS `aprendices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idTipoDocumento` bigint unsigned NOT NULL,
  `numeroDocumento` int unsigned NOT NULL,
  `primerNombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `segundoNombre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `primerApellido` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `segundoApellido` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `edad` int unsigned NOT NULL,
  `idSexo` bigint unsigned NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `direccion` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aprendizUnico` (`idTipoDocumento`,`numeroDocumento`,`primerNombre`,`primerApellido`),
  KEY `FK_aprendices_sexo` (`idSexo`),
  CONSTRAINT `FK_aprendices_sexo` FOREIGN KEY (`idSexo`) REFERENCES `sexo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_aprendices_tipodocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sena_db.aprendices: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sena_db.sexo
CREATE TABLE IF NOT EXISTS `sexo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sena_db.sexo: ~3 rows (aproximadamente)
INSERT IGNORE INTO `sexo` (`id`, `descripcion`) VALUES
	(0, 'NO_BINARIO'),
	(1, 'MASCULINO'),
	(2, 'FEMENINO');

-- Volcando estructura para tabla sena_db.tipodocumento
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sena_db.tipodocumento: ~6 rows (aproximadamente)
INSERT IGNORE INTO `tipodocumento` (`id`, `descripcion`) VALUES
	(0, 'NO REGISTRA'),
	(1, 'CEDULA DE CIUDADANIA'),
	(2, 'TARJETA DE IDENTIDAD'),
	(3, 'REGISTRO CIVIL'),
	(4, 'CEDULA EXTRANJERA'),
	(5, 'PASAPORTE');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
