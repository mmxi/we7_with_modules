<?php defined('IN_IA') or exit('Access Denied');?><?php  if(empty($footer_off)) { ?>
	<div class="tab-bottom">
	<div class="weui_tabbar" style="z-index:100">
		<a href="<?php  echo $index_url;?>" class="weui_tabbar_item <?php  if(in_array($_GPC['do'], array('list'), TRUE)) { ?>weui_bar_item_on<?php  } ?>">
			<div class="weui_tabbar_icon">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-yunying"></use>
				</svg>
			</div>
			<p class="weui_tabbar_label">首页</p>
		</a>
		<a href="<?php  echo $this->createMobileUrl('members')?>" class="weui_tabbar_item <?php  if(in_array($_GPC['do'], array('members'), TRUE)) { ?>weui_bar_item_on<?php  } ?>">
			<div class="weui_tabbar_icon">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-kehu"></use>
				</svg>
			</div>
			<p class="weui_tabbar_label">我的</p>
		</a>
	<?php  if(in_array($_GPC['do'], array("manage_detail","manage"), TRUE)) { ?>
		<a href="<?php  echo $this->createMobileUrl('manage', array('id' => $reid, 'sid' => $sid))?>" class="weui_tabbar_item <?php  if(in_array($_GPC['do'], array('manage_detail'), TRUE)) { ?>weui_bar_item_on<?php  } ?>">
			<div class="weui_tabbar_icon">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-shenpi"></use>
				</svg>
			</div>
			<p class="weui_tabbar_label">管理订单</p>
		</a>       
	<?php  } ?>
	<?php  if($isstaff) { ?>
		<a href="<?php  echo $manage_url;?>" class="weui_tabbar_item <?php  if(in_array($_GPC['do'], array('manager'), TRUE)) { ?>weui_bar_item_on<?php  } ?>">
			<div class="weui_tabbar_icon">
				<svg class="icon" aria-hidden="true">
					<use xlink:href="#icon-bumen"></use>
				</svg>
			</div>
			<p class="weui_tabbar_label">管理中心</p>
		</a>
	<?php  } ?>
	</div>
	</div>
<?php  } ?>
</div>
<?php
	$_share['title'] = !empty($_share['title']) ? $_share['title'] : $_W['account']['name'];
	$_share['imgUrl'] = !empty($_share['imgUrl']) ? $_share['imgUrl'] : '';
	if(isset($_share['content'])){
		$_share['desc'] = $_share['content'];
		unset($_share['content']);
	}
	$_share['desc'] = !empty($_share['desc']) ? $_share['desc'] : '';
	$_share['desc'] = preg_replace('/\s/i', '', str_replace('	', '', cutstr(str_replace('&nbsp;', '', ihtmlspecialchars(strip_tags($_share['desc']))), 60)));
	if(empty($_share['link'])) {
		$_share['link'] = '';
		$query_string = $_SERVER['QUERY_STRING'];
		if(!empty($query_string)) {
			parse_str($query_string, $query_arr);
			$query_arr['u'] = $_W['member']['uid'];
			$query_string = http_build_query($query_arr);
			$_share['link'] = $_W['siteroot'].'app/index.php?'. $query_string;
		}
	}
?>
<script type="text/javascript">
$(function(){
	wx.config(jssdkconfig);
	<?php  if($share==1) { ?>
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		wx.hideOptionMenu();
	});
	<?php  } else { ?>
	wx.showOptionMenu();
	var $_share = <?php  echo json_encode($_share);?>;	
	if(typeof sharedata == 'undefined'){
		sharedata = $_share;
	} else {
		sharedata['title'] = sharedata['title'] || $_share['title'];
		sharedata['desc'] = sharedata['desc'] || $_share['desc'];
		sharedata['link'] = sharedata['link'] || $_share['link'];
		sharedata['imgUrl'] = sharedata['imgUrl'] || $_share['imgUrl'];
	}
	
	if(sharedata.imgUrl == ''){
		var _share_img = $('body img:eq(0)').attr("src");
		if(_share_img == ""){
			sharedata['imgUrl'] = window.sysinfo.attachurl + 'images/global/wechat_share.png';
		} else {
			sharedata['imgUrl'] = tomedia(_share_img);
		}
	}
	wx.ready(function () {
		wx.onMenuShareAppMessage(sharedata);
		wx.onMenuShareTimeline(sharedata);
		wx.onMenuShareQQ(sharedata);
		wx.onMenuShareWeibo(sharedata);
	});
	
	<?php  if($controller == 'site' && $action == 'site') { ?>
		$('#category_show').click(function(){
			$('.head .order').toggleClass('hide');
			return false;
		});
		//文章点击和分享加积分
		<?php  if(!empty($_GPC['u'])) { ?>
			var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'click', 'u' => $_GPC['u']), true);?>";
			$.post(url, function(dat){});
		<?php  } ?>
		sharedata.success = function(){
			var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'share'));?>";
			$.post(url, function(dat){});
		}
	<?php  } ?>
	<?php  } ?>
});

	function tomedia(src) {
		if(typeof src != 'string')
			return '';
		if(src.indexOf('http://') == 0 || src.indexOf('https://') == 0) {
			return src;
		} else if(src.indexOf('../addons') == 0 || src.indexOf('../attachment') == 0) {
			src=src.substr(3);
			return window.sysinfo.siteroot + src;
		} else if(src.indexOf('./resource') == 0) {
			src=src.substr(2);
			return window.sysinfo.siteroot + 'app/' + src;
		} else if(src.indexOf('images/') == 0) {
			return window.sysinfo.attachurl+ src;
		}
	}
</script>
</body>
</html>