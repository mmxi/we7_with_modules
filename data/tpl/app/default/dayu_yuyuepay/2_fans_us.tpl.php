<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('weheader', TEMPLATE_INCLUDEPATH)) : (include template('weheader', TEMPLATE_INCLUDEPATH));?>
<div class="weui_btn_primary weui-header "> 
	<h1 class="weui-header-title">关注<?php  echo $_W['uniaccount']['name'];?></h1>
</div> 
<div class="weui-weixin">
	<div class="weui-weixin-ui">
		<div class="weui-weixin-page">
			<div class="weui-weixin-img center ui-page-meta-img">
				<img src="<?php  echo $qrcodesrc;?>" class="img-max center" style="width:80%;">
			</div>
			<div class="weui-weixin-content tcenter">
				<p>（长按二维码，选择“<font color="red">识别二维码</font>”关注）</p>
				<p><?php  echo $message;?></p>
			</div>
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footers', TEMPLATE_INCLUDEPATH)) : (include template('footers', TEMPLATE_INCLUDEPATH));?>