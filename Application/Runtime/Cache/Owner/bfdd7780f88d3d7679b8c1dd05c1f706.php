<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html style "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>培训管家管理系统</title>
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/common.css" rel="stylesheet" type="text/css" />
    <link href="/Public/css/css.css" rel="stylesheet" type="text/css" />
    <script src="/Public/js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="/Public/js/common.js" type="text/javascript"></script>
    <script src="/Public/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/Public/js/left.js" type="text/javascript"></script>
    <script src="/Public/js/js.js" type="text/javascript"></script>
</head>

<body>
    <div class="head"> 您好，欢迎登录培训管家管理系统
        <!-- <p> <a href="#">帮助</a> <em>|</em> <a href="#">反馈</a> </p> -->
    </div>
    <div class="header">
        <div class="logo2 fl">
            <a href="<?php echo U('Index/index');?>">
                <img src="/Public/images/logo2.png">
            </a>
        </div>

        <div class="search2 fl">
            <input type="text" class="text" value="请输入关键字" />
            <input type="button" class="btns" />
        </div>

        <div class="search2 fl">
            <span style="color:red;font-size:20px;">
                校区：<?php echo (session('fenxiaoname')); ?>
            </span>
        </div>

        <div class="navi fr">
            <ul>
                <li class="back1"><a href="#"> </a>
                </li>
                <li class="back2"><a href="#"> </a>
                </li>
                <li class="back3">
                    <ul style="width:180px;">
                        <li>
                            <a >您好，<?php echo (findMember(session('UID'),'name')); ?></a>
                        </li>
                        <li>
                            <a >角色：<?php echo (findAuth(session('UID'))); ?></a>
                        </li>
                        <li>
                            <a href="?m=Admin&c=index&a=grmimag&id=<?php echo (session('userid')); ?>" target="main">重设新密码</a>
                        </li>
                        <li>
                            <a href="?c=Login&a=gout">退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="content" id="cont">
        <aside id="frmTitle" class="said fl">
            <?php switch(CONTROLLER_NAME): case "Index": ?><ul class="ula">
    <li><a href="<?php echo U('Index/bwlmain');?>" target="main">备忘录</a>
    </li>
    <li class="bg">
        <a href="<?php echo U('Index/index');?>" target="main">系统通知</a>
        <span class="badge"><?php echo (session('rids')); ?></span>
    </li>
