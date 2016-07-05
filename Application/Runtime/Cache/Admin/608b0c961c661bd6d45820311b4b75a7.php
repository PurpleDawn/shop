<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 修改商品属性 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('lst') ?>">商品列表</a>
    </span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 修改商品属性 </span>
    <div style="clear:both"></div>
</h1>

<link href="/Public/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form action="<?php echo U('edit'); ?>" method="post" enctype="multipart/form-data" >
            <table width="90%" id="general-table" align="center">
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>"/>
                <tr>
                    <td class="label">Logo</td>
                    <td>
                        <input type="file" name="logo" />
                        <img src="/Public/Uploads/<?php echo $info['sm_logo']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo $info['goods_name']; ?>"size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">市场价格：</td>
                    <td><input type="text" name="market_price" value="<?php echo $info['market_price']; ?>"size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">本店价格：</td>
                    <td><input type="text" name="shop_price" value="<?php echo $info['shop_price']; ?>"size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">排序数字：</td>
                    <td>
                        <input type="text" name="sort_num" value="<?php echo $info['sort_num']; ?>" size="20"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">推荐</td>
                    <td>
                        <input type="checkbox" <?php if($info['is_new'] == '是') echo 'checked="checked"'; ?> name="is_new" value="是" /> 新品
                        <input type="checkbox" <?php if($info['is_hot'] == '是') echo 'checked="checked"'; ?> name="is_hot" value="是" /> 热销
                        <input type="checkbox" <?php if($info['is_best'] == '是') echo 'checked="checked"'; ?> name="is_best" value="是" /> 精品
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="是" <?php if($info['is_on_sale'] == '是') echo 'checked="checked"'; ?> /> 是
                        <input type="radio" name="is_on_sale" value="否" <?php if($info['is_on_sale'] == '否') echo 'checked="checked"'; ?> /> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                        <textarea id="goods_desc" name="goods_desc"><?php echo $info['goods_desc'] ?></textarea>
                    </td>
                </tr>
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>

<div id="footer">
    共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>

<script>
    UM.getEditor("goods_desc", {
        initialFrameWidth : "700px"
    });
</script>