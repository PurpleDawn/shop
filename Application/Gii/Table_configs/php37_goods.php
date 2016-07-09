<?php
return array(
	'tableName' => 'php37_goods',    // 表名
	'tableCnName' => '商品',  // 表的中文名
	'moduleName' => 'Test',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('goods_name','goods_desc','market_price','shop_price','promote_price','promote_start_date','promote_end_date','is_new','is_hot','is_best','is_on_sale','sort_num')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','goods_name','goods_desc','market_price','shop_price','promote_price','promote_start_date','promote_end_date','is_new','is_hot','is_best','is_on_sale','sort_num')",
	'validate' => "
		array('goods_name', 'require', '商品名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,30', '商品名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('market_price', 'require', '市场价格不能为空！', 1, 'regex', 3),
		array('market_price', 'currency', '市场价格必须是货币格式！', 1, 'regex', 3),
		array('shop_price', 'require', '本店价格不能为空！', 1, 'regex', 3),
		array('shop_price', 'currency', '本店价格必须是货币格式！', 1, 'regex', 3),
		array('promote_price', 'currency', '促销价必须是货币格式！', 2, 'regex', 3),
		array('promote_start_date', 'number', '促销开始时间必须是一个整数！', 2, 'regex', 3),
		array('promote_end_date', 'number', '促销结束时间必须是一个整数！', 2, 'regex', 3),
		array('is_new', '是,否', \"是否新品的值只能是在 '是,否' 中的一个值！\", 2, 'in', 3),
		array('is_hot', '是,否', \"是否热销的值只能是在 '是,否' 中的一个值！\", 2, 'in', 3),
		array('is_best', '是,否', \"是否精品的值只能是在 '是,否' 中的一个值！\", 2, 'in', 3),
		array('is_on_sale', '是,否', \"是否上架的值只能是在 '是,否' 中的一个值！\", 2, 'in', 3),
		array('sort_num', 'number', '精确排序用的字段必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'goods_name' => array(
			'text' => '商品名称',
			'type' => 'text',
			'default' => '',
		),
		'goods_desc' => array(
			'text' => '商品描述',
			'type' => 'html',
			'default' => '',
		),
		'market_price' => array(
			'text' => '市场价格',
			'type' => 'text',
			'default' => '',
		),
		'shop_price' => array(
			'text' => '本店价格',
			'type' => 'text',
			'default' => '',
		),
		// 判断如果字段的名称中带这几个字符：logo|pic|image|face
		'logo' => array(
			'text' => 'logo',
			'type' => 'file',
			'thumbs' => array(
				array(600, 600, 2),
				array(130, 130, 2),
			),
			'save_fields' => array('logo', 'mid_logo', 'sm_logo'),
			'default' => '',
		),
		'promote_price' => array(
			'text' => '促销价',
			'type' => 'text',
			'default' => '0.00',
		),
		'promote_start_date' => array(
			'text' => '促销开始时间',
			'type' => 'text',
			'default' => '0',
		),
		'promote_end_date' => array(
			'text' => '促销结束时间',
			'type' => 'text',
			'default' => '0',
		),
		'is_new' => array(
			'text' => '是否新品',
			'type' => 'radio',
			'values' => array(
				'是' => '是',
				'否' => '否',
			),
			'default' => '是',
		),
		'is_hot' => array(
			'text' => '是否热销',
			'type' => 'radio',
			'values' => array(
				'是' => '是',
				'否' => '否',
			),
			'default' => '是',
		),
		'is_best' => array(
			'text' => '是否精品',
			'type' => 'radio',
			'values' => array(
				'是' => '是',
				'否' => '否',
			),
			'default' => '是',
		),
		'is_on_sale' => array(
			'text' => '是否上架',
			'type' => 'radio',
			'values' => array(
				'是' => '是',
				'否' => '否',
			),
			'default' => '是',
		),
		'sort_num' => array(
			'text' => '精确排序用的字段',
			'type' => 'text',
			'default' => '100',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('goods_name', 'normal', '', 'like', '商品名称'),
		array('shop_price', 'between', 'shop_pricefrom,shop_priceto', '', '本店价格'),
		array('is_new', 'in', '是-是,否-否', '', '是否新品'),
		array('is_hot', 'in', '是-是,否-否', '', '是否热销'),
		array('is_best', 'in', '是-是,否-否', '', '是否精品'),
		array('is_on_sale', 'in', '是-上架,否-下架', '', '是否上架'),
		array('addtime', 'betweenTime', 'st,et', '', '添加时间'),
	),
);