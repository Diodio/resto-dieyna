/*
SQLyog Community v12.09 (64 bit)
MySQL - 10.1.9-MariaDB : Database - resto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`resto` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `resto`;

/*Table structure for table `approvisionnement` */

DROP TABLE IF EXISTS `approvisionnement`;

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `quantite` decimal(10,2) NOT NULL,
  `prixUnitaire` decimal(10,2) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_516C3FAAF347EFB` (`produit_id`),
  CONSTRAINT `FK_516C3FAAF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `approvisionnement` */

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique_id` int(11) DEFAULT NULL,
  `libelle` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `prixUnitaire` decimal(10,2) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E663BD38833` (`rubrique_id`),
  CONSTRAINT `FK_23A0E663BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `article` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `article` */

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `client` */

/*Table structure for table `consommation` */

DROP TABLE IF EXISTS `consommation`;

CREATE TABLE `consommation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `libelle` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `quantite` decimal(10,2) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F993F0A2F347EFB` (`produit_id`),
  KEY `IDX_F993F0A27294869C` (`article_id`),
  CONSTRAINT `FK_F993F0A27294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  CONSTRAINT `FK_F993F0A2F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `consommation` */

/*Table structure for table `employe` */

DROP TABLE IF EXISTS `employe`;

CREATE TABLE `employe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `salaire` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `employe` */

/*Table structure for table `frais` */

DROP TABLE IF EXISTS `frais`;

CREATE TABLE `frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `libelle` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `prixUnitaire` decimal(10,2) NOT NULL,
  `quantite` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `frais` */

/*Table structure for table `ligne_vente` */

DROP TABLE IF EXISTS `ligne_vente`;

CREATE TABLE `ligne_vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `vente_id` int(11) DEFAULT NULL,
  `nombre` int(11) NOT NULL,
  `quantite` decimal(10,2) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B26C07C7294869C` (`article_id`),
  KEY `IDX_8B26C07C7DC7170A` (`vente_id`),
  CONSTRAINT `FK_8B26C07C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8B26C07C7DC7170A` FOREIGN KEY (`vente_id`) REFERENCES `vente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ligne_vente` */

/*Table structure for table `produit` */

DROP TABLE IF EXISTS `produit`;

CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `rubrique_id` int(11) DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC273BD38833` (`rubrique_id`),
  CONSTRAINT `FK_29A5EC273BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `rubrique` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `produit` */

insert  into `produit`(`id`,`libelle`,`createdDate`,`updatedDate`,`deletedDate`,`rubrique_id`,`login`) values (2,'ddvd','2016-10-02 17:32:49','2016-10-02 17:32:49',NULL,7,'admin');

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E6D6B297A4D60759` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profil` */

insert  into `profil`(`id`,`libelle`,`description`,`createdDate`,`updatedDate`,`deleteDate`) values (1,'admin','Administrateur','2015-09-20 00:00:00',NULL,NULL),(2,'magasinier','Magasinier',NULL,NULL,NULL),(3,'comptable','Comptable',NULL,NULL,NULL),(4,'gerant','Gérant de bon d\'achat','2016-01-29 00:00:00',NULL,NULL),(5,'directeur','Directeur',NULL,NULL,NULL);

/*Table structure for table `rubrique` */

DROP TABLE IF EXISTS `rubrique`;

CREATE TABLE `rubrique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8FA4097C77153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `rubrique` */

insert  into `rubrique`(`id`,`code`,`libelle`,`status`,`createdDate`,`updatedDate`,`deletedDate`,`login`) values (5,'DIBI','Dibiterie',0,'2016-10-01 20:02:39','2016-10-01 20:02:39',NULL,''),(6,'FASTFOOD','FastFood',0,'2016-10-01 20:02:57','2016-10-01 20:02:57',NULL,''),(7,'BOISSON','Boisson',0,'2016-10-01 20:03:07','2016-10-01 20:03:07',NULL,''),(8,'RESTAURANT','Restaurant',0,'2016-10-01 20:03:29','2016-10-01 20:03:29',NULL,''),(9,'Pizzeria','Pizzeria',0,'2016-10-03 09:51:56','2016-10-03 09:51:56',NULL,'admin');

/*Table structure for table `utilisateur` */

DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil_id` int(11) DEFAULT NULL,
  `login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nomUtilisateur` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `etatCompte` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  `connected` int(11) DEFAULT NULL,
  `connectedDate` datetime DEFAULT NULL,
  `disconnectedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B3AA08CB10` (`login`),
  KEY `IDX_1D1C63B3275ED078` (`profil_id`),
  CONSTRAINT `FK_1D1C63B3275ED078` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `utilisateur` */

insert  into `utilisateur`(`id`,`profil_id`,`login`,`password`,`nomUtilisateur`,`status`,`etatCompte`,`createdDate`,`updatedDate`,`deletedDate`,`connected`,`connectedDate`,`disconnectedDate`) values (1,1,'admin','passer','Macoura NIANG','1','1',NULL,NULL,NULL,1,'2016-12-11 17:45:09','2016-05-31 18:21:24');

/*Table structure for table `vente` */

DROP TABLE IF EXISTS `vente`;

CREATE TABLE `vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `montant` decimal(10,2) NOT NULL,
  `createdDate` datetime DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `deletedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_888A2A4CF55AE19E` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `vente` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
