<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('fournet/msg/')?>">短信通知</a></li>
</ul>
<script type="text/javascript">
	<?php  if($notify['mail']['smtp']['type'] == 'custom') { ?>
		$("#smtp").show();
	<?php  } ?>
</script>
<div class="main">
	<form id="payform" action="<?php  echo url('fournet/msg')?>" method="post" class="form-horizontal form">
	
		<div class="panel panel-default">
			<div class="panel-heading">
				短信通知选项
			</div>
            <div class="panel-body">
				<div class="form-group" id="account">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">使用的短信平台</label>
					<div class="col-sm-9 col-xs-12">
						<select name="pingtai" class="form-control">
							<option value="阿里大鱼" <?php  if($msg['pingtai']==阿里大鱼) { ?>selected<?php  } ?>>阿里大鱼</option>
						</select>
					 <div class="help-block">目前只支持阿里大鱼，推荐使用，要便宜，智能些</div>
					</div>
				</div>
				<div class="form-group" id="account">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">阿里大于版本</label>
					<div class="col-sm-9 col-xs-12">
						<select name="type" class="form-control">
							<option value="1" <?php  if($msg['type']==1) { ?>selected<?php  } ?>>旧版阿里大于</option>
							<option value="2" <?php  if($msg['type']==2) { ?>selected<?php  } ?>>新版阿里大于</option>
						</select>
					 <div class="help-block">目前只支持阿里大鱼，推荐使用，要便宜，智能些</div>
					</div>
				</div>
                    <div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信Appkey</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="appkey" class="form-control" value="<?php  echo $msg['appkey'];?>" />
                            <div class="help-block">此项填写Appkey；如果是新版阿里大于，此处填写accessKeyId。</div>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信secret</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" name="secret" class="form-control" value="<?php  echo $msg['secret'];?>" />
							<div class="help-block">此项填写Appsecret；如果是新版阿里大于，此处填写accessKeySecret。</div>
						</div>
					</div>
                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信签名</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="qianming" class="form-control" value="<?php  echo $msg['qianming'];?>" />
						<div class="help-block">用于发送短信的签名，例如：微信科技</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信模板ID</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="sms_id" class="form-control" value="<?php  echo $msg['sms_id'];?>" />
						<div class="help-block">请在"阿里大鱼"设置模板，例如SMS_9626548.可设置变量${name}姓名,${phone}电话</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">测试短信发送</label>
					<div class="col-sm-9 col-xs-12">
						<label for="radio_7" class="checkbox-inline">
							<input type="checkbox" name="testsend" id="radio_7" value="1" checked onclick="$(':text[name=mobile]').toggle();" /> 保存后测试短信
						</label>
						<input type="text" name="mobile" class="form-control" />
						<div class="help-block">你可以指定一个收件电话, 系统将在保存参数成功后尝试发送一条测试性的短信, 来检测短信通知是否正常工作。注意，短信模版应当包含code变量。</div>
					</div>
				</div>
                
				</div>
			</div>
		<div class="form-group col-sm-12">
			<button type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交">提交</button>
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>

	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
