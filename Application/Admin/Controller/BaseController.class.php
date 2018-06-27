<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 23:09
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{
    public function _initialize(){              //初始化方法
        $admin_id = session('admin_id');        //获取管理员id
        $admin_username =   session('admin_username');  //获取管理员名称
        //如果获取管理员id和名称有一个不存在，则说明没有登录，跳转至登录页
        if(!isset($admin_id)||!isset($admin_username)){
            $this->redirect("Admin/Public/login");
        }
    }
}