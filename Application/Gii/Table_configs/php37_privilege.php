<?php
return array(
	'tableName' => 'php37_privilege',    // 表名
	'tableCnName' => '权限',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 1,             // 是否无限级（递归）
	'diguiName' => 'pri_name',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('pri_name','module_name','controller_name','action_name','parent_id','sort_num')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','pri_name','module_name','controller_name','action_name','parent_id','sort_num')",
	'validate' => "
		array('pri_name', 'require', '权限名称不能为空！', 1, 'regex', 3),
		array('pri_name', '1,30', '权限名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('module_name', 'require', '对应模块不能为空！', 1, 'regex', 3),
		array('module_name', '1,30', '对应模块的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('controller_name', 'require', '控制器名称不能为空！', 1, 'regex', 3),
		array('controller_name', '1,30', '控制器名称的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('action_name', 'require', '对应的方法不能为空！', 1, 'regex', 3),
		array('action_name', '1,30', '对应的方法的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('parent_id', 'number', '上级权限的ID，0：顶级权限必须是一个整数！', 2, 'regex', 3),
		array('sort_num', 'number', '排序用的数字必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'pri_name' => array(
			'text' => '权限名称',
			'type' => 'text',
			'default' => '',
		),
		'module_name' => array(
			'text' => '对应模块',
			'type' => 'text',
			'default' => '',
		),
		'controller_name' => array(
			'text' => '对应控制器',
			'type' => 'text',
			'default' => '',
		),
		'action_name' => array(
			'text' => '对应的方法',
			'type' => 'text',
			'default' => '',
		),
		'parent_id' => array(
			'text' => '上级权限',
			'type' => 'text',
			'default' => '0',
		),
		'sort_num' => array(
			'text' => '排序用的数字',
			'type' => 'text',
			'default' => '100',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
	),
);