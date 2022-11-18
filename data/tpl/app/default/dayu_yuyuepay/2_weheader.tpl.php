<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn" data-name="<?php  echo $_W['account']['name'];?>" data-qqkey="<?php  echo $qqkey;?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php  if(!empty($title)) { ?><?php  echo $title;?><?php  } else { ?><?php  echo $_W['account']['name'];?><?php  } ?></title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="<?php  echo $_W['page']['keywords'];?>" />
	<meta name="description" content="<?php  echo $_W['page']['description'];?>" />
	<link rel="shortcut icon" href="<?php  echo $_W['siteroot'];?><?php  echo $_W['config']['upload']['attachdir'];?>/<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>images/global/wechat.jpg<?php  } ?>" />
	<link href="<?php  echo $_W['siteroot'];?>app/<?php  echo str_replace('./', '', url('utility/style'))?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo TEMPLATE_WEUI;?>style/weui.min.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_WEUI;?>style/weui.css"/>
	<link rel="stylesheet" href="<?php echo TEMPLATE_WEUI;?>style/dayu.css"/>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('icon', TEMPLATE_INCLUDEPATH)) : (include template('icon', TEMPLATE_INCLUDEPATH));?>
	<?php  if($jquery==1) { ?>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/js/lib/jquery-1.11.1.min.js?v=20160906"></script>
	<?php  } else if($jquery==2) { ?>
	<?php  } else if($jquery==3) { ?>
	<script src="//libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<?php  } ?>
	<script src="<?php echo TEMPLATE_WEUI;?>jquery-weui.min.js"></script>
    <script type="text/javascript" src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	<?php  define('HEADER', true);?>
	window.sysinfo = {
<?php  if(!empty($_W['uniacid'])) { ?>
		'uniacid': '<?php  echo $_W['uniacid'];?>',
<?php  } ?>
<?php  if(!empty($_W['acid'])) { ?>
		'acid': '<?php  echo $_W['acid'];?>',
<?php  } ?>
<?php  if(!empty($_W['openid'])) { ?>
		'openid': '<?php  echo $_W['openid'];?>',
<?php  } ?>
<?php  if(!empty($_W['uid'])) { ?>
		'uid': '<?php  echo $_W['uid'];?>',
<?php  } ?>
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
<?php  if(defined('MODULE_URL')) { ?>
		'MODULE_URL': '<?php echo MODULE_URL;?>',
<?php  } ?>
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'}
	};
	
	// jssdk config 对象
	jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || {};
	
	// 是否启用调试
	jssdkconfig.debug = false;
	
	jssdkconfig.jsApiList = [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'hideMenuItems',
		'showMenuItems',
		'hideAllNonBaseMenuItem',
		'showAllNonBaseMenuItem',
		'translateVoice',
		'startRecord',
		'stopRecord',
		'onRecordEnd',
		'playVoice',
		'pauseVoice',
		'stopVoice',
		'uploadVoice',
		'downloadVoice',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getNetworkType',
		'openLocation',
		'getLocation',
		'hideOptionMenu',
		'showOptionMenu',
		'closeWindow',
		'scanQRCode',
		'chooseWXPay',
		'openProductSpecificView',
		'addCard',
		'chooseCard',
		'openCard'
	];
	
	</script>
<script type="text/javascript">
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	</script>
</head>
<body id="message" ontouchstart>
<div class="weui_tab">