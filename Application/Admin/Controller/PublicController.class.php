<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/9
 * Time: 21:15
 */
namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller
{
    /*
     * 登录方法
     */
    public function login()
    {
        $this->display();
    }


    /*
     * 生成验证码
     */
    public function verify()
    {
        //配置相关参数
        $config = array(
            'fontSize' => 15,         //验证码字体大小
            'length' => 4,            //验证码位数
            'useNoise' => false,      //关闭验证码杂点
            'imageW' => 108,          //图片宽度
            'codeSet' => '0123456789' //随机产生0-9中的数字
        );
        //实例化类，并调用生成验证码的方法
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    /*
     * 检验登录信息
     */
    public function checkLogin(){
        /*
         * 检测验证码是否正确
         */
        $code       = I('code');        //接收验证码
        $verify     =$this->checkCode($code);   //调用checkCode方法
     /*   if($verify){
            echo "验证码正确";
        }else{
            echo "验证码错误";
        }*/
     if(!$verify){
         $res['status'] = 0;
         $res['message'] ='验证码错误';
         $this->ajaxReturn($res);
     }
        /*
         * 检测用户名密码是否正确
         */

        $username=I("username"," ","trim");     //接收用户名，并且使用trim函数去除首尾空格
        $password=I("password"," ","md5");      //接收密码，并且使用md5函数加密
        $return =$this->checkPassword($username,$password);
    /*    if($return){
            echo "<br>";
            echo "登录成功";
        }else{
            echo "<br>";
            echo "账号密码不匹配";
        }*/
    if(!$return){
        $res['status'] = 0;
        $res['message'] = '用户名或者密码错误';
        $this->ajaxReturn($res);
    }else{
        $data=array(
            "loginip"=>get_client_ip(),     //获取IP地址
            "logintime"=>date("Y-m-d H:i:s"),   //记录登录日期
        );
        M("admin")->save($data);             //增加数据
        session('admin_id',$return["id"]);    //将admin_id存入session
        session('admin_username',$return["username"]);  //将admin_username存入session
        $res['status'] = 1;
        $res['message'] ='登录成功';
        $this->ajaxReturn($res);
    }
    }

    /*
     * 检测用户输入验证码是否正确
     * @param $code:输入的验证码
     * @return bool ：验证码正确返回true，否则返回false
     */
    public function checkCode($code){
        $verify =new \Think\Verify();       //实例化verify类
        return $verify->check($code);       //调用检验方法

    }
    /*
     * 检验用户名密码是否匹配
     * @param $username
     * @param $password
     * @return bool
     */
    public function checkPassword($username,$password){
        $map['username']=$username;
        $admin=M('admin')->where($map)->find();
        if($admin['password']===$password){
            return $admin;
        }else{
            return false;
        }
    }
    public function logout(){
        session('admin_id',null);       //销毁session
        session('admin_username',null); //销毁session
        $this->redirect("login");
    }
}