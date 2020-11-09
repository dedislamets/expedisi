/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 5.6.37 : Database - expedisi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`expedisi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `expedisi`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(32) NOT NULL,
  `jenis_barang` varchar(32) NOT NULL,
  `berat_barang` double NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`nama_barang`,`jenis_barang`,`berat_barang`) values 
(21,'Laptop ASUS','Gadget',1.5),
(23,'Komputer DELL','Elektronik',9),
(27,'laptop TOSHIBA','Gadget',2);

/*Table structure for table `connote` */

DROP TABLE IF EXISTS `connote`;

CREATE TABLE `connote` (
  `conn_code` varchar(50) NOT NULL,
  `conn_date` datetime DEFAULT NULL,
  `conn_to` varchar(200) DEFAULT NULL,
  `full_address_to` text,
  `city_to` varchar(10) DEFAULT NULL,
  `provice_to` varchar(10) DEFAULT NULL,
  `phone_to` varchar(15) DEFAULT NULL,
  `zip_code_to` varchar(5) DEFAULT NULL,
  `moda` int(11) DEFAULT NULL,
  `charges` float DEFAULT NULL,
  `services` int(11) DEFAULT NULL,
  `input_by` varchar(50) DEFAULT NULL,
  `remark` text,
  `id_wilayah` int(11) DEFAULT NULL,
  PRIMARY KEY (`conn_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `connote` */

/*Table structure for table `daftar` */

DROP TABLE IF EXISTS `daftar`;

