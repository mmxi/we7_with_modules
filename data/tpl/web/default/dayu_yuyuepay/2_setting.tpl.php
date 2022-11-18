<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.btn-group .active{background-color:#428bca;color:#fff;}
</style>
<div class="main">

	<?php  if($_W['role'] != 'operator') { ?>
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <div class="panel panel-info">
            <div class="panel-heading">参数设置</div>            <div class="panel-body">                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页(主题列表)标题</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="title" value="<?php  echo $title;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页显示</label>                    <div class="col-xs-12 col-sm-9">                        <label class="radio-inline"><input type="radio" name="list_num" value="1" <?php  if($settings['list_num'] == 1) { ?> checked="checked"<?php  } ?> /> 一行1个主题</label>
                        <label class="radio-inline"><input type="radio" name="list_num" value="3" <?php  if($settings['list_num'] == 3) { ?> checked="checked"<?php  } ?> /> 一行3个主题</label>	         			<label class="radio-inline"><input type="radio" name="list_num" value="4" <?php  if($settings['list_num'] == 4) { ?> checked="checked"<?php  } ?> /> 一行4个主题</label>                    </div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">介绍导航栏背景色</label>
					<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<?php  echo tpl_form_field_color('nav_page', $settings['color']['nav_page']);?>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">首页按钮栏背景色</label>
					<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<?php  echo tpl_form_field_color('nav_btn', $settings['color']['nav_btn']);?>
					</div>
					</div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页标题</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="subject" value="<?php  echo $subject;?>" />
                    </div>                </div>                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">付款后更改为已受理</label>
					<div class="col-xs-12 col-sm-9">
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($settings['paystate'] == 1) { ?>active<?php  } ?>"><input type="radio" name="paystate" value="1" <?php  if($settings['paystate'] == 1) { ?> checked="checked"<?php  } ?> >开启</label>
						<label class="btn btn-default <?php  if($settings['paystate'] == 0) { ?>active<?php  } ?>"><input type="radio" name="paystate" value="0" <?php  if($settings['paystate'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					</div>
					</div>
                </div>
                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">后台操作员分权</label>
					<div class="col-xs-12 col-sm-9">
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($settings['role'] == 1) { ?>active<?php  } ?>"><input type="radio" name="role" value="1" <?php  if($settings['role'] == 1) { ?> checked="checked"<?php  } ?> >开启</label>
						<label class="btn btn-default <?php  if($settings['role'] == 0) { ?>active<?php  } ?>"><input type="radio" name="role" value="0" <?php  if($settings['role'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					</div>
	        			<span class="help-block">开启分权，在设置权限的时候禁止给予新建主题及参数设置、主题列表入口、管理入口等核心功能设置权限</span>
					</div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">充值入口：</label>
					<div class="col-xs-12 col-sm-9">
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($settings['pay'] == 0) { ?>active<?php  } ?>"><input type="radio" name="pay" value="0" <?php  if($settings['pay'] == 0) { ?> checked="checked"<?php  } ?>>系统内置充值</label>
						<?php  if(pdo_tableexists('dayu_card_plugin_deposit')) { ?>
						<label class="btn btn-default <?php  if($settings['pay'] == 1) { ?>active<?php  } ?>"><input type="radio" name="pay" value="1" <?php  if($settings['pay'] == 1) { ?> checked="checked"<?php  } ?>><?php  echo $modules['dayu_card_plugin_deposit']['title'];?></label>
						<?php  } else { ?>
						<label class="btn btn-default <?php  if($settings['pay'] == 1) { ?>active<?php  } ?>" disabled><input type="radio" name="pay" value="1" <?php  if($settings['pay'] == 1) { ?> checked="checked"<?php  } ?>>需要【充值中心】支持，返金额+送券</label>
						<?php  } ?>
					</div>
					</div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">打通微商户插件</label>
                    <div class="col-xs-12 col-sm-9">
					<?php  if(pdo_tableexists('dayu_yuyuepay_plugin_store_store')) { ?>
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($settings['store'] == 1) { ?>active<?php  } ?>"><input type="radio" name="store" value="1" <?php  if($settings['store'] == 1) { ?> checked="checked"<?php  } ?> >开启</label>
						<label class="btn btn-default <?php  if($settings['store'] == 0) { ?>active<?php  } ?>"><input type="radio" name="store" value="0" <?php  if($settings['store'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					</div>
					<?php  } else { ?>
						<span class="btn btn-default" disabled>需要【多城市网点商圈】支持</span>
					<?php  } ?>
                    </div>
                </div>
            </div>        </div>
		<div class="panel panel-info">
            <div class="panel-heading">用户注册相关 <small>以下参数用于确认用户真实信息</small></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信验证</label>
                    <div class="col-xs-12 col-sm-9">
					<?php  if(pdo_tableexists('dayu_sms')) { ?>
						<select name="smsid" class='form-control'>
							<option value="0">不使用短信</option>
							<?php  if(is_array($sms)) { foreach($sms as $s) { ?>
							<option value="<?php  echo $s['id'];?>" <?php  if($s['id'] == $settings['smsid']) { ?>selected="selected"<?php  } ?>><?php  echo $s['title'];?></option>
							<?php  } } ?>
						</select>
					<?php  } else { ?>
						<span class="btn btn-default" disabled>需要【dayu短信】支持</span>
					<?php  } ?>
	        			<span class="help-block">短信验证手机号码的真实性</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">腾讯地图key</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" name="qqkey" value="<?php  echo $settings['qqkey'];?>" />
	        			<span class="help-block">会员资料自动获取地址。<a href="http://lbs.qq.com/" target="_blank">申请腾讯地图key</a> 无key无法自动获取省市区、街道</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">用户注册通知</label>
                    <div class="col-xs-12 col-sm-9">
					<div class="input-group">
                        <input type="text" class="form-control" name="otmpl" value="<?php  echo $settings['otmpl'];?>" />
	        			<span class="input-group-addon">模板消息：IT，互联网：(搜索)注册提醒 - 编号：OPENTM207173353</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">新预约通知</div>
            <div class="panel-body">
                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">非工作时间不接收通知</label>
					<div class="col-xs-12 col-sm-9">
					<div class="input-group">
						 <span class="input-group-addon">上班时间 例：830</span>
                         <input type="text" size="4" style="height:50px" name="stime" value="<?php  echo $settings['stime'];?>" />
						 <span class="input-group-addon">下班时间 例：1820</span>
                         <input type="text" size="4" style="height:50px" name="etime" value="<?php  echo $settings['etime'];?>" />
						 <span class="input-group-addon"><font style="color:#ff0000;">830=8点30分，1820=18点20分。</font>留空则任何时间都接收通知</span>
					</div>
					</div>
                </div>
                <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知客服方式切换</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">					  
					<label class="btn btn-default <?php  if($settings['newtemp'] == 0) { ?>active<?php  } ?>"><input type="radio" name="newtemp" value="0" <?php  if($settings['newtemp'] == 0) { ?> checked="checked"<?php  } ?>>通知所有客服</label>
					<label class="btn btn-default <?php  if($settings['newtemp'] == 1) { ?>active<?php  } ?>"><input type="radio" name="newtemp" value="1" <?php  if($settings['newtemp'] == 1) { ?> checked="checked"<?php  } ?> >只通知管理员</label>
				</div>
				</div>
                </div>
                <div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">模板消息通知方式</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">					  
					<label class="btn btn-default <?php  if($settings['notice'] == 1) { ?>active<?php  } ?>"><input type="radio" name="notice" value="1" <?php  if($settings['notice'] == 1) { ?> checked="checked"<?php  } ?> >仅付款通知</label>
					<label class="btn btn-default <?php  if($settings['notice'] == 0) { ?>active<?php  } ?>"><input type="radio" name="notice" value="0" <?php  if($settings['notice'] == 0) { ?> checked="checked"<?php  } ?>>提交及付款通知</label>
				</div>
				</div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">时间段超时设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约今天</label>
                    <div class="col-xs-12 col-sm-9">
					<div class="input-group">
						<span class="input-group-addon">当前时间加</span>
                        <input type="text" class="form-control" placeholder="" name="today" value="<?php  echo $today;?>" />
						<span class="input-group-addon">分钟不可预约，默认60分钟</span>
					</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">付款超时设置</label>
                    <div class="col-xs-12 col-sm-9">
					<div class="input-group">
						<span class="input-group-addon">提交后</span>
                        <input type="text" class="form-control" placeholder="" name="paytime" value="<?php  echo $paytime;?>" />
						<span class="input-group-addon">分钟内未付款，放开预约名额（时间段）。默认30分钟</span>
					</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>