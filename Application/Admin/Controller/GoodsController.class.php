<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller{
    // 显示表单和处理表单 if(IS_POST)中的代码是处理表单的
    public function add(){
        if (IS_POST){
            /************* 处理表单 **************/
            // 1.生成模板
            $model = D('Goods');
            // 2.接受表单，过滤表单，验证表单
            if($model->create(I('post.'), 1)){
                // 3.添加到数据库中
                if($model->add()){
                    // 4.显示笑脸，和成功的信息并在一秒之后跳转到当前控制器中的lst方法【商品列表页】
                    $this->success('添加成功', U('lst'));
                    // 5.success方法不会马上跳转，会继承执行后面的代码，我们这里要终止后面的代码
                    exit;
                }
            }
            // 如果失败，获取失败原因
            $error = $model->getError();
            // 显示苦脸和错误信息，3秒之后返回上一页面
            $this->error($error);
        }
        // 取出所有商品分类
        $catModel = D('Category');
        $catData = $catModel->getTree();
        $this->assign(array(
            'catData' => $catData,
        ));
        // 设置页面的信息
        $this->assign(array(
            '_page_title' => '添加商品',
            '_page_btn_name' => '商品列表',
            '_page_btn_link' => 'lst',
        ));
        // 显示表单
        $this->display();
    }
    // 简单的展示数据
    public function lst(){
        $model = D('Goods');
        $data = $model->search(5);

        // 取出所有的商品分类
        $catModel = D('Category');
        $catData = $catModel->getTree();
        // 把数据传到页面
        $this->assign(array(
            'catData' => $catData,
            'data' => $data['data'],
            'page' => $data['page'],
        ));
        // 设置页面的信息
        $this->assign(array(
            '_page_title' => '商品列表',
            '_page_btn_name' => '添加商品',
            '_page_btn_link' => 'add',
        ));
        $this->display();
    }
    // 商品的删除
    public function delete(){
        // 接收要删除的商品的ID
        $id = I('get.id');
        $model = D('Goods');
        if (FALSE !== $model->delete($id)){
            $this->success('删除成功！');
            exit;
        }else{
            $this->error('操作失败，请重试！');
        }
    }
    // 商品的修改
    public function edit(){
        // 接收要修改的商品的ID
        $id = I('get.id');
        $model = D('Goods');
        if (IS_POST){
            if ($model->create(I('post.'), 2)){
                // save返回值：如果失败返回false 如果成功返回影响的条数mysql_affected_rows(),有可能返回0【修改前后数据没有变化】
                if (FALSE !== $model->save()){
                    $this->success('修改成功！', U('lst'));
                    exit;
                }
            }
            $error = $model->getError();
            $this->error($error);
        }
        // 先取出要修改的商品的详细信息
        $info = $model->find($id);
        // 取出所有的商品分类
        $catModel = D('Category');
        $catData = $catModel->getTree();
        // 取出这件商品所在分类
        $gcModel = D('GoodsCat');
        $catId = $gcModel->field('cat_id')->where(array(
            'goods_id' => array('eq', $id),
        ))->select();

        $this->assign(array(
            'catId' => $catId,
            'catData' => $catData,
            'info' => $info,
        ));
        // 设置页面的信息
        $this->assign(array(
            '_page_title' => '修改商品',
            '_page_btn_name' => '商品列表',
            '_page_btn_link' => 'lst',
        ));
        $this->display();
    }
}