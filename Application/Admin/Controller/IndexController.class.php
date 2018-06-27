<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $this->redirect('HighLevel/lists');
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    /*
     * 修改密码
     * */
    public function changePassword(){
        //$this->display();
        if(IS_POST){
            $old_password = I('old_password',"",'md5'); //接收原始密码
            $new_password = I('new_password',"",'md5'); //接收新密码
            $map['id'] =session('admin_id');    //通过session获取管理员id
            $admin = M('admin')->where($map)->find();//查找原密码
            if($old_password===$admin['password']){ //检测原始密码是否正确
                $admin = M('admin')->where($map)->setField('password',$new_password);//更换密码
                if($admin !==false){
                    $res['status'] = 1;
                    $res['message'] = '更改成功';
                    $this->ajaxReturn($res);
                }else{
                    $res['status'] = 0;
                    $res['message'] = '更改失败';
                    $this->ajaxReturn($res);
                }
            }else{
                $res['status'] = 0;
                $res['message'] ='更改失败，原始密码错误';
                $this->ajaxReturn($res);
            }
        }else{
            $this->display();
        }
    }
}