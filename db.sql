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

/************************ RBAC ***********************/
DROP TABLE IF EXISTS shop_privilege;
CREATE TABLE shop_privilege
(
    id SMALLINT UNSIGNED NOT NULL  AUTO_INCREMENT COMMENT 'Id',
    pri_name VARCHAR(30) NOT NULL COMMENT '权限名称',
    module_name VARCHAR(30) NOT NULL COMMENT '模块名称',
    controller_name VARCHAR(30) NOT NULL COMMENT '控制器名称',
    action_name VARCHAR(30) NOT NULL COMMENT '方法名称',
    parent_id SMALLINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级权限的ID，0：顶级权限',
    sort_num TINYINT UNSIGNED NOT NULL DEFAULT '100' COMMENT '排序用的数字',
    PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '权限';

DROP TABLE IF EXISTS shop_role_pri;
CREATE TABLE shop_role_pri
(
    pri_id SMALLINT UNSIGNED NOT NULL COMMENT '权限id',
    role_id TINYINT UNSIGNED NOT NULL COMMENT '角色id',
    key pri_id(pri_id),
    key role_id(role_id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '角色权限';

DROP TABLE IF EXISTS shop_role;
CREATE TABLE shop_role
(
    id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    role_name VARCHAR(30) NOT NULL COMMENT '角色名称',
    PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '角色';

DROP TABLE IF EXISTS shop_admin_role;
CREATE TABLE shop_admin_role
(
    role_id TINYINT UNSIGNED NOT NULL COMMENT '角色id',
    admin_id TINYINT UNSIGNED NOT NULL COMMENT '管理员id',
    KEY role_id(role_id),
    KEY admin_id(admin_id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '管理员角色';

DROP TABLE IF EXISTS shop_admin;
CREATE TABLE shop_admin
(
    id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    username VARCHAR(30) NOT NULL COMMENT '账号',
    password CHAR(32) NOT NULL COMMENT '密码',
    is_deny ENUM('是','否') NOT NULL DEFAULT '否' COMMENT '是否禁用',
    PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '管理员';
INSERT INTO shop_admin VALUES (1,'root','63a9f0ea7bb98050796b649e85481845','否');