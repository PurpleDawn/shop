<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller{
    // 显示表单和处理表单 if(IS_POST)中的代码是处理表单的
    public function add(){
        // 1.生成对象
        $model = D('Category');
        if (IS_POST){
            /************* 处理表单 **************/
            // 2.接受表单，过滤表单，验证表单
            if($model->create(I('post.'), 1)){
                // 3.添加到数据库中
                if($model->add()){
                    // 4.显示笑脸，和成功的信息并在一秒之后跳转到当前控制器中的lst方法【商品列表页】
                    $this->success('添加成功', U('lst'));
                    // 5.success方法不会马上跳转，会继承执行后面的代码，我们这里要终止后面的代码
                    exit;
                }
                // 如果失败，获取失败原因
                $error = $model->getError();
                // 显示苦脸和错误信息，3秒之后返回上一页面
                $this->error($error);
            }
        }
        // 取出所有分类
        $data = $model->getTree();
        $this->assign('data', $data);
        // 显示表单
        $this->display();
    }
    // 简单的展示数据
    public function lst(){
        $model = D('Category');
        $data = $model->getTree();
        // 把数据传到页面
        $this->assign('data', $data);
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die;
        $this->display();
    }
    // 商品的删除
    public function delete(){
        // 接收要删除的商品的ID
        $id = I('get.id');
        $model = D('Category');
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
        $model = D('Category');
        if (IS_POST){
            if ($model->create(I('post.'), 2)){
                if (FALSE !== $model->save()){
                    $this->success('修改成功！', U('lst'));
                    exit;
                }
            }
            $error = $model->getError();
            $this->error($error);
        }
        $info = $model->find($id);
        
        // 先取出所有分类
        $data = $model->getTree();
        // 再取出当前分类的子分类，为了不显示子分类所以先取出子分类
        $children = $model->getChildren($id);

        $this->assign(array(
            'info' => $info,
            'data' => $data,
            'children' => $children,
        ));
        $this->display();
    }
}