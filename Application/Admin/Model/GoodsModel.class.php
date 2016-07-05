<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    // 添加时调用create方法允许接收的字段
    protected $insertFields = 'goods_name,market_price,shop_price,sort_num,is_on_sale';
    // 修改时调用create方法允许接收的字段
    protected $updateFields = 'id,goods_name,market_price,shop_price,sort_num,is_on_sale';
    // 定义表单验证规则
    // 第四个参数：什么情况验证：0：字段存在时候验证【默认】 1：必须验证 2：字段存在且值不为空时候验证
    protected $_validate = array(
        array('goods_name', 'require', '商品名称不能为空', 1),
        array('market_price', 'require', '市场价格不能为空', 1),
        array('shop_price', 'require', '本店价格不能为空', 1),
        array('market_price', 'currency', '市场价格必须是货币类型', 1),
        array('shop_price', 'currency', '本店价格必须是货币类型', 1)
    );
    // 如果定义了这个函数，TP在添加一个数据之前先调用这个函数
    protected function _before_insert(&$data, $option){
        $data['is_new'] = I('post.is_new', '否');
        $data['is_hot'] = I('post.is_hot', '否');
        $data['is_best'] = I('post.is_best', '否');
        /******************* 如果用户上传了图片就先上传图片，把上传之后的照片路径填写到表单中 ***************/
        if($_FILES['logo']['error'] == 0){
            $upload = new \Think\Upload(array(
                'rootPath' => './Public/Uploads/',
                'exts' => array('gif', 'png', 'jpg', 'jpeg'),
                'maxsize' => 2 * 1024 * 1024,
                'savePath' => 'Goods/',
            ));
            // 上传文件
            $info = $upload->upload();
            if (!$info){
                // 先把错误信息传给模型，在控制器中会调用这个模型的getError方法$model->getError()并显示
                // 原因：【模型只负责返回false，true，由控制器负责获取错误信息并显示】
                $this->error = $upload->getError();
                return FALSE;
            }else{
                // 获取原图上名称
                $logo = $info['logo']['savepath'] . $info['logo']['savename'];
                // 拼出缩略图的名称
                $midlogo = $info['logo']['savepath'] . 'mid_' . $info['logo']['savename'];
                $smlogo = $info['logo']['savepath'] . 'sm_' . $info['logo']['savename'];
                /************* 生成两张缩略图 **************/
                $image = new \Think\Image(); // 生成图片处理类的对象
                $image->open('./Public/Uploads/' . $logo); // 打开刚刚上传的原图
                // 第三个参数：缩略图的方法 1：按比例缩放，共六个参数
                $image->thumb(650, 650, 1)->save('./Public/Uploads/' . $midlogo); // 生成中图
                $image->thumb(130, 130, 1)->save('./Public/Uploads/' . $smlogo); // 生成小图
                // 把图片路径放到表单中
                $data['logo'] = $logo;
                $data['mid_logo'] = $midlogo;
                $data['sm_logo'] = $smlogo;
            }
        }
        // 用我们自己过滤的原始数据，覆盖掉表单中TP使用I函数过滤的
        $data['goods_desc'] = removeXSS($_POST['goods_desc']);
        // 表单中填补一个当前时间
        $data['addtime'] = time();
    }

    // 商品列表页 翻页，排序，搜索
    public function search($perPage = 15){
        /*************** 构造搜索用的 $where 变量 *************/
        $where = array();
        // 判断用户有没有传商品名称
        $goodsName = I('get.goods_name');
        if ($goodsName)
            $where['goods_name'] = array('like', "%$goodsName%");
        // 商品描述
        $goodsDesc = I('get.goods_desc');
        if ($goodsDesc)
            $where['goods_desc'] = array('link', "%$goodsDesc%");
        // 价格搜索
        $from = I('get.from'); // 开始价格
        $to  = I('get.to'); // 最终价格
        if ($from && $to)
            $where['shop_price'] = array('between', array($from, $to));
        elseif ($from)
            $where['shop_price'] = array('egt', $from);
        elseif ($to)
            $where['shop_price'] = array('elt', $to);
        /*************************** 构造翻页用的 limit 变量 ****************************/
        // 取出总的记录数
        $count = $this->where($where)->count();
        $pageObj = new \Think\Page($count, $perPage);
        // 生成翻页字符串
        $pageString = $pageObj->show();
        /******************** 构造排序用的 orderby orderway 的变量 ********************/
        $orderby = 'id'; // 默认排序的字段
        $orderway = 'desc'; // 默认排序的方式
        $ob = I('get.ob');
        $ow = I('get.ow');
        if ($ob && in_array($ob, array('id','shop_price')))
            $orderby = $ob;
        if ($ow && in_array($ow, array('asc','desc')))
            $orderway = $ow;
        /**************** 用前面构造的变量提取数据 ***************/
        // SELECT * FROM shop_goods
        $data = $this->where($where)
                            ->limit($pageObj->firstRow.','.$pageObj->listRows)
                            ->order("$orderby $orderway")
                            ->select();
        // 调用这个查看TP拼的SQL
        //echo $this->getLastSql(),"<hr />";
        /*************** 返回数据 **************/
        return array(
            'data' => $data,
            'page' => $pageString,
        );
    }

    // 在删除之前
    protected function _before_delete($option){
        // 根据商品ID取出商品图片的路径
        $logo = $this->field('logo,sm_logo,mid_logo')->find($option['where']['id']);
        unlink('./Public/Uploads/'.$logo['logo']);
        unlink('./Public/Uploads/'.$logo['sm_logo']);
        unlink('./Public/Uploads/'.$logo['mid_logo']);
    }

    protected function _before_update(&$data, $option){
        $data['is_new'] = I('post.is_new', '否');
        $data['is_hot'] = I('post.is_hot', '否');
        $data['is_best'] = I('post.is_best', '否');
        /******************* 如果用户上传了图片就先上传图片，把上传之后的照片路径填写到表单中 ***************/
        if($_FILES['logo']['error'] == 0){
            $upload = new \Think\Upload(array(
                'rootPath' => './Public/Uploads/',
                'exts' => array('gif', 'png', 'jpg', 'jpeg'),
                'maxsize' => 2 * 1024 * 1024,
                'savePath' => 'Goods/',
            ));
            // 上传文件
            $info = $upload->upload();
            if (!$info){
                // 先把错误信息传给模型，在控制器中会调用这个模型的getError方法$model->getError()并显示
                // 原因：【模型只负责返回false，true，由控制器负责获取错误信息并显示】
                $this->error = $upload->getError();
                return FALSE;
            }else{
                // 获取原图上名称
                $logo = $info['logo']['savepath'] . $info['logo']['savename'];
                // 拼出缩略图的名称
                $midlogo = $info['logo']['savepath'] . 'mid_' . $info['logo']['savename'];
                $smlogo = $info['logo']['savepath'] . 'sm_' . $info['logo']['savename'];
                /************* 生成两张缩略图 **************/
                $image = new \Think\Image(); // 生成图片处理类的对象
                $image->open('./Public/Uploads/' . $logo); // 打开刚刚上传的原图
                // 第三个参数：缩略图的方法 1：按比例缩放，共六个参数
                $image->thumb(650, 650, 1)->save('./Public/Uploads/' . $midlogo); // 生成中图
                $image->thumb(130, 130, 1)->save('./Public/Uploads/' . $smlogo); // 生成小图
                // 把图片路径放到表单中
                $data['logo'] = $logo;
                $data['mid_logo'] = $midlogo;
                $data['sm_logo'] = $smlogo;
                /************ 删除原来的图片 ***********/
                $logo = $this->field('logo,sm_logo,mid_logo')->find($option['where']['id']);
                unlink('./Public/Uploads/'.$logo['logo']);
                unlink('./Public/Uploads/'.$logo['sm_logo']);
                unlink('./Public/Uploads/'.$logo['mid_logo']);
            }
        }
        // 用我们自己过滤的原始数据，覆盖掉表单中TP使用I函数过滤的
        $data['goods_desc'] = removeXSS($_POST['goods_desc']);
    }
}