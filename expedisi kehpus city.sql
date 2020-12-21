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

/*Table structure for table `TempTable` */

DROP TABLE IF EXISTS `TempTable`;

CREATE TABLE `TempTable` (
  `id` int(11) NOT NULL DEFAULT '0',
  `province` varchar(100) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kodepos` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `TempTable` */

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(32) NOT NULL,
  `jenis_barang` varchar(32) NOT NULL,
  `berat_barang` double NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `createby` varchar(20) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `editby` varchar(20) DEFAULT NULL,
  `editdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`nama_barang`,`jenis_barang`,`berat_barang`,`satuan`,`createby`,`createdate`,`editby`,`editdate`) values 
(21,'Laptop ASUS','Gadget',1.5,NULL,NULL,NULL,NULL,NULL),
(23,'Komputer DELL','Gadget',3,'Kg',NULL,NULL,'2','2020-11-10 00:00:00'),
(27,'laptop TOSHIBA','Gadget',2,NULL,NULL,NULL,NULL,NULL),
(34,'Tiang Telp','lain-lain',1,'Ton','2','2020-11-13 00:00:00','2','2020-11-13 00:00:00'),
(35,'Kabel Udara','lain-lain',10,'M','2','2020-11-13 00:00:00',NULL,NULL);

/*Table structure for table `connote` */

DROP TABLE IF EXISTS `connote`;

