<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27
 * Time: 22:44
 */
namespace  Admin\Controller; //命名空间
use Think\Controller;
class TestController extends Controller{
    public function test1(){
        echo "我是Test 控制器下的test1方法";
        $test=M('admin')->select();
        print_r($test);
        die;
        $title='这是一个表单';                //给变量赋值
        $this->assign('title',$title);//输出变量
        $this->display();                   //渲染模板
    }
    public function test2(){
        echo "我是Test 控制器下的test2方法";
    }

}