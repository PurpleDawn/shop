-- MySQL dump 10.13  Distrib 5.5.24, for Win32 (x86)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.5.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shop_goods`
--

DROP TABLE IF EXISTS `shop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `goods_name` varchar(30) NOT NULL COMMENT '商品名称',
  `goods_desc` longtext COMMENT '商品描述',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价格',
  `shop_price` decimal(10,2) NOT NULL COMMENT '本店价格',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo小的缩略图',
  `mid_logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo中的缩略图',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价',
  `promote_start_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销开始时间',
  `promote_end_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销结束时间',
  `is_new` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否新品',
  `is_hot` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否热销',
  `is_best` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否精品',
  `is_on_sale` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否上架',
  `sort_num` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '精确排序用的字段',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `shop_price` (`shop_price`),
  KEY `is_new` (`is_new`),
  KEY `is_best` (`is_best`),
  KEY `is_hot` (`is_hot`),
  KEY `is_on_sale` (`is_on_sale`),
  KEY `sort_num` (`sort_num`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_goods`
--

LOCK TABLES `shop_goods` WRITE;
/*!40000 ALTER TABLE `shop_goods` DISABLE KEYS */;
INSERT INTO `shop_goods` VALUES (2,'星云','<p>星云<span style=\"color:#00b0f0;\">撒哈佛is阿虎费</span><br /></p>',14314.00,324123.00,'Goods/2016-06-22/576a49da83b7a.jpg','Goods/2016-06-22/sm_576a49da83b7a.jpg','Goods/2016-06-22/mid_576a49da83b7a.jpg',0.00,0,0,'是','是','是','是',100,1466583516),(3,'联想手机','<p>safjdsa<br /></p>',1234.00,1222.00,'Goods/2016-06-22/576a56267fdc9.gif','Goods/2016-06-22/sm_576a56267fdc9.gif','Goods/2016-06-22/mid_576a56267fdc9.gif',0.00,0,0,'是','是','是','是',100,1466586667),(4,'未闻花名','',5314.00,1244.00,'Goods/2016-06-22/576a567ebce69.jpeg','Goods/2016-06-22/sm_576a567ebce69.jpeg','Goods/2016-06-22/mid_576a567ebce69.jpeg',0.00,0,0,'是','是','是','是',100,1466586751),(5,'大圣归来','<p>齐天大圣孙悟空<br /></p>',50.00,20.00,'Goods/2016-06-22/576a569e4b6a6.jpg','Goods/2016-06-22/sm_576a569e4b6a6.jpg','Goods/2016-06-22/mid_576a569e4b6a6.jpg',0.00,0,0,'是','是','是','是',100,1466586783),(6,'EVA','新世纪福音战士<p><br /></p>',4134.00,1233.00,'Goods/2016-06-22/576a56c925a54.jpg','Goods/2016-06-22/sm_576a56c925a54.jpg','Goods/2016-06-22/mid_576a56c925a54.jpg',0.00,0,0,'是','是','是','是',100,1466586826);
/*!40000 ALTER TABLE `shop_goods` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-27 14:44:06