</ul>
<div class="ulb">
    <ul class="listUl">    
        <li>
            <h3>分校设置</h3>
            <ul>
                <li> 
                    <a href="<?php echo U('/Branch/create', array('table'=>'campus'));?>">创建分校校区</a>
                </li>
                <li> 
                    <a href="<?php echo U('/Branch/create', array('table'=>'user'));?>">创建分校帐号</a> 
                </li>
            </ul>
        </li>
        <li>
            <h3>查看分校</h3>
            <ul>
                <?php if(is_array($leftBranch)): foreach($leftBranch as $key=>$val): ?><li>
                        <a href="<?php echo U('/branch/view', array('table'=>'main', 'bid'=>$val['id']));?>"><?php echo ($val["organizat"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </li>
    </ul>
</div><?php break;?>
                <?php case "Branch": if($_GET['bid']> 0): ?><ul class="ula">
    <li><a href="<?php echo U('Index/bwlmain');?>" target="main">备忘录</a>
    </li>
    <li class="bg">
        <a href="<?php echo U('Index/index');?>" target="main">系统通知</a>
        <span class="badge"><?php echo (session('rids')); ?></span>
    </li>
</ul>
<div class="ulb">
    <ul class="listUl">    
        <li>
            <h3>基础设置</h3>
            <ul>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'dict', 'bid'=>I('bid')));?>">字典设置</a>
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'disc', 'bid'=>I('bid')));?>">优惠管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'subject', 'bid'=>I('bid')));?>">科目管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'priced', 'bid'=>I('bid')));?>">定价管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'expire', 'bid'=>I('bid')));?>">到期设置</a> 
                </li>
            </ul>
        </li>
        <li>
            <h3>系统管理</h3>
            <ul>
                <li>
                    <a href="<?php echo U('/Setting/auth', array('table'=>'auth', 'bid'=>I('bid')));?>">角色认证</a>
                </li>
                <li>
                    <a href="<?php echo U('/Setting/user', I('get.'));?>">帐号</a>
                </li>
            </ul>
        </li>
        <!-- <li>
            <h3>数据配分</h3>
            <ul>
                <?php if(is_array($leftBranch)): foreach($leftBranch as $key=>$val): ?><li>
                        <a href="<?php echo U('/branch/view', array('bid'=>$val['id']));?>"><?php echo ($val["organizat"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </li> -->
    </ul>
</div><?php else: ?><ul class="ula">
    <li><a href="<?php echo U('Index/bwlmain');?>" target="main">备忘录</a>
    </li>
    <li class="bg">
        <a href="<?php echo U('Index/index');?>" target="main">系统通知</a>
        <span class="badge"><?php echo (session('rids')); ?></span>
    </li>
</ul>
<div class="ulb">
    <ul class="listUl">    
        <li>
            <h3>分校设置</h3>
            <ul>
                <li> 
                    <a href="<?php echo U('/Branch/create', array('table'=>'campus'));?>">创建分校校区</a>
                </li>
                <li> 
                    <a href="<?php echo U('/Branch/create', array('table'=>'user'));?>">创建分校帐号</a> 
                </li>
            </ul>
        </li>
        <li>
            <h3>查看分校</h3>
            <ul>
                <?php if(is_array($leftBranch)): foreach($leftBranch as $key=>$val): ?><li>
                        <a href="<?php echo U('/branch/view', array('table'=>'main', 'bid'=>$val['id']));?>"><?php echo ($val["organizat"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </li>
    </ul>
</div><?php endif; break;?>
                <?php case "Marketing": ?><ul class="ula">
    <li><a href="<?php echo U('Index/bwlmain');?>" target="main">备忘录</a>
    </li>
    <li class="bg">
        <a href="<?php echo U('Index/index');?>" target="main">系统通知</a>
        <span class="badge"><?php echo (session('rids')); ?></span>
    </li>
</ul>
<div class="ulb">
    <ul class="listUl">    
        <li>
            <h3>市场管理</h3>
            <ul>
                <li> 
                    <a href="<?php echo U('/marketing/view', array('table'=>'event', 'bid'=>I('bid')));?>">市场活动</a>
                </li>
                <li> 
                    <a href="<?php echo U('/marketing/view', array('table'=>'collect', 'bid'=>I('bid')));?>">采单表</a> 
                </li>
            </ul>
        </li>
    </ul>
</div><?php break;?>
                <?php case "Setting": ?><ul class="ula">
    <li><a href="<?php echo U('Index/bwlmain');?>" target="main">备忘录</a>
    </li>
    <li class="bg">
        <a href="<?php echo U('Index/index');?>" target="main">系统通知</a>
        <span class="badge"><?php echo (session('rids')); ?></span>
    </li>
</ul>
<div class="ulb">
    <ul class="listUl">    
        <li>
            <h3>基础设置</h3>
            <ul>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'dict', 'bid'=>I('bid')));?>">字典设置</a>
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'disc', 'bid'=>I('bid')));?>">优惠管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'subject', 'bid'=>I('bid')));?>">科目管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'priced', 'bid'=>I('bid')));?>">定价管理</a> 
                </li>
                <li> 
                    <a href="<?php echo U('/Setting/view', array('table'=>'expire', 'bid'=>I('bid')));?>">到期设置</a> 
                </li>
            </ul>
        </li>
        <li>
            <h3>系统管理</h3>
            <ul>
                <li>
                    <a href="<?php echo U('/Setting/auth', array('table'=>'auth', 'bid'=>I('bid')));?>">角色认证</a>
                </li>
                <li>
                    <a href="<?php echo U('/Setting/user', I('get.'));?>">帐号</a>
                </li>
            </ul>
        </li>
        <!-- <li>
            <h3>数据配分</h3>
            <ul>
                <?php if(is_array($leftBranch)): foreach($leftBranch as $key=>$val): ?><li>
                        <a href="<?php echo U('/branch/view', array('bid'=>$val['id']));?>"><?php echo ($val["organizat"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </li> -->
    </ul>
</div><?php break; endswitch;?>
            <!-- <div class="gbc" onclick="toggleNav()"></div> -->
        </aside>
        <div id="main" class="main fr">
            <div class="headdx">
    <ul>
        <li class="btn btn-primary" role="button">
            <a href="<?php echo U('/marketing/view', array('table'=>'event', 'bid'=>I('get.bid')));?>">市场<span class="glyphicon glyphicon-education" aria-hidden="true"></span></a>
        </li>
        <li class="btn btn-success" role="button">
            <a href="#">销售<span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
        </li>
        <li class="btn btn-info" role="button">
            <a href="#">教学教务<span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span></a>
        </li>
        <li class="btn btn-warning" role="button">
            <a href="#">人事<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span></a>
        </li>
        <li class="btn btn-danger" role="button">
            <a href="#">统计<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></a>
        </li>
        <li class="btn btn-default disabled" role="button">
            <a href="#">快速记录<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
        </li>
    </ul>
</div>
            <div>
                <div class="hint"></div>
                <script language="javascript" type="text/javascript" src="/Public/time/WdatePicker.js"></script> 
<form action="<?php echo U('', ['table'=>I('get.table'), 'bid'=>I('get.bid'), 'id'=>I('get.id')]);?>" method="post" class="validatable">
    <table class="table table-bordered center-block">
        <tr style="background-color: #E6E6E6;">
            <td colspan="2"><strong>基本信息</strong></td>
        </tr>
        <tr>
            <td>
                <label for="name">活动名称:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="title" value="<?php echo ($event["title"]); ?>" data-validation-engine="validate[required]">
            </td>
            <td>
                <label for="name">当前状态:</label data-validation-engine="validate[required]">
                <select class="form-control" name="status">
                    <option value="">请选择状态</option>
                    <option value="0">取消</option>
                    <option value="1" selected>进行中</option>
                    <option value="2">已结束</option>
                </select>
            </td>
        </tr>
        <tr style="background-color: #E6E6E6;">
            <td colspan="2"><strong>计划信息</strong></td>
        </tr>
        <tr>
            <td>
                <label for="name">活动地点:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="location" value="<?php echo ($event["location"]); ?>" data-validation-engine="validate[required]">
            </td>
            <td>
                <label for="name">活动类型:</label>
                <select class="form-control" name="type" data-validation-engine="validate[required]">
                    <option style="color:blue;"><?php echo ($event["type"]); ?></option>
                    <?php if(is_array($eventType)): $i = 0; $__LIST__ = $eventType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><option value="<?php echo ($so["name1"]); ?>"><?php echo ($so["name1"]); ?></option>
                        <option value="<?php echo ($so["name2"]); ?>"><?php echo ($so["name2"]); ?></option>
                        <option value="<?php echo ($so["name3"]); ?>"><?php echo ($so["name3"]); ?></option>
                        <option value="<?php echo ($so["name4"]); ?>"><?php echo ($so["name4"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">计划开始时间:</label>
                <input class=" form-control Wdate" type="text" name="time_begin" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo ($event["time_begin"]); ?>" data-validation-engine="validate[required]"  readonly>
            </td>
            <td>
                <label for="name">计划结束时间:</label>
                <input class=" form-control Wdate" type="text" name="time_end" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo ($event["time_end"]); ?>"  data-validation-engine="validate[required]" readonly>
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">预计成本:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="projected_costs" value="<?php echo ($event["projected_costs"]); ?>" data-validation-engine="validate[required, custom[number]]">
            </td>
            <td>
                <label for="name">预计采单量:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="quantity" value="<?php echo ($event["quantity"]); ?>" data-validation-engine="validate[required, custom[number]]">
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">活动负责人:</label>
                <select class="form-control" name="user" data-validation-engine="validate[required]">
                    <option value="">请下拉选择</option>
                    <?php if(is_array($memList)): foreach($memList as $key=>$val): if($val['id'] == $event['user']): ?><option value="<?php echo ($val["id"]); ?>" selected><?php echo ($val["name"]); ?></option>
                        <?php else: ?>
                            <option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
            </td>
            <td>
                <label for="name">执行周期（天）:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="execute_days" value="<?php echo ($event["execute_days"]); ?>" data-validation-engine="validate[required]">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="name">执行次数:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="execute_nums" value="<?php echo ($event["execute_nums"]); ?>" data-validation-engine="validate[required]">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="name">活动时间表:</label>
                <textarea class="form-control" rows="3" name="timetable"><?php echo ($event["timetable"]); ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="name">活动描述:</label>
                <textarea class="form-control" rows="3" name="desc"><?php echo ($event["desc"]); ?></textarea>
            </td>
        </tr>
        <tr style="background-color: #E6E6E6;">
            <td colspan="2"><strong>实际执行信息</strong></td>
        </tr>
        <tr>
            <td>
                <label for="name">实际开始时间:</label>
                <input class=" form-control " type="text" name="time_begin_actual" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo ($eventActual["time_begin_actual"]); ?>" data-validation-engine="validate[required]"  readonly>
            </td>
            <td>
                <label for="name">实际结束时间:</label>
                <input class=" form-control " type="text" name="time_end_actual" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="<?php echo ($eventActual["time_end_actual"]); ?>"  data-validation-engine="validate[required]"  readonly>
            </td>
        </tr>
        <tr>
            <td>
                <label for="name">实际投入:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="amount_actual" value="<?php echo ($eventActual["amount_actual"]); ?>" data-validation-engine="validate[required, custom[number]]">
            </td>
            <td>
                <label for="name">实际采单量:</label>
                <input type="text" class="form-control" id="exampleInputName2" name="quantity_actual" value="<?php echo ($eventActual["quantity_actual"]); ?>" data-validation-engine="validate[required, custom[number]]">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="name">活动总结:</label>
                <textarea class="form-control" rows="3" name="summary_actual"  value=""><?php echo ($eventActual["summary_actual"]); ?></textarea>
            </td>
        </tr>                
        <tr style="background-color: #E6E6E6;">
            <td colspan="2"><strong>操作记录</strong></td>
        </tr>
        <tr>
            <td>创建人 : <?php echo (findMember($eventOperation["create_user"], 'name')); ?></td>
            <td>创建时间 : <?php echo ($eventOperation["create_time"]); ?></td>
        </tr>
        <tr>
            <td>
                更新人 : <?php if(($eventOperation["update_user"]) != "0"): echo (findMember($eventOperation["update_user"], 'name')); else: ?>暂无<?php endif; ?>
            </td>
            <td>
                更新时间 : <?php if(($eventOperation["update_time"]) != "0000-00-00 00:00:00"): echo ($eventOperation["update_time"]); else: ?>暂无<?php endif; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input name="" class="btn btn-danger" style="float:right;margin-right:20px;" type="submit" value="提交" />
                <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);" style="float:right; margin-right:18px;">取消</button>
            </td>
        </tr>
    </table>
</form>
            </div>
        </div>
        <!-- <iframe id="frmTitle" name="left" height="100%" class="said fl" src="<?php echo U('/Index/side');?>" style=" display:block;"> </iframe> -->
        
        <!-- <iframe id="main" name="main" height="100%" class="main fr" src="?m=Admin&c=index&a=jiaoxuezhuguan"> </iframe>    -->
    </div>
</body>

</html>