CREATE TABLE `daftar` (
  `id` int(5) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `daftar` */

insert  into `daftar`(`id`,`kota`,`alamat`) values 
(1,'Batu','Jalan Ahmad Yani 30, Jalan Pattimura 16'),
(2,'Bangkalan','Jalan S Parman 12, Jalan Rinjani 3B/55'),
(3,'Banyuwangi','Jalan Gede 14'),
(4,'Blitar','Jalan Panglima Sudirman 55'),
(5,'Jember','Jalan Adi Sucipto 1'),
(6,'Kediri','Jalan Ranu Regulo 2, Jalan Veteran 34'),
(7,'Lamongan','Jalan Tengger 36'),
(8,'Lumajang','Jalan Ikan Hiu IXA/3, Jalan Yos Sudarso 6 '),
(9,'Madiun','Jalan Imam Bonjol 44'),
(10,'Malang','Jalan Raya Candi 3a/40, Jalan Kalimosodo III/19, Jalan Soekarno Hatta 523'),
(11,'Pasuruan','Jalan Pancasila 5'),
(12,'Probolinggo','Jalan Mawar Kuning 12, Jalan Gatot Subroto 98'),
(13,'Sidoarjo','Jalan Danau Sentani 3A/32'),
(14,'Situbondo','Jalan Gajahmada 1-3'),
(15,'Surabaya','Jalan Kertajaya VIIA/34, Jalan Tugu 77, Jalan Soekarno Hatta 232, ');

/*Table structure for table `penerima` */

DROP TABLE IF EXISTS `penerima`;

CREATE TABLE `penerima` (
  `id_penerima` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerima` varchar(32) NOT NULL,
  `telepon_penerima` varchar(16) NOT NULL,
  `alamat_penerima` varchar(128) NOT NULL,
  `kode_pos` varchar(6) NOT NULL,
  PRIMARY KEY (`id_penerima`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `penerima` */

insert  into `penerima`(`id_penerima`,`nama_penerima`,`telepon_penerima`,`alamat_penerima`,`kode_pos`) values 
(21,'Cakson','082335766000','Jl. Malang Selatan No. 33','65300'),
(23,'Suhhy','082335766893','Jl. Jombang No. 33','65155'),
(27,'Adit','082335766890','Jl. Jombang No. 33','65772');

/*Table structure for table `pengirim` */

DROP TABLE IF EXISTS `pengirim`;

CREATE TABLE `pengirim` (
  `id_pengirim` int(11) NOT NULL AUTO_INCREMENT,
  `id_penerima` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_pengirim` varchar(32) NOT NULL,
  `telepon_pengirim` varchar(16) NOT NULL,
  PRIMARY KEY (`id_pengirim`),
  UNIQUE KEY `id_penerima` (`id_penerima`),
  UNIQUE KEY `id_barang` (`id_barang`),
  CONSTRAINT `pengirim_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE,
  CONSTRAINT `pengirim_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `pengirim` */

insert  into `pengirim`(`id_pengirim`,`id_penerima`,`id_barang`,`nama_pengirim`,`telepon_pengirim`) values 
(17,21,21,'Munir','082334735000'),
(19,23,23,'Pudya','082334735966'),
(23,27,27,'Cakson','082334735966');

/*Table structure for table `system_users` */

DROP TABLE IF EXISTS `system_users`;

CREATE TABLE `system_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(160) COLLATE utf8_bin DEFAULT NULL,
  `salt` varchar(160) COLLATE utf8_bin DEFAULT NULL,
  `user_role_id` int(10) DEFAULT NULL,
  `last_login` datetime DEFAULT '0000-00-00 00:00:00',
  `last_login_ip` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `reset_request_code` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `reset_request_time` datetime DEFAULT NULL,
  `reset_request_ip` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `verification_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `system_users` */

insert  into `system_users`(`id`,`email`,`password`,`salt`,`user_role_id`,`last_login`,`last_login_ip`,`reset_request_code`,`reset_request_time`,`reset_request_ip`,`verification_status`,`status`) values 
(1,'admin@admin.com','8e666f12a66c17a952a1d5e273428e478e02d943','4f6cdddc4979b8.51434094',1,'2012-03-24 02:52:51','0',NULL,NULL,NULL,1,1),
(2,'dedi@admin.com','F=GF@','4f6cdddc4979b8.51434094',1,'2012-03-24 02:52:51','0',NULL,NULL,NULL,1,1);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `no_resi` varchar(16) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis_paket` varchar(16) NOT NULL,
  `asal_kota` varchar(32) NOT NULL,
  `tujuan_kota` varchar(32) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `status` varchar(16) NOT NULL,
  `harga` double NOT NULL,
  PRIMARY KEY (`no_resi`),
  UNIQUE KEY `id_pengirim` (`id_pengirim`),
  UNIQUE KEY `id_penerima` (`id_penerima`),
  UNIQUE KEY `id_barang` (`id_barang`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `pengirim` (`id_pengirim`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`no_resi`,`id_pengirim`,`id_penerima`,`id_barang`,`jenis_paket`,`asal_kota`,`tujuan_kota`,`tgl_kirim`,`tgl_terima`,`status`,`harga`) values 
('20160017',17,21,21,'Regular','Bangkalan','Banyuwangi','2016-05-01','2016-05-15','otw',15000),
('20160019',19,23,23,'Express','Bangkalan','Blitar','2016-05-01','2016-05-15','terkirim',135000),
('20160023',23,27,27,'Regular','Batu','Batu','2016-05-01','2016-05-15','OTW',20000);

/*Table structure for table `user_access_map` */

DROP TABLE IF EXISTS `user_access_map`;

CREATE TABLE `user_access_map` (
  `user_role_id` int(10) NOT NULL,
  `controller` varchar(255) COLLATE utf8_bin NOT NULL,
  `permission` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_role_id`,`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_access_map` */

insert  into `user_access_map`(`user_role_id`,`controller`,`permission`) values 
(1,'home',1);

/*Table structure for table `user_autologin` */

DROP TABLE IF EXISTS `user_autologin`;

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_autologin` */

/*Table structure for table `user_meta` */

DROP TABLE IF EXISTS `user_meta`;

CREATE TABLE `user_meta` (
  `user_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_meta` */

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `default_access` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role_name`,`default_access`) values 
(1,'Admin','11111');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
