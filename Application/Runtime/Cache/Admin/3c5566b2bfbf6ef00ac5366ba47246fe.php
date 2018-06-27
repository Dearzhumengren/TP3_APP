<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>明日科技导航 - 登录</title>
    <!-- 引入外部css样式-->
    <link rel="stylesheet" href="/APP/Public/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/APP/Public/font-awesome/css/font-awesome.css" >
    <link rel="stylesheet" href="/APP/Public/css/animate.css" >
    <link rel="stylesheet" href="/APP/Public/css/admin-style.css" >
    <!--  引入外部jQuery插件-->
    <script src="/APP/Public/js/jquery-2.1.1.min.js"></script>
    <!-- 引入外部layer弹层插件-->
    <script src="/APP/Public/static/layer/layer.js"></script>
    <!--<script>-->
        <!--layer.msg('内容',{icon:1,time:2000},function () { //2秒关闭(如果不配置，默认是3秒)-->
            <!--//do something-->
        <!--})-->
    <!--</script>-->
</head>
<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">MR</h1>
        </div>
        <h3>欢迎使用hao365网址之家后台</h3>
        <form id="form" name="form" method="post" action="<?php echo U('checkLogin');?>" autocomplete="off">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="用户名">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="密码">
            </div>

            <!--生成验证码开始-->
            <div class="form-group login">
                <span>验证码</span>
                <input name="code" style="width: 110px" type="text" id="code"/>
                <a>
                    <img class=" reloadverify " src="<?php echo U('Admin/Public/verify');?>"
                         id="imgcode" onclick="this.src=this.src+'?'+Math.random()"/>
                </a>
            </div>

            <!--生成验证码结束-->
            <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
        </form>
    </div>

</div>
<!--Ajax异步提交开始-->
<script>
    $('form').submit(function () {
        //获取用户名
        var username =$("input[name='username']").val();
        //获取密码
        var password =$("input[name='password']").val();
        //获取验证码
        var code =$("#code").val();
        //判断用户名、密码、验证码是否为空
        if(!username){
            layer.msg('用户名不能为空！',{time:2000});
            return false;
        }
        if(!password){
            layer.msg('密码不能为空！',{time:2000});
            return false;

        }
        if(!code){
            layer.msg('验证码不能为空！',{time:2000});
            return false;
        }
        //获取跳转路径也就是action的值。
        var url=$(this).attr('action');
        $.ajax({
            type:"post",//post请求
            url:url,    //发送请求的地址，这里是checkLogin方法
            data:{username:username,password:password,code:code},   //传递的参数
            success:function(res){      //回调函数，res参数是从checkLogin方法返回的值
                if(res.status){
                    layer.msg(res.message,{time:1000},function(){
                        window.location.href="<?php echo U('Index/index');?>";//跳转到Admin/Index/index
                    });
                }else{
                    //刷新验证码
                    $(".reloadverify").click();
                    layer.msg(res.message,{time:2000});//2秒后弹出提示信息
                }

            }
        });
        return false;

    })
</script>

<!--ajax异步提交结束-->
</body>
</html>