<?php
return array(
	//'配置项'=>'配置值'
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀

    'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...
    /************ 图片相关配置 ***********/
    'IMAGE_PREFIX' => '/Public/Uploads/',
    'IMAGE_SAVE_PATH' => './Public/Uploads/',
    'IMG_maxSize' => 2, // 单位M
    'IMG_exts' => array('jpg', 'gif', 'png', 'jpeg', 'pjpeg'),
);