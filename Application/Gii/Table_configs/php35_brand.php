<?php
return array(
	'tableName' => 'php35_brand',    // 表名
	'tableCnName' => '品牌',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => TRUE,  // 是否生成相应权限的数据
	'topPriName' => '商品模块',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('brand_name','site')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','brand_name','site')",
	'validate' => "
		array('brand_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('brand_name', '1,150', '商品名称的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('site', '1,150', '官方网址的值最长不能超过 150 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'brand_name' => array(
			'text' => '商品名称',
			'type' => 'text',
			'default' => '',
		),
		'logo' => array(
			'text' => 'logo',
			'type' => 'file',
			'save_fields' => array('logo'),
			'default' => '',
		),
		'site' => array(
			'text' => '官方网址',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('brand_name', 'normal', '', 'like', '商品名称'),
	),
);