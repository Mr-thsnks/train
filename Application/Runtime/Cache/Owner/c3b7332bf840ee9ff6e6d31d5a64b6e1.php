<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>培训管家管理系统</title>
<link href="/Public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/Public/css/css.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="top">
  <div class="same"> <a href="#"><img src="/Public/images/logo.png"></a> </div>
</div>
<div class="cont">
  <form method="post" action="<?php echo U('/Login');?>">
    <div class="same">
      <div class="logo">
        <h2>培训管家管理系统</h2>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="用户名" name="user"/>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="密码" name="passwd"/>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-warning" value="登录"/>
        </div>
        <p>
          <label>
            <input type="checkbox"/>
            <em>记住账号</em></label>
          <!-- <a href="/Login/xx">忘记密码?</a>  -->
        </p>
          <!-- <a href="/Login/register">注册账号&nbsp;&nbsp;</a> -->
      </div>
    </div>
  </form>
</div>
</body>
</html>