CREATE TABLE `connote` (
  `conn_code` varchar(50) NOT NULL,
  `conn_date` datetime DEFAULT NULL,
  `conn_to` varchar(200) DEFAULT NULL,
  `full_address_to` text,
  `city_to` varchar(20) DEFAULT NULL,
  `provice_to` varchar(10) DEFAULT NULL,
  `phone_to` varchar(15) DEFAULT NULL,
  `zip_code_to` varchar(5) DEFAULT NULL,
  `moda` varchar(20) DEFAULT NULL,
  `charges` float DEFAULT NULL,
  `services` int(11) DEFAULT NULL,
  `input_by` varchar(50) DEFAULT NULL,
  `remark` text,
  `id_cabang` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `payment` varchar(20) DEFAULT 'Tunai',
  `conn_from` varchar(200) DEFAULT NULL,
  `full_address_from` text,
  `city_from` varchar(20) DEFAULT NULL,
  `phone_from` varchar(15) DEFAULT NULL,
  `zip_code_from` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`conn_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `connote` */

insert  into `connote`(`conn_code`,`conn_date`,`conn_to`,`full_address_to`,`city_to`,`provice_to`,`phone_to`,`zip_code_to`,`moda`,`charges`,`services`,`input_by`,`remark`,`id_cabang`,`status`,`payment`,`conn_from`,`full_address_from`,`city_from`,`phone_from`,`zip_code_from`) values 
('TA-GDGBKS2011111','2020-11-12 00:00:00','Zakariya yahya','Melaboh ','JAMBI',NULL,'088888888888','12212','AD',2000000,NULL,'2',NULL,'GDGJKT',1,'Tunai','Hamid Baedhowi','Jagakarsa ','ACEH','082111111111','12133'),
('TA-GDGJKT2011131','2020-11-13 00:00:00','bbbb','fghghg ','JAMBI',NULL,'081119836278787','15151','DN',2000000,3,'2',NULL,'GDGJKT',1,'Tunai','aaaa','fgghghf ','ACEH','608988989876','12234'),
('TA-GDGJKT2011132','2020-11-13 00:00:00','Dedi','aaaaaa ','JAMBI',NULL,'082110521323','17131','DN',2000000,3,'2',NULL,'GDGJKT',1,'Tunai','NUryanto','kalimalang ','ACEH','082110521323','15151'),
('TA-GDGJKT2011133','2020-11-13 00:00:00','Afandi','Jambi ','JAMBI',NULL,'08287866686788','17131','DN',2000000,3,'2',NULL,'GDGJKT',1,'Tunai','Zahra','Sigri','ACEH','0821107879977','17510'),
('TA-GDGJKT2012141','2020-12-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL),
('TA-GDGJKT2012142','2020-12-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL),
('TA-GDGJKT2012143','2020-12-14 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL),
('TA-GDGJKT2012151','2020-12-15 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL),
('TA-GDGJKT2012161','2020-12-16 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL),
('TA-GDGJKT2012162','2020-12-16 00:00:00','Wahyu','dsfsdf','LANGSA',NULL,'43535','4353','darat-kg',2000000,0,NULL,NULL,'GDGJKT',1,'Tunai','Nuryanto','dsfsdf','ACEH','4353535','32423'),
('TA-GDGJKT2012163','2020-12-16 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'GDGJKT',0,'Tunai',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `connote_detail` */

DROP TABLE IF EXISTS `connote_detail`;

CREATE TABLE `connote_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `conn_code` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `berat_actual` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `connote_detail` */

insert  into `connote_detail`(`id_detail`,`conn_code`,`id_barang`,`qty`,`berat_actual`) values 
(2,'TA-GDGBKS2011111',21,1,2.00),
(3,'TA-GDGBKS2011111',27,1,2.00),
(7,'TA-GDGJKT2011131',23,1,5.00),
(8,'TA-GDGJKT2011132',34,1,1.00),
(9,'TA-GDGJKT2011132',35,1,1.00),
(10,'TA-GDGJKT2011133',34,11,1.00),
(11,'TA-GDGJKT2011133',35,10,1.00),
(12,'TA-GDGJKT2012141',35,1,1.00),
(13,'TA-GDGJKT2012141',34,1,1.00),
(14,'TA-GDGJKT2012142',27,1,1.00),
(15,'TA-GDGJKT2012143',21,1,1.00),
(16,'TA-GDGJKT2012151',34,1,1.00),
(17,'TA-GDGJKT2012161',35,1,0.00),
(18,'TA-GDGJKT2012161',34,1,1.00),
(19,'TA-GDGJKT2012162',34,1,1.00),
(20,'TA-GDGJKT2012163',34,1,1.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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

/*Table structure for table `tb_bank` */

DROP TABLE IF EXISTS `tb_bank`;

CREATE TABLE `tb_bank` (
  `id_bank` int(100) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `cabang` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `status_del` enum('Y','T') NOT NULL COMMENT 'apus ya / tidak',
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bank` */

insert  into `tb_bank`(`id_bank`,`nama_bank`,`no_rek`,`cabang`,`kota`,`status_del`) values 
(1,'BCA','0027162812','KCP 21 Gubeng , Surabaya','Surabaya','T'),
(2,'','','','','Y'),
(3,'BRI','992612916','Nginden , Panurakan','Panurakan','T'),
(4,'Maybank','2149921024719','Kenjeran . jalan Pulau mentari nomor 21 KCP 99271','Surabaya','T'),
(5,'asdasd','12','12','12','Y'),
(6,'12312','3123','3123','213','Y'),
(7,'4141','4141','4141','4141','Y'),
(8,'Central Asia 23','287518209','Kertoraharjo','Surabaya','Y'),
(9,'114','1414','1414','14','Y'),
(10,'123','124124','12412','4124','Y'),
(11,'123','123','123','123','Y');

/*Table structure for table `tb_cabang` */

DROP TABLE IF EXISTS `tb_cabang`;

CREATE TABLE `tb_cabang` (
  `kode_cabang` varchar(255) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp_cabang` varchar(255) NOT NULL,
  `kota` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_cabang` */

insert  into `tb_cabang`(`kode_cabang`,`nama_cabang`,`alamat`,`telp_cabang`,`kota`) values 
('GDGBKS','Gudang Bekasi','123123','123-1231-2312','BEKASI'),
('GDGJKT','HO JKT','123','','JAKARTA'),
('GDGKRW','Gudang Karawang','Graha rima','082-1398-9898','KARAWANG');

/*Table structure for table `tb_karyawan` */

DROP TABLE IF EXISTS `tb_karyawan`;

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(100) NOT NULL AUTO_INCREMENT,
  `id_cabang` int(10) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL COMMENT '''Laki laki / Perempuan''',
  `alamat_karyawan` text NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nomor_telp` varchar(255) NOT NULL,
  `gaji` int(255) NOT NULL,
  `status_del` enum('Y','T') NOT NULL COMMENT 'Hapus ya / tidak',
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_karyawan` */

insert  into `tb_karyawan`(`id_karyawan`,`id_cabang`,`nama_karyawan`,`jenis_kelamin`,`alamat_karyawan`,`tempat_lahir`,`tgl_lahir`,`nomor_telp`,`gaji`,`status_del`) values 
(1,3,'Paijo','P','<p>123</p>\r\n','123123','3123-03-12','123123123',123123,'T'),
(2,0,'paiji','L','<p>123123</p>\r\n','123123','0123-03-12','123123',123132,'T'),
(3,0,'barsa','L','<p>123</p>\r\n','','0000-00-00','123',123123,'T');

/*Table structure for table `tb_kota` */

DROP TABLE IF EXISTS `tb_kota`;

CREATE TABLE `tb_kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origin` varchar(20) NOT NULL,
  `destination` varchar(20) NOT NULL,
  PRIMARY KEY (`id`,`origin`,`destination`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kota` */

insert  into `tb_kota`(`id`,`origin`,`destination`) values 
(1,'BKS','JKT'),
(2,'JKT','BANYUMAS');

/*Table structure for table `tb_moda` */

DROP TABLE IF EXISTS `tb_moda`;

CREATE TABLE `tb_moda` (
  `kode_moda` char(20) NOT NULL,
  `nama_moda` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_moda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_moda` */

insert  into `tb_moda`(`kode_moda`,`nama_moda`) values 
('AD','Darat'),
('C4','CONTAINER 40 FEET '),
('CD','CD6'),
('CR','Carter'),
('darat-cde-bak','CDE BAK'),
('darat-cde-box','CDE BOX'),
('darat-fuso-bak','FUSO BAK'),
('darat-fuso-box','FUSO BOX'),
('darat-kg','UMUM KG'),
('DN','Darat NTE'),
('LA','Laut'),
('PU','Pickup'),
('UD','Udara'),
('UK','Udara KG'),
('UN','Udara NTE');

/*Table structure for table `tb_operation` */

DROP TABLE IF EXISTS `tb_operation`;

CREATE TABLE `tb_operation` (
  `id_operation` int(100) NOT NULL AUTO_INCREMENT,
  `nama_operation` varchar(255) NOT NULL,
  `biaya_operation` int(255) NOT NULL,
  `status_del` enum('Y','T') NOT NULL COMMENT '''Ya dan Tidak''',
  PRIMARY KEY (`id_operation`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_operation` */

insert  into `tb_operation`(`id_operation`,`nama_operation`,`biaya_operation`,`status_del`) values 
(1,'Uang Makan',210003,'Y'),
(2,'Uang Bensin',210000,'T');

/*Table structure for table `tb_origin` */

DROP TABLE IF EXISTS `tb_origin`;

CREATE TABLE `tb_origin` (
  `id_origin` int(100) NOT NULL AUTO_INCREMENT,
  `kota_asal` varchar(255) NOT NULL,
  `kota_tujuan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_origin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_origin` */

insert  into `tb_origin`(`id_origin`,`kota_asal`,`kota_tujuan`) values 
(1,'ACEH','JAMBI'),
(2,'ACEH','ACEH'),
(3,'ACEH','LAMPUNG'),
(4,'ACEH','LANGSA'),
(5,'BABEL','KOBA'),
(6,'BABEL','MENTOK'),
(7,'BABEL','PANGKAL PINANG');

/*Table structure for table `tb_services` */

DROP TABLE IF EXISTS `tb_services`;

CREATE TABLE `tb_services` (
  `id_services` int(11) NOT NULL AUTO_INCREMENT,
  `nama_services` varchar(200) DEFAULT NULL,
  `id_origin` int(11) NOT NULL,
  `kode_moda` varchar(2) NOT NULL,
  `estimasi_day` varchar(200) DEFAULT NULL,
  `tarif` float DEFAULT NULL,
  PRIMARY KEY (`id_services`,`kode_moda`,`id_origin`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_services` */

insert  into `tb_services`(`id_services`,`nama_services`,`id_origin`,`kode_moda`,`estimasi_day`,`tarif`) values 
(1,'Reguler',1,'AD','1-3 Hari',11000),
(2,'Reguler',1,'UK','1 Hari',18000),
(3,'Reguler',1,'DN','3-5 Hari',13000),
(4,'Reguler',1,'LA','1-3 Hari',3500),
(5,'Reguler',1,'UD','1 Hari',20000),
(6,'Reguler',3,'AD','1-3 Hari',18000),
(7,'Reguler',3,'DN','3-5 Hari',21000);

/*Table structure for table `tb_supir` */

DROP TABLE IF EXISTS `tb_supir`;

CREATE TABLE `tb_supir` (
  `id_supir` int(100) NOT NULL AUTO_INCREMENT,
  `kode_supir` varchar(100) NOT NULL,
  `nama_supir` varchar(255) NOT NULL,
  `tempat_lahir_supir` varchar(255) NOT NULL,
  `tgl_lahir_supir` date NOT NULL,
  `alamat_supir` text NOT NULL,
  `usia` int(11) NOT NULL,
  `nomor_telp` varchar(100) NOT NULL,
  `status_del` enum('Y','T') NOT NULL,
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_supir` */

insert  into `tb_supir`(`id_supir`,`kode_supir`,`nama_supir`,`tempat_lahir_supir`,`tgl_lahir_supir`,`alamat_supir`,`usia`,`nomor_telp`,`status_del`) values 
(1,'2ZLZY','Bisras','123123','2112-12-12','123123',-95,'123123','Y');

/*Table structure for table `tb_tarif` */

DROP TABLE IF EXISTS `tb_tarif`;

CREATE TABLE `tb_tarif` (
  `id_tarif` int(100) NOT NULL AUTO_INCREMENT,
  `kota_tujuan` varchar(255) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `tarif_kubik` int(255) NOT NULL,
  `tarif_km` int(255) NOT NULL,
  `status_del` enum('Y','T') NOT NULL COMMENT 'Hapus ya / tidak',
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_tarif` */

insert  into `tb_tarif`(`id_tarif`,`kota_tujuan`,`kota_asal`,`tarif_kubik`,`tarif_km`,`status_del`) values 
(1,'Jakarta','MEdan',42000,12000,'Y'),
(2,'124','124',124,124,'Y'),
(3,'Kenjeran','Surabaya',12000,30000,'T');

/*Table structure for table `tb_toko` */

DROP TABLE IF EXISTS `tb_toko`;

CREATE TABLE `tb_toko` (
  `id_toko` int(100) NOT NULL AUTO_INCREMENT,
  `owner_toko` varchar(255) NOT NULL,
  `jenis_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `email_toko` varchar(255) NOT NULL,
  `telp_toko` varchar(255) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `tipe_toko` varchar(100) NOT NULL COMMENT '1 : Penjual , 2 : Customer',
  `disc` int(5) NOT NULL,
  `nama_npwp` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `status_del` enum('Y','T') NOT NULL COMMENT 'Hapus ya / tidak',
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_toko` */

insert  into `tb_toko`(`id_toko`,`owner_toko`,`jenis_toko`,`alamat_toko`,`email_toko`,`telp_toko`,`nama_toko`,`tipe_toko`,`disc`,`nama_npwp`,`npwp`,`status_del`) values 
(1,'Supardi','Penjualan Pakaian','<p>Jl Kenjeran nomor 21&nbsp;</p>\r\n','zxc_services@gmail.com','031-7721-4441','zxc_de Distro','penjual',10,'ZXC DE DISTRO','29.917.729.4-018.263','Y'),
(2,'Supardi','Penjualan Pakaian','<p>Jl Kenjeran nomor 21&nbsp;</p>\r\n','zxc_services@gmail.com','031-7721-4441','zxc_de Distro','penjual',100,'ZXC DE DISTRO','29.917.729.4-018.263','Y'),
(3,'Bluescrint','zxc','<p>Filll</p>\r\n','zcx@gmail.com','034-1241-2122','123','penjual',12,'123123123','12.312.312.3-123.123','T'),
(4,'asdzz','asd','<p>asd</p>\r\n','asd@gmail.com','120-3124-1241','asdasdasdasd','customer',1,'123','12.312.312.3-123.123','T');

/*Table structure for table `tb_truck` */

DROP TABLE IF EXISTS `tb_truck`;

CREATE TABLE `tb_truck` (
  `id_truck` int(100) NOT NULL AUTO_INCREMENT,
  `kode_supir` varchar(199) NOT NULL,
  `nomor_polisi` varchar(100) NOT NULL,
  `tanggal_pajak` date NOT NULL,
  `tanggal_kir` date NOT NULL,
  `status_del` enum('Y','T') NOT NULL,
  PRIMARY KEY (`id_truck`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_truck` */

insert  into `tb_truck`(`id_truck`,`kode_supir`,`nomor_polisi`,`tanggal_pajak`,`tanggal_kir`,`status_del`) values 
(1,'2ZLZY','Z 2121 Ls','1212-12-12','1212-12-12','Y');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int(100) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`nama_user`,`password`,`id_role`) values 
(1,'admin','21232f297a57a5a743894a0e4a801fc3','1'),
(2,'superadmin','17c4520f6cfd1ab53d8745e84681eb49','2');

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
