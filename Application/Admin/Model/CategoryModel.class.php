<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
    // 添加时调用create方法允许接收的字段
    protected $insertFields = 'cat_name,parent_id';
    // 修改时调用create方法允许接收的字段
    protected $updateFields = 'id,cat_name,parent_id';
    // 定义表单验证规则
    // 第四个参数：什么情况验证：0：字段存在时候验证【默认】 1：必须验证 2：字段存在且值不为空时候验证
    protected $_validate = array(
        array('cat_name', 'require', '分类名称不能为空', 1),
        array('parent_id', 'require', '父级id不能为空', 1)
    );

    // 无限级树形的结构
    public function getTree(){
        $data = $this->select();
        $data = $this->_reSort($data);
        return $data;
    }
    
    // 递归排序方法
    private function _reSort($data, $parent_id=0, $level=0){
        static $_ret = array();
        foreach($data as $k => $v){
            if ($v['parent_id'] == $parent_id){
                $v['level'] = $level;
                $_ret[] = $v;
                // 再找这个分类的子分类
                $this->_reSort($data, $v['id'], $level+1);
            }
        }
        return $_ret;
    }

    // 获取一个分类所有子分类的ID
    public function getChildren($catId){
        $data = $this->select();
        return $this->_getChildren($data, $catId, true);
    }
    private function _getChildren($data, $catId, $isClear){
        static $_ret = array();
        if ($isClear){
            $_ret = array();
        }
        foreach($data as $k => $v){
            if($v['parent_id'] == $catId){
                $_ret[] = $v['id'];
                $this->_getChildren($data, $v['id'], false);
            }
        }
        return $_ret;
    }

    protected function _before_delete($option){
        // 先取子分类的ID
        $children = $this->getChildren($option['where']['id']);

        // 注意:_before_delete方法中不能再调用delete方法了,不然就是死循环
//        $this->where(array(
//            'id' => array('in', $children),
//        ))->delete();

        if($children){
            $children = implode(',', $children);
            $this->execute("DELETE FROM shop_category WHERE id IN($children)");
        }
    }
}