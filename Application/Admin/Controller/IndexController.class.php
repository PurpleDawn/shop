<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        // View/Index/index.html
        $this->display();
    }
    public function top(){
        // View/Index/top.html
        $this->display();
    }
    public function menu(){
        // View/Index/menu.html
        $this->display();
    }
    public function main(){
        // View/Index/main.html
        $this->display();
    }
}