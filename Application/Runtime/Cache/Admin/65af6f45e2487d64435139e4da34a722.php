<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test1页面测试</title>
</head>
<body>
<div><?php echo $title; ?></div>
<div><?php echo ($title); ?></div>
<form action="" method="post">
    <div>
        <input type="text" name="username"/>用户名
    </div>
    <div>
        <input type="password" name="password"/>密码
    </div>
    <div>
        <input type="submit" value="提交"/>
    </div>

</form>

</body>
</html>