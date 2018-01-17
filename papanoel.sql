/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.29-MariaDB : Database - papanoel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`papanoel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `papanoel`;

/*Table structure for table `categoria_colores` */

DROP TABLE IF EXISTS `categoria_colores`;

CREATE TABLE `categoria_colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `categoria_colores` */

insert  into `categoria_colores`(`id`,`categoria_id`,`color_id`,`created_at`,`updated_at`) values (14,5,1,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(15,5,2,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(16,5,3,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(17,5,5,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(18,5,7,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(19,5,9,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(20,5,12,'2017-10-23 16:31:53','2017-10-23 16:31:53'),(35,1,2,'2017-10-23 16:50:18','2017-10-23 16:50:18'),(36,1,4,'2017-10-23 16:50:18','2017-10-23 16:50:18'),(38,1,8,'2017-10-23 16:50:18','2017-10-23 16:50:18');

/*Table structure for table `categoria_fotos` */

DROP TABLE IF EXISTS `categoria_fotos`;

CREATE TABLE `categoria_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `categoria_fotos` */

insert  into `categoria_fotos`(`id`,`categoria_id`,`color_id`,`foto`,`created_at`,`updated_at`) values (3,5,1,'img/foto_categoria/1508540468.jpg','2017-10-20 23:01:10','2017-10-20 23:01:10'),(4,5,2,'img/foto_categoria/1508776348.jpg','2017-10-23 16:32:29','2017-10-23 16:32:29');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `costo_envio` tinyint(4) DEFAULT NULL,
  `monto_minimo_envio` double DEFAULT NULL,
  `tarifa_envio` double DEFAULT NULL,
  `foto` varchar(30) DEFAULT 'img/default.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`categoria`,`costo_envio`,`monto_minimo_envio`,`tarifa_envio`,`foto`,`created_at`,`updated_at`) values (1,'Especial',0,0,0,'img/default_arbol.png','2017-10-19 11:24:18','2017-10-19 16:22:37'),(2,'Holandes',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(3,'Chapala',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(4,'Mediterraneo',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(5,'Verde de Luxo',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(6,'Blanco de Luxo',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(7,'Durango esbelto',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(8,'Argentina',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(9,'Argentina Lady',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(10,'Durango',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(11,'Polaco',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(12,'Ruso',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(13,'Cancún',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(14,'Taxco',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(15,'Chihuahua',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(16,'Alaska',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(17,'Alaska Supremo',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(18,'Alaska Pared',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(19,'Alaska Esquina',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(20,'Secretarial',1,165,170,'img/categorias/1508431413.jpg','2017-10-19 11:43:33','2017-10-19 16:43:33'),(21,'Mini Durango',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(22,'Mini Chihuahua',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(23,'Mini Alaska',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(24,'Japones',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(25,'Pekin',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(26,'Koreano',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(27,'Shangai',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(28,'Taiwan',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00'),(29,'Hong Kong',0,0,0,'img/default_arbol.png','2017-10-19 11:16:07','0000-00-00 00:00:00');

/*Table structure for table `colores` */

DROP TABLE IF EXISTS `colores`;

CREATE TABLE `colores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `foto` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `colores` */

insert  into `colores`(`id`,`color`,`status`,`foto`,`created_at`,`updated_at`) values (1,'Verde',1,'img/colores/Verde.png','2017-10-17 12:06:58','2017-10-04 23:20:56'),(2,'Verde Pálido',1,'img/colores/Verde_Palido.png','2017-10-17 12:07:08','2017-10-04 23:19:26'),(3,'Verde / Oro',1,'img/colores/Verde_Oro.png','2017-10-17 12:07:15','0000-00-00 00:00:00'),(4,'Verde nevado',1,'img/colores/Verde_nevado.png','2017-10-17 12:07:23','0000-00-00 00:00:00'),(5,'Verde primavera',1,'img/colores/Verde_primavera.png','2017-10-17 12:07:32','0000-00-00 00:00:00'),(6,'Fantasía de colores',1,'img/colores/Fantasia_de_colores.png','2017-10-17 12:11:42','0000-00-00 00:00:00'),(7,'Malvavisco',1,'img/colores/Malvavisco.png','2017-10-17 12:08:11','0000-00-00 00:00:00'),(8,'Café otoño',1,'img/colores/cafe_otono.png','2017-10-17 12:08:23','0000-00-00 00:00:00'),(9,'Otoño nevado',1,'img/colores/Otono_Nevado.png','2017-10-17 12:08:51','0000-00-00 00:00:00'),(10,'Tinto / Vino',1,'img/colores/Tinto_Vino.png','2017-10-17 12:09:03','0000-00-00 00:00:00'),(11,'Azul invierno',1,'img/colores/azul_invierno.png','2017-10-17 12:09:16','0000-00-00 00:00:00'),(12,'Plata',1,'img/colores/Plata.png','2017-10-17 12:09:28','0000-00-00 00:00:00'),(13,'Paja',1,'img/colores/Paja.png','2017-10-17 12:09:39','0000-00-00 00:00:00'),(14,'Blanco',1,'img/colores/Blanco.png','2017-10-17 12:09:51','0000-00-00 00:00:00'),(15,'Kristal',1,'img/colores/Blanco_Azul.png','2017-10-17 12:09:56','0000-00-00 00:00:00'),(16,'Estaciones',1,'img/colores/Estaciones.png','2017-10-17 12:10:03','0000-00-00 00:00:00'),(17,'Nacarado',1,'img/colores/Nacarado.png','2017-10-17 12:10:12','0000-00-00 00:00:00'),(18,'Blanco / Azul',1,'img/colores/Blanco_Azul.png','2017-10-17 12:10:27','0000-00-00 00:00:00'),(19,'Blanco  rosa pálido',1,'img/colores/Blanco_rosa_palido.png','2017-10-17 12:10:56','2017-10-13 21:58:49');

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `estado` */

insert  into `estado`(`id`,`nombreEstado`,`created_at`,`updated_at`) values (1,'Aguascalientes','2017-02-04 18:45:43','2017-02-04 18:49:42'),(2,'Baja California',NULL,'2017-02-02 10:49:34'),(3,'Baja California Sur',NULL,NULL),(4,'Campeche',NULL,'2017-01-25 23:32:12'),(5,'Chiapas',NULL,NULL),(6,'Chihuahua',NULL,NULL),(7,'Coahuila',NULL,NULL),(8,'Colima',NULL,NULL),(9,'Distrito Federal',NULL,NULL),(10,'Durango',NULL,NULL),(11,'Estado de México',NULL,NULL),(12,'Guanajuato',NULL,NULL),(13,'Guerrero',NULL,'2017-01-25 23:32:35'),(14,'Hidalgo',NULL,NULL),(15,'Jalisco',NULL,'2017-01-25 23:32:31'),(16,'Michoacán',NULL,NULL),(17,'Morelos',NULL,NULL),(18,'Nayarit',NULL,NULL),(19,'Nuevo León',NULL,NULL),(20,'Oaxaca',NULL,NULL),(21,'Puebla',NULL,NULL),(22,'Querétaro',NULL,NULL),(23,'Quintana Roo',NULL,NULL),(24,'San Luis Potosí',NULL,NULL),(25,'Sinaloa',NULL,'2017-01-25 23:33:35'),(26,'Sonora',NULL,NULL),(27,'Tabasco',NULL,NULL),(28,'Tamaulipas',NULL,'2017-01-25 23:32:56'),(29,'Tlaxcala',NULL,NULL),(30,'Veracruz',NULL,NULL),(31,'Yucatán',NULL,NULL),(32,'Zacatecas',NULL,'2017-01-25 23:32:45');

/*Table structure for table `favoritos` */

DROP TABLE IF EXISTS `favoritos`;

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `favoritos` */

/*Table structure for table `noticias` */

DROP TABLE IF EXISTS `noticias`;

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `mensaje` text,
  `foto` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `noticias` */

insert  into `noticias`(`id`,`titulo`,`mensaje`,`foto`,`created_at`,`updated_at`) values (1,'Oferta árboles de navidad',' Por tiempo limitado, en el mes de Octubre podrás comprar árboles con un 20% de descuento.','img/default.jpg','2017-10-12 12:26:15','2017-10-12 17:26:15'),(2,'Árboles al 3x4','Compra 3 árboles de cualquier categoría y llévate el 4to gratis!!','img/noticias/1507829716.jpg','2017-10-12 17:35:17','2017-10-12 17:35:17');

/*Table structure for table `preguntas_frecuentes` */

DROP TABLE IF EXISTS `preguntas_frecuentes`;

CREATE TABLE `preguntas_frecuentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ayuda_menu_id` int(11) DEFAULT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `imagen` varchar(100) DEFAULT 'img/preguntas/default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `preguntas_frecuentes` */

insert  into `preguntas_frecuentes`(`id`,`ayuda_menu_id`,`pregunta`,`respuesta`,`imagen`) values (1,1,'¿La aplicación está disponible para android y ios?','Claro, la aplicación está disponible para ser instalada en cualquiera de las dos plataformas.','img/preguntas/1497635032.jpg'),(2,1,'¿Cuánto tiempo tardan en aprobar mi usuario para usar la aplicación?','Nos tardamos hasta 48 horas máximo en revisar tu solicitud y aprobar tu usuario en la aplicación.','img/preguntas/1497635045.jpg'),(3,2,'¿Que pasa si me tarjeta no cuenta con el saldo suficiente?','Si tu tarjeta no cuenta con el saldo suficiente para realizar la compra, se lanzara un mensaje con la leyenda de: el crédito de esta cuenta ha sido alcanzado.','img/preguntas/1503076050.jpg'),(4,3,'¿Que hacer cuando tu tarjeta no ha podido ser verificada?','Cuando tu tarjeta no puede ser verificada aparece un mensaje que dice: ¡Cuidado! Datos del cliente incorrectos: El token no existe.\r\n\r\nEste problema se puede presentar cuando nuestra conexión a internet no es tan buena, ya sea por medio de wifi o datos.\r\n\r\nPara corregir esto es muy importante corroborar que estemos con una buena conexión a internet y posterior a esto hay que pulsar nuevamente en la tarjeta con la cual vamos a realizar la compra y dar comprar.\r\n','img/preguntas/1499364173.jpg'),(5,4,'¿Cuando saber si se realizo mi cobro? ','Cuando tu compra se realizo correctamente deberá aparecer un mensaje que diga: ¡Gracias por tu pago! En la opción de pedidos, puede visualizarse sus compras. \r\n\r\n','img/preguntas/1499364127.jpg');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `altura` varchar(50) DEFAULT NULL,
  `puntas` int(11) DEFAULT NULL,
  `ancho` varchar(50) DEFAULT NULL,
  `peso_empaque` varchar(50) DEFAULT NULL,
  `dimensiones_empaque` varchar(100) DEFAULT '1',
  `armado_id` int(11) DEFAULT NULL,
  `secciones` int(11) DEFAULT NULL,
  `pata_soporte_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `agotado` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`categoria_id`,`altura`,`puntas`,`ancho`,`peso_empaque`,`dimensiones_empaque`,`armado_id`,`secciones`,`pata_soporte_id`,`precio`,`agotado`,`status`,`created_at`,`updated_at`) values (1,1,'100 ',59,'78 cms.','1.500 Kgs.','0.630x0.160x0.115',1,2,1,'165.00',1,1,'2017-10-17 23:26:28','2017-10-19 17:44:10'),(2,1,'130 ',77,'92 cms.','2.000 Kgs.','0.735x0.190x0.135',1,3,1,'219.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(3,1,'150 ',95,'104 cms.','2.750 Kgs.','0.895x0.220x0.140',1,3,1,'269.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(4,1,'175 ',113,'116 cms.','3.250 Kgs.','0.895x0.220x0.140',1,3,1,'299.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(5,1,'190 ',125,'114 cms.','3.750 Kgs.','1.020x0.255x0.150',1,3,1,'365.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(6,1,'220 ',149,'126 cms.','4.500 kgs.','1.020x0.255x0.150',1,3,1,'420.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(7,2,'100 ',113,'72 cms','2.000 Kgs.','0.735x0.190x0.135',1,2,1,'229.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(8,2,'130 ',149,'86 cms.','2.500 Kgs.','0.735x0.190x0.135',1,2,1,'306.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(9,2,'150 ',185,'98 cms.','3.500 Kgs.','0.895x0.220x0.140',1,3,1,'383.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(10,2,'175 ',221,'110 cms.','4.250 Kgs.','0.895x0.220x0.140',1,3,1,'493.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(11,2,'190 ',245,'114 cms.','5.000 Kgs.','1.020x0.255x0.150',1,3,1,'570.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(12,2,'220 ',293,'126 cms.','6.000 Kgs.','1.020x0.255x0.150',1,3,1,'669.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(13,3,'100 ',65,'82 cms.','1.750 Kgs.','0.735x0.190x0.135',1,2,1,'249.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(14,3,'130 ',83,'96 cms.','2.300 Kgs.','0.895x0.220x0.140',1,3,1,'314.00',0,1,'2017-10-17 23:26:28','2017-10-17 23:26:28'),(15,3,'150 ',101,'108 cms.','3.100 Kgs.','0.895x0.220x0.140',1,3,1,'411.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(16,3,'175 ',119,'120 cms.','3.750 Kgs.','1.020x0.255x0.150',1,3,1,'521.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(17,3,'190 ',131,'126 cms.','4.500 Kgs.','1.020x0.255x0.150',1,3,1,'592.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(18,3,'220 ',155,'134 cms.','5.250 Kgs.','1.020x0.255x0.150',1,3,1,'621.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(19,4,'100 ',275,'66 cms.','1.900 Kgs.','0.630x0.160x0.115',1,2,1,'165.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(20,4,'130 ',357,'66 cms.','2.000 Kgs.','0.735x0.190x0.135',1,2,1,'215.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(21,4,'150 ',411,'88 cms.','3.000 Kgs.','0.895x0.220x0.140',1,2,1,'265.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(22,4,'175 ',483,'88 cms.','3.500 Kgs.','1.020x0.255x0.150',1,2,1,'335.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(23,4,'190 ',521,'110 cms.','5.000 Kgs.','0.880x0.370x0.180',1,3,1,'448.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(24,4,'220 ',605,'132 cms.','5.750 Kgs.','0.880x0.370x0.180',1,4,1,'571.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(25,4,'250 ',687,'132 cms.','6.800 Kgs.','0.945x0.380x0.210',1,4,1,'674.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(26,5,'150 ',191,'114 cms.','4.500 Kgs.','0.880x0.370x0.180',1,3,1,'571.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(27,6,'150 ',191,'114 cms.','4.500 Kgs.','0.880x0.370x0.180',1,3,1,'571.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(28,5,'175 ',245,'122 cms.','5.300 Kgs.','0.880x0.370x0.180',1,3,1,'665.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(29,6,'175 ',245,'122 cms.','5.300 Kgs.','0.880x0.370x0.180',1,3,1,'665.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(30,5,'190 ',281,'132 cms.','6.250 Kgs.','0.945x0.380x0.210',1,3,1,'774.00',0,1,'2017-10-17 23:26:29','2017-10-17 23:26:29'),(31,6,'190 ',281,'132 cms.','6.250 Kgs.','0.945x0.380x0.210',1,3,1,'774.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(32,5,'220 ',323,'144 cms.','7.500 Kgs.','0.945x0.380x0.210',1,4,1,'906.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(33,6,'220 ',323,'144 cms.','7.500 Kgs.','0.945x0.380x0.210',1,4,1,'906.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(34,7,'100 ',242,'48 cms.','2.000 Kgs.','0.735x0.190x0.135',1,2,1,'209.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(35,7,'130 ',406,'60 cms.','3.000 Kgs.','0.895x0.220x0.140',1,2,1,'309.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(36,7,'150 ',558,'72 cms.','4.000 Kgs.','1.020x0.255x0.150',1,3,1,'403.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(37,7,'175 ',718,'80 cms.','5.000 Kgs.','0.880x0.370x0.180',1,3,1,'516.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(38,7,'190 ',855,'84 cms.','6.000 Kgs.','0.880x0.370x0.180',1,3,1,'607.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(39,7,'220 ',936,'96 cms.','7.000 Kgs.','0.945x0.380x0.210',1,3,1,'805.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(40,7,'250 ',1340,'114 cms.','11.000 Kgs.','1.160x0.375x0.255',1,4,2,'1139.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(41,8,'175 ',444,'84 cms.','4.500 Kgs.','0.88x0.37x0.18',1,3,1,'690.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(42,8,'190 ',516,'94 cms.','5.000 Kgs.','0.945x0.38x0.21',1,3,1,'760.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(43,8,'220 ',624,'108 cms.','6.500 Kgs.','0.945x0.38x0.21',1,4,1,'880.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(44,8,'250 ',766,'114 cms.','9.250 Kgs.','1.16x.375x0.255',1,4,1,'990.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(45,9,'175 ',444,'84 cms.','4.500 Kgs.','0.88x0.37x0.18',1,3,1,'690.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(46,9,'190 ',516,'94 cms.','5.000 Kgs.','0.945x0.38x0.21',1,3,1,'760.00',0,1,'2017-10-17 23:26:30','2017-10-17 23:26:30'),(47,9,'220 ',624,'108 cms.','6.500 Kgs.','0.945x0.38x0.21',1,4,1,'880.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(48,9,'250 ',766,'114 cms.','9.250 Kgs.','1.16x.375x0.255',1,4,1,'990.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(49,10,'100 ',365,'66 cms.','2.500 Kgs.','0.895x0.22x0.14',1,2,1,'249.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(50,10,'130 ',617,'84 cms.','3.750 Kgs.','1.02x0.255x0.15',1,2,1,'392.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(51,10,'130 ',617,'84 cms.','3.750 Kgs.','1.02x0.255x0.15',1,3,1,'392.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(52,10,'150 ',851,'100 cms.','5.000 Kgs.','0.88x0.37x0.18',1,3,1,'538.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(53,10,'175 ',1097,'112 cms.','6.500 Kgs.','0.88x0.37x0.18',1,3,1,'689.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(54,10,'190 ',1307,'122 cms.','8.300 Kgs.','0.945x0.38x0.21',1,3,1,'811.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(55,10,'220 ',1433,'142 cms.','10.250 Kgs.','1.16x.375x0.255',1,3,2,'1073.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(56,10,'250 ',2057,'168 cms.','13.250 Kgs.','1.16x.375x0.255',1,4,2,'1519.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(57,11,'100 ',210,'66 cms.','3.000 Kgs.','0.895x0.220x0.140',1,NULL,1,'319.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(58,11,'130 ',372,'84 cms.','4.500 Kgs.','1.020x0.255x0.150',1,NULL,1,'494.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(59,11,'150 ',546,'100 cms.','6.000 Kgs.','0.880x0.370x0.180',1,NULL,1,'658.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(60,11,'175 ',732,'112 cms.','7.000 Kgs.','0.945x0.380x0.210',1,NULL,1,'945.00',0,1,'2017-10-17 23:26:31','2017-10-17 23:26:31'),(61,11,'190 ',1026,'122 cms.','10.500 Kgs.','1.160x0.375x0.255',1,NULL,1,'1093.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(62,11,'220 ',1158,'142 cms.','13.500 Kgs.','1.105X0.425X0.395',1,NULL,2,'1395.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(63,11,'250 ',1512,'168 cms.','14.600 Kgs.','1.105X0.425X.0395',1,NULL,2,'1813.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(64,12,'100 ',365,'70 cms.','2.000 Kgs.','0.895x0.22x0.140',1,2,1,'306.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(65,12,'130 ',617,'88 cms.','3.500 Kgs.','0.880x0.370x0.180',1,3,1,'566.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(66,12,'150 ',851,'105 cms.','8.000 Kgs.','0.945x0.38x0.21',1,4,1,'758.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(67,12,'175 ',1097,'116 cms.','11.000 Kgs.','1.16x.375x0.255',1,4,1,'912.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(68,12,'190 ',1307,'127 cms.','15.000 Kgs.','1.105x0.425x0.395',1,4,1,'1000.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(69,12,'220 ',1433,'145 csm.','17.500 Kgs.','1.105x0.425x0.396',1,4,2,'1307.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(70,13,'175 ',311,'104 cms.','6.00 Kgs.','0.880x0.370x0.180',1,3,1,'1049.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(71,13,'190 ',359,'100 cms.','7.250 Kgs.','0.945x0.380x0.210',1,3,1,'1181.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(72,13,'220 ',407,'120 cms.','8.500 Kgs.','1.160x0.375x0.255',1,3,1,'1251.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(73,14,'175 ',927,'90 cms.','6.500 Kg.','0.880x0.370x0.180',1,3,1,'988.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(74,14,'175 ',1097,'90 cms.','6.500 Kg.','0.880x0.370x0.180',1,3,1,'988.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(75,14,'190 ',1183,'96 cms.','8.000 Kgs.','0.945x0.380x0.210',1,3,1,'1221.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(76,14,'190 ',1307,'96 cms.','8.000 Kgs.','0.945x0.380x0.210',1,3,1,'1221.00',0,1,'2017-10-17 23:26:32','2017-10-17 23:26:32'),(77,14,'220 ',1445,'114 cms.','11.800 Kgs.','1.160x0.375x0.255',1,3,2,'1499.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(78,14,'220 ',1433,'114 cms.','11.800 Kgs.','1.160x0.375x0.255',1,3,2,'1499.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(79,14,'250 ',1642,'125 cms.','13.500 Kgs.','1.160x0.375x0.255',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(80,14,'250 ',1642,'126 cms.','13.500 Kgs.','1.160x0.375x0.256',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(81,14,'250 ',1642,'127 cms.','13.500 Kgs.','1.160x0.375x0.257',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(82,14,'250 ',1642,'128 cms.','13.500 Kgs.','1.160x0.375x0.258',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(83,14,'250 ',1642,'129 cms.','13.500 Kgs.','1.160x0.375x0.259',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(84,14,'250 ',1642,'130 cms.','13.500 Kgs.','1.160x0.375x0.260',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(85,14,'250 ',1642,'131 cms.','13.500 Kgs.','1.160x0.375x0.261',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(86,14,'250 ',1642,'132 cms.','13.500 Kgs.','1.160x0.375x0.262',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(87,14,'250 ',1642,'133 cms.','13.500 Kgs.','1.160x0.375x0.263',1,3,2,'1819.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(88,15,'150 ',779,'92 cms.','5.250 Kgs.','0.880x0.370x0.180',1,3,1,'895.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(89,15,'175 ',893,'96 cms.','6.500 Kgs.','0.880x0.370x0.180',1,3,1,'1120.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(90,15,'190 ',1217,'112 cms.','9.000 Kgs.','1.160x0.375x0.255',1,3,1,'1422.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(91,15,'220 ',1613,'128 cms.','12.250 Kgs.','1.160x0.375x0.255',1,3,2,'1752.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(92,16,'175 ',1205,'118 cms.','9.000 Kgs.','1.160x0.375x0.255',1,3,1,'1417.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(93,16,'190 ',1517,'128 cms.','12.250 Kgs.','1.160x0.375x0.255',1,3,1,'1736.00',0,1,'2017-10-17 23:26:33','2017-10-17 23:26:33'),(94,16,'220 ',1865,'150 cms.','15.000 Kgs.','1.105x0.425x0.395',1,3,2,'2307.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(95,16,'250 ',2333,'162 cms.','18.250 Kgs.','1.105x0.425x0.395',1,3,2,'2845.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(96,16,'300 ',2717,'190 cms.','29.200 Kgs.','1.105x0.425x0.395 (2 cajas)',1,4,2,'9150.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(97,16,'400 ',4721,'190 cms.','45.200 Kgs.','1.105x0.425x0.395 (2 cajas)',1,5,2,'11897.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(98,17,'175 ',1325,'140 cms.','11.750 Kgs.','1.160x0.375x0.255',1,3,1,'1516.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(99,17,'190 ',1637,'146 cms.','14.500 Kgs.','1.160x0.375x0.255',1,3,1,'1856.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(100,17,'220 ',2093,'171 cms.','18.500 Kgs.','1.105x0.425x0.395',1,3,2,'2459.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(101,17,'250 ',2621,'185 cms.','23.250 Kgs.','1.105x0.425x0.395',1,3,2,'3044.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(102,18,'220 ',1125,'Ancho 150cms.  Fondo 75 cms.','10.250 Kgs.','1.160x0.375x0.255',1,3,2,'1350.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(103,19,'220 ',785,'Ancho 52 cms. Fondo 75 cms.','8.200 Kgs.','1.160x0.375x0.255',1,3,2,'1107.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(104,20,'035 ',36,'24 cms.','0.161 Kgs.','No aplica',2,1,1,'19.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(105,20,'050 ',60,'36 cms.','0.264 Kgs.','No aplica',2,1,1,'33.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(106,20,'060 ',78,'43 cms.','0.348 Kgs.','No aplica',2,1,1,'45.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(107,21,'080 ',215,'64 cms.','1.650 Kgs.','0.735x0.190x0.135',1,1,1,'189.00',0,1,'2017-10-17 23:26:34','2017-10-17 23:26:34'),(108,22,'080 ',125,'44 cms.','1.600 Kgs.','0.735x0.190x0.135',1,1,1,'199.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(109,23,'080 ',125,'42 cms.','1.650 gs.','0.735x0.190x0.135',1,1,1,'209.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(110,24,'100 ',365,'64 cms.','1.250 Kgs.','0.630x0.160x0.115',2,2,1,'90.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(111,24,'130 ',617,'64 cms.','1.500 Kgs.','0.630x0.160x0.115',2,3,1,'114.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(112,24,'150 ',851,'64 cms.','1.750 Kgs.','0.735x0.190x0.135',2,3,1,'146.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(113,24,'175 ',1097,'64 cms.','2.000 Kgs.','0.735x0.190x0.135',2,3,1,'167.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(114,25,'100 ',60,'76 cms.','1.500 Kgs.','0.630x0.160x0.115',2,2,1,'100.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(115,25,'130 ',78,'92 cms.','2.250 Kgs.','0.895x0.220x0.140',2,2,1,'138.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(116,25,'150 ',102,'104 cms.','2.750 Kgs.','0.895x0.220x0.140',2,3,1,'183.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(117,25,'175 ',120,'108 cms.','3.500 Kgs.','0.895x0.220x0.140',2,3,1,'229.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(118,25,'190 ',138,'108 cms.','4.000 Kgs.','1.020x0.255x0.115',2,4,1,'268.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(119,25,'220 ',162,'128 cms.','4.750 Kgs.','1.020x0.255x0.115',2,3,1,'334.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(120,26,'100 ',365,'95 cms.','1.250 Kgs.','0.630x0.160x0.115',3,2,1,'126.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(121,26,'130 ',617,'105 cms.','1.750 Kgs.','0.630x0.160x0.115',3,2,1,'186.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(122,26,'150 ',851,'112 cms.','2.250 Kgs.','0.735x0.190x0.135',3,3,1,'232.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(123,26,'175 ',1097,'125 cms.','2.750 Kgs.','0.735x0.190x0.135',3,3,1,'269.00',0,1,'2017-10-17 23:26:35','2017-10-17 23:26:35'),(124,27,'100 ',134,'42 cms.','1.250 Kgs.','0.630x0.160x0.115',3,3,1,'93.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(125,27,'100 ',134,'42 cms.','1.250 Kgs.','0.630x0.160x0.115',3,4,1,'93.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(126,27,'130 ',198,'46 cms.','1.500 Kgs.','0.630x0.160x0.115',3,4,1,'143.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(127,27,'150 ',256,'60 cms.','2.500 Kgs.','0.630x0.160x0.115',3,4,1,'219.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(128,27,'175 ',480,'80 cms.','3.750 Kgs.','0.895x0.220x0.140',3,4,1,'306.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(129,27,'190 ',594,'88 cms.','4.500 Kgs.','0.895x0.220x0.140',3,4,1,'402.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(130,27,'220 ',748,'98 cms.','6.250 Kgs.','1.020x0.255x0.150',3,4,1,'501.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(131,28,'175 ',642,'93 cms.','7.000 Kgs.','0.945x0.380x0.210',3,3,1,'657.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(132,28,'190 ',944,'102 cms.','8.500 Kgs.','0.945x0.380x0.210',3,3,1,'822.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(133,28,'190 ',944,'102 csm','8.500 Kgs.','0.945x0.380x0.210',3,3,1,'822.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(134,28,'220 ',1183,'120 cms.','12.000 Kgs.','1.160x0.375x0.255',3,4,2,'950.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(135,29,'100 ',223,'54 cms.','1.250 Kgs.','0.630x0.160x0.115',3,3,1,'229.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(136,29,'130 ',295,'68 cms.','2.500 Kgs.','0.735x0.190x0.135',3,3,1,'321.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(137,29,'150 ',375,'75 cms. ','3.750 Kgs.','0.895x0.220x0.140',3,4,1,'369.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(138,29,'175 ',475,'85 cms.','4.500 Kgs.','1.020x0.255x0.150',3,4,1,'453.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(139,29,'190 ',667,'98 cms.','5.000 Kgs.','1.020x0.255x0.150',3,4,1,'489.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(140,29,'220 ',907,'110 cms.','6.500 Kgs.','0.880x0.370x0.180',3,4,2,'586.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36'),(141,29,'250  ',1507,'125 cms.','9.000 Kgs.','1.160x0.375x0.255',3,4,2,'799.00',0,1,'2017-10-17 23:26:36','2017-10-17 23:26:36');

/*Table structure for table `registro_logs` */

DROP TABLE IF EXISTS `registro_logs`;

CREATE TABLE `registro_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fechaLogin` date DEFAULT NULL,
  `realTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `registro_logs` */

/*Table structure for table `servicio_detalles` */

DROP TABLE IF EXISTS `servicio_detalles`;

CREATE TABLE `servicio_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) DEFAULT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL COMMENT 'Abreviación del producto en general',
  `foto_producto` varchar(100) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `altura` varchar(50) DEFAULT NULL,
  `puntas` varchar(10) DEFAULT NULL,
  `ancho` varchar(50) DEFAULT NULL,
  `peso_empaque` varchar(50) DEFAULT NULL,
  `dimensiones_empaque` varchar(50) DEFAULT NULL,
  `tipo_armado` varchar(50) DEFAULT NULL,
  `secciones` varchar(50) DEFAULT NULL,
  `tipo_pata_soporte` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `servicio_detalles` */

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `paypal_order_id` varchar(255) DEFAULT NULL,
  `conekta_order_id` varchar(255) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `costo_envio` double DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` text,
  `entre` text,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(5) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `tipo_orden` varchar(10) DEFAULT NULL,
  `last_digits` varchar(4) DEFAULT NULL,
  `datetime_formated` varchar(50) DEFAULT NULL,
  `num_referencia` varchar(20) DEFAULT NULL,
  `num_guia` varchar(40) DEFAULT NULL,
  `paqueteria` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

/*Table structure for table `subcategorias` */

DROP TABLE IF EXISTS `subcategorias`;

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `subcategoria` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `subcategorias` */

insert  into `subcategorias`(`id`,`menu_id`,`categoria_id`,`subcategoria`,`foto`,`descripcion`,`created_at`,`updated_at`) values (3,2,2,'heheheh','img/subcategorias/1505235766.jpg','sdghajd','2017-09-12 12:02:46','2017-09-12 12:02:46');

/*Table structure for table `tipo_armado` */

DROP TABLE IF EXISTS `tipo_armado`;

CREATE TABLE `tipo_armado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `armado` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_armado` */

insert  into `tipo_armado`(`id`,`armado`,`created_at`,`updated_at`) values (1,'Automático','2017-09-27 11:57:44','0000-00-00 00:00:00'),(2,'Manual','2017-09-27 11:57:46','0000-00-00 00:00:00'),(3,'Automático/Manual','2017-09-27 11:57:54','0000-00-00 00:00:00');

/*Table structure for table `tipo_pata_soporte` */

DROP TABLE IF EXISTS `tipo_pata_soporte`;

CREATE TABLE `tipo_pata_soporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pata_soporte` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_pata_soporte` */

insert  into `tipo_pata_soporte`(`id`,`pata_soporte`,`created_at`,`updated_at`) values (1,'Plástico','2017-09-27 11:58:45','0000-00-00 00:00:00'),(2,'Metálica','2017-09-27 11:58:48','0000-00-00 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_usuario` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'admin','$2y$10$rvslyukfEwpm3qQObQg9h.CXwbOOnGZVhnxK/ndEaadZ7lDpecENG','admin@navidad_arboles.com','img/user_perfil/default.jpg','UQf3D1ahENAZxpxhwbzJFpBqBwkBjTlvrvNomI3ZRcRghuVIXxIM9VyeKles',1,'2017-08-17 17:34:22','2017-09-26 17:42:52');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto_perfil` varchar(100) DEFAULT 'https://navidad.belyapp.com/img/usuario_app/default.jpg',
  `celular` varchar(18) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `tipo` tinyint(4) DEFAULT '1',
  `red_social` int(11) DEFAULT NULL,
  `player_id` varchar(155) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

/*Table structure for table `usuario_direcciones` */

DROP TABLE IF EXISTS `usuario_direcciones`;

CREATE TABLE `usuario_direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `entre` text,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `pais` varchar(10) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `residencial` tinyint(4) DEFAULT NULL,
  `is_main` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario_direcciones` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
