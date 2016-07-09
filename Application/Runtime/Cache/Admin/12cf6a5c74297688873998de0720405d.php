<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo $_page_title; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>

<script type="text/javascript" language="javascript" src="/Public/datepicker/jquery-1.7.2.min.js"></script>

<body>
<h1>
    <span class="action-span"><a href="<?php echo U($_page_btn_link); ?>"><?php echo $_page_btn_name ?></a>
    </span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title; ?> </span>
    <div style="clear:both"></div>
</h1>

<!-- 页面中的内容所在位置 -->


<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datepicker/datepicker_zh-cn.js"></script>

<div class="form-div">
    <form method="get" action="<?php echo U('lst') ?>" name="searchForm">
        <img src="/Public/Admin/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
        商品名称：<input type="text" name="goods_name" size="15" value="<?php echo I('get.goods_name'); ?>" />
        商品描述：<input type="text" name="goods_desc" size="15" value="<?php echo I('get.goods_desc'); ?>" />
        价格：从<input type="text" name="from" size="15" value="<?php echo I('get.from'); ?>" />
            到<input type="text" name="to" size="15" value="<?php echo I('get.to'); ?>" />
        添加时间：从<input type="text" id="st" name="st" size="15" value="<?php echo I('get.st'); ?>" />
            到<input type="text" id="et" name="et" size="15" value="<?php echo I('get.et') ?>" />
        <P>商品分类：
            <select name="cat_id">
                <option value="0">选择分类</option>
                <?php
 $catId = I('get.cat_id'); foreach ($catData as $v): if($catId == $v['id']) $select = 'selected="selected"'; else $select = ""; ?>
                <option <?php echo $select ?> value="<?php echo $v['id'] ?>"><?php echo str_repeat('-', $v['level'] * 8) . $v['cat_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value=" 搜索 " class="button"/>
        </P>

    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>id</th>
                <th>商品名称</th>
                <th>商品LOGO</th>
                <th>市场价格</th>
                <th>本店价格</th>
                <th>是否上架</th>
                <th>是否热卖</th>
                <th>是否精品</th>
                <th>是否新品</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php foreach($data as $k => $v): ?>
            <tr class="tron">
                <td align="center"><?php echo $v['id']; ?></td>
                <td align="center"><?php echo $v['goods_name']; ?></td>
                <td align="center"><?php  showImage($v['sm_logo']); ?></td>
                <td align="center"><?php echo $v['market_price']; ?></td>
                <td align="center"><?php echo $v['shop_price']; ?></td>
                <td align="center"><?php echo $v['is_on_sale']; ?></td>
                <td align="center"><?php echo $v['is_hot']; ?></td>
                <td align="center"><?php echo $v['is_best']; ?></td>
                <td align="center"><?php echo $v['is_new']; ?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s', $v['addtime']); ?></td>
                <td align="center">
                    <a href="<?php echo U('edit?id='.$v['id']); ?>" title="编辑">编辑</a>
                    <a onclick="return confirm('确定要移除吗？');" href="<?php echo U('delete?id='.$v['id']); ?>" title="移除">移除</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td align="right" nowrap="true" colspan="13">
                    <div id="turn-page">
                        <?php echo $page; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>
<script type="text/javascript" charset="utf-8" src="/Public/Admin/Js/tron.js"></script>
<script>
    $("#st").datepicker({ dateFormat: "yy-mm-dd" });
    $("#et").datepicker({ dateFormat: "yy-mm-dd" });
</script>



<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>