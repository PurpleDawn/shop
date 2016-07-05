CREATE DATABASE IF NOT EXISTS shop;
USE shop;
SET NAMES utf8;

DROP TABLE IF EXISTS shop_goods;
CREATE TABLE shop_goods
(
    id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
    goods_name VARCHAR(30) NOT NULL COMMENT '商品名称',
    goods_desc LONGTEXT COMMENT '商品描述',
    market_price DECIMAL(10,2) NOT NULL COMMENT '市场价格',
    shop_price DECIMAL(10,2) NOT NULL COMMENT '本店价格',
    logo VARCHAR(150) NOT NULL DEFAULT '' COMMENT 'logo',
    sm_logo VARCHAR(150) NOT NULL DEFAULT '' COMMENT 'logo小的缩略图',
    mid_logo VARCHAR(150) NOT NULL DEFAULT '' COMMENT 'logo中的缩略图',
    promote_price DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价',
    promote_start_date INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销开始时间',
    promote_end_date INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销结束时间',
    is_new ENUM('是','否') NOT NULL DEFAULT '是' COMMENT '是否新品',
    is_hot ENUM('是','否') NOT NULL DEFAULT '是' COMMENT '是否热销',
    is_best ENUM('是','否') NOT NULL DEFAULT '是' COMMENT '是否精品',
    is_on_sale ENUM('是','否') NOT NULL DEFAULT '是' COMMENT '是否上架',
    sort_num TINYINT UNSIGNED NOT NULL DEFAULT '100' COMMENT '精确排序用的字段',
    addtime INT UNSIGNED NOT NULL COMMENT '添加时间',
    PRIMARY KEY (id),
    KEY shop_price(shop_price),
    KEY is_new(is_new),
    KEY is_best(is_best),
    KEY is_hot(is_hot),
    KEY is_on_sale(is_on_sale),
    KEY sort_num(sort_num)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '商品';

DROP TABLE IF EXISTS shop_category;
CREATE TABLE shop_category
(
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
    cat_name VARCHAR(30) NOT NULL COMMENT '分类名称',
    parent_id SMALLINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级分类的ID，0：顶级分类',
    PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '分类';

DROP TABLE IF EXISTS shop_goods_cat;
CREATE TABLE shop_goods_cat
(
    goods_id MEDIUMINT UNSIGNED NOT NULL COMMENT '商品id',
    cat_id SMALLINT UNSIGNED NOT NULL COMMENT '分类id',
    KEY (goods_id),
    KEY (cat_id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '商品分类';