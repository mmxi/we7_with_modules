<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('commons/header-base', TEMPLATE_INCLUDEPATH)) : (include template('commons/header-base', TEMPLATE_INCLUDEPATH));?>
<?php  if(IMS_VERSION>'1.0.0') { ?>
<div data-skin="default" class="skin-default <?php  if($_GPC['main-lg']) { ?> main-lg-body <?php  } ?>">
<?php  $frames = buildframes(FRAME);_calc_current_frames($frames);?>
<div class="head">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container <?php  if(!empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>plugin-head<?php  } ?>">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php  echo $_W['siteroot'];?>">
					<img src="<?php  if(!empty($_W['setting']['copyright']['blogo'])) { ?><?php  echo tomedia($_W['setting']['copyright']['blogo'])?><?php  } else { ?>./resource/images/logo/logo.png<?php  } ?>" class="pull-left" width="110px" height="35px">
					<span class="version"><?php echo IMS_VERSION;?></span>
				</a>
			</div>
			<?php  if(!empty($_W['uid'])) { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-left">
					<?php  global $top_nav?>
					<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
					<li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  if(empty($nav['url'])) { ?><?php  echo url('home/welcome/' . $nav['name']);?><?php  } else { ?><?php  echo $nav['url'];?><?php  } ?>" <?php  if(!empty($nav['blank'])) { ?>target="_blank"<?php  } ?>><?php  echo $nav['title'];?></a></li>
					<?php  } } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="wi wi-user color-gray"></i><?php  echo $_W['user']['username'];?> <span class="caret"></span></a>
						<ul class="dropdown-menu color-gray" role="menu">
							<li>
								<a href="<?php  echo url('user/profile');?>" target="_blank"><i class="wi wi-account color-gray"></i> 我的账号</a>
							</li>
							<?php  if($_W['isfounder']) { ?>
							<li class="divider"></li>
							<li><a href="<?php  echo url('cloud/upgrade');?>" target="_blank"><i class="wi wi-update color-gray"></i> 自动更新</a></li>
							<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="wi wi-cache color-gray"></i> 更新缓存</a></li>
							<li class="divider"></li>
							<?php  } ?>
							<li>
								<a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out color-gray"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<?php  } else { ?>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="<?php  echo url('user/register');?>">注册</a></li>
					<li class="dropdown"><a href="<?php  echo url('user/login');?>">登陆</a></li>
				</ul>
			</div>
			<?php  } ?>
		</div>
	</nav>
</div>
<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?> 
<div class="system-tips we7-body-alert" id="setmeal-tips">
	<div class="container text-right">
		<div class="alert-info">
			<a href="<?php  if($_W['isfounder']) { ?><?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?><?php  } else { ?>javascript:void(0);<?php  } ?>">
				您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
				<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
				目前已到期，请联系管理员续费
				<?php  } else { ?>
				将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
				<?php  } ?>
			</a>
			<span class="tips-close" onclick="check_setmeal_hide();"><i class="wi wi-error-sign"></i></span>
		</div>
	</div>
</div>
<script>
	function check_setmeal_hide() {
		util.cookie.set('check_setmeal', 1, 1800);
		$('#setmeal-tips').hide();
		return false;
	}
</script>
<?php  } ?> 
<div class="main">
<?php  if(!defined('IN_MESSAGE')) { ?>
<div class="container">
	<?php  if(in_array(FRAME, array('account', 'system', 'wxapp', 'site')) && !in_array($_GPC['a'], array('news-show', 'notice-show'))) { ?>
		<a href="javascript:;" class="js-big-main button-to-big color-gray" title="加宽"><?php  if($_GPC['main-lg']) { ?>正常<?php  } else { ?>宽屏<?php  } ?></a>
	<div class="panel panel-content main-panel-content <?php  if(!empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>panel-content-plugin<?php  } ?>">
		<div class="content-head panel-heading main-panel-heading">
			<?php  if(($_GPC['c'] != 'cloud' && !empty($_GPC['m']) && !in_array($_GPC['m'], array('keyword', 'special', 'welcome', 'default', 'userapi', 'service'))) || defined('IN_MODULE')) { ?>
				<a href="<?php  echo url('home/welcome/account')?>" class="we7-head-back"><i class="wi wi-back-circle"></i></a>
				<span class="we7-head-account"><a href="<?php  echo url('home/welcome/account')?>"><?php  echo $_W['account']['name'];?></a></span>
				<?php  if(file_exists(IA_ROOT. "/addons/". $_W['current_module']['name']. "/icon-custom.jpg")) { ?>
				<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon-custom.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
				<?php  } else { ?>
				<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
				<?php  } ?>
				<span class="font-lg"><?php  echo $_W['current_module']['title'];?></span>
				<span class="pull-right"><a href="<?php  echo url('profile/module');?>" class="color-default we7-margin-left"><i class="wi wi-cut color-default"></i>切换其他应用</a></span>
				<span class="pull-right"><a href="<?php  echo url('home/welcome/ext', array('m' => 'we7_coupon'))?>" class="color-default we7-margin-left"><i class="wi wi-redact"></i>卡券/门店/收银台设置</a></span>
				<span class="pull-right"><a href="<?php  echo url('website/wenda-show/list', array('cateid' => 1, 'modid' => $_W['current_module']['mid']));?>" class="color-default we7-margin-left"><i class="wi wi-log"></i>使用教程</a></span>
				<!-- 兼容历史性问题：模块内获取不到模块信息$module的问题-start -->
				<?php  if(CRUMBS_NAV == 1) { ?>
				<?php  global $module;?>
				<?php  } ?>
				<!-- end -->
			<?php  } else if(FRAME == 'account') { ?>
				<img src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" class="head-logo">
				<span class="font-lg"><?php  echo $_W['account']['name'];?></span>

				<?php  if($_W['account']['level'] == 1 || $_W['account']['level'] == 3) { ?>
					<span class="label label-primary">订阅号</span><?php  if($_W['account']['level'] == 3) { ?><span class="label label-primary">已认证</span><?php  } ?>
				<?php  } ?>
				<?php  if($_W['account']['level'] == 2 || $_W['account']['level'] == 4) { ?>
					<span class="label label-primary">服务号</span> <?php  if($_W['account']['level'] == 4) { ?><span class="label label-primary">已认证</span><?php  } ?>
				<?php  } ?>
				<?php  if($_W['uniaccount']['isconnect'] == 0) { ?>
					<span class="tips-danger">
						<i class="wi wi-warning-sign"></i>未接入微信公众号
						<a href="<?php  echo url('account/post', array('uniacid' => $_W['account']['uniacid'], 'acid' => $_W['acid']))?>">立即接入</a>
					</span>
					<?php  } ?>
					<span class="pull-right"><a href="<?php  echo url('account/display')?>" class="color-default we7-margin-left"><i class="wi wi-cut color-default"></i>切换公众号</a></span>
				<?php  if(uni_permission($_W['uid'], $_W['uniacid']) != ACCOUNT_MANAGE_NAME_OPERATOR) { ?>
					<span class="pull-right"><a href="<?php  echo url('account/post', array('uniacid' => $_W['account']['uniacid'], 'acid' => $_W['acid']))?>"><i class="wi wi-appsetting"></i>公众号设置</a></span>
				<?php  } ?>
				<span class="pull-right" style ="margin-right:20px"><a href="<?php  echo url('home/welcome/ext', array('m' => 'we7_coupon'))?>"><i class="wi wi-redact"></i>卡券/门店/收银台设置</a></span>
				<span class="pull-right"><a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="wi wi-iphone"></i>模拟测试</a></span>
			<?php  } ?>
			<?php  if(FRAME == 'system') { ?>
				<span class="font-lg"><i class="wi wi-setting"></i> 系统管理</span>
				<span class="pull-right" style ="margin-right:20px"><a href="<?php  echo url('system/welcome')?>"><i class="wi wi-cut color-default"></i>进入系统菜单界面</a></span>
			<?php  } ?>
			<?php  if(FRAME == 'site') { ?>
				<span class="font-lg"><i class="wi wi-system-site"></i> 站点管理</span>
			<?php  } ?>
			<?php  if(FRAME == 'wxapp') { ?>
				<img src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" class="head-logo">
				<span class="wxapp-name"><?php  echo $wxapp_info['name'];?></span>
				<span class="wxapp-version"><?php  echo $version_info['version'];?></span>
				<div class="pull-right">
					<a href="<?php  echo url('wxapp/version/display', array('uniacid' => $version_info['uniacid']))?>" class="color-default"><i class="wi wi-cut"></i>切换版本</a>
					<?php  if(in_array($role, array(ACCOUNT_MANAGE_NAME_OWNER, ACCOUNT_MANAGE_NAME_MANAGER)) || $_W['isfounder']) { ?>
					<a href="<?php  echo url('wxapp/manage/display', array('uniacid' => $version_info['uniacid']))?>" class="color-default"><i class="wi wi-text"></i>管理</a>
					<?php  } ?>
					<a href="<?php  echo url('wxapp/display')?>" class="color-default"><i class="wi wi-small-routine"></i>切换小程序</a>
				</div>
			<?php  } ?>
		</div>
	<div class="panel-body clearfix main-panel-body <?php  if(!empty($_W['setting']['copyright']['leftmenufixed'])) { ?>menu-fixed<?php  } ?>">
		<div class="left-menu">
			<div class="left-menu-content">
			<?php  if(empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>
				<?php  if(is_array($frames['section'])) { foreach($frames['section'] as $frame_section_id => $frame_section) { ?>
				<?php  if(!isset($frame_section['is_display']) || !empty($frame_section['is_display'])) { ?>
				<div class="panel panel-menu">
					<?php  if($frame_section['title']) { ?>
					<div class="panel-heading">
						<span class="no-collapse"><?php  echo $frame_section['title'];?><i class="wi wi-appsetting pull-right setting"></i></span>
					</div>
					<?php  } ?>
					<ul class="list-group">
						<?php  if(is_array($frame_section['menu'])) { foreach($frame_section['menu'] as $menu_id => $menu) { ?>
						<?php  if(!empty($menu['is_display'])) { ?>
							<?php  if($menu_id == 'platform_module_more') { ?>
							<li class="list-group-item list-group-more">
								<a href="<?php  echo url('profile/module');?>"><span class="label label-more">更多应用</span></a>
							</li>
							<?php  } else { ?>
							<li class="list-group-item <?php  if($menu['active']) { ?>active<?php  } ?>">
								<a href="<?php  echo $menu['url'];?>" class="text-over" <?php  if($frame_section_id == 'platform_module') { ?>target="_blank"<?php  } ?>>
								<?php  if($menu['icon']) { ?>
								<?php  if($frame_section_id == 'platform_module') { ?>
								<img src="<?php  echo $menu['icon'];?>"/>
								<?php  } else { ?>
								<i class="<?php  echo $menu['icon'];?>"></i>
								<?php  } ?>
								<?php  } ?>
								<?php  echo $menu['title'];?>
								</a>
							</li>
							<?php  } ?>
						<?php  } ?>
						<?php  } } ?>
					</ul>
				</div>
				<?php  } ?>
				<?php  } } ?>
			<?php  } else { ?>
				<div class="plugin-menu clearfix">
					<div class="plugin-menu-main pull-left">
						<ul class="list-group">
							<li class="list-group-item<?php  if($_GPC['m'] == '') { ?> active<?php  } ?>">
								<a href="<?php  echo url('home/welcome/ext', array('m' => $frames['section']['platform_module_menu']['plugin_menu']['main_module']))?>">
									<i class="wi wi-main-apply"></i>
									<div>主应用</div>
								</a>
							</li>
							<li class="list-group-item">
								<div>插件</div>
							</li>
							<?php  if(is_array($frames['section']['platform_module_menu']['plugin_menu']['menu'])) { foreach($frames['section']['platform_module_menu']['plugin_menu']['menu'] as $plugin_name => $plugin) { ?>
							<li class="list-group-item<?php  if($_GPC['m'] == $plugin_name) { ?> active<?php  } ?>">
								<a href="<?php  echo url('home/welcome/ext', array('m' => $plugin_name))?>">
									<img src="<?php  echo $plugin['icon'];?>" alt="" class="img-icon" />
									<div><?php  echo $plugin['title'];?></div>
								</a>
							</li>
							<?php  } } ?>
						</ul>
						<?php  unset($plugin_name);?>
						<?php  unset($plugin);?>
					</div>
					<div class="plugin-menu-sub pull-left">
						<?php  if(is_array($frames['section'])) { foreach($frames['section'] as $frame_section_id => $frame_section) { ?>
						<?php  if(!isset($frame_section['is_display']) || !empty($frame_section['is_display'])) { ?>
							<div class="panel panel-menu">
								<?php  if($frame_section['title']) { ?>
								<div class="panel-heading">
									<span class="no-collapse"><?php  echo $frame_section['title'];?><i class="wi wi-appsetting pull-right setting"></i></span>
								</div>
								<?php  } ?>
								<ul class="list-group panel-collapse">
									<?php  if(is_array($frame_section['menu'])) { foreach($frame_section['menu'] as $menu_id => $menu) { ?>
									<?php  if(!empty($menu['is_display'])) { ?>
									<?php  if($menu_id == 'platform_module_more') { ?>
									<li class="list-group-item list-group-more">
										<a href="<?php  echo url('profile/module');?>"><span class="label label-more">更多应用</span></a>
									</li>
									<?php  } else { ?>
									<li class="list-group-item <?php  if($menu['active']) { ?>active<?php  } ?>">
										<a href="<?php  echo $menu['url'];?>" class="text-over" <?php  if($frame_section_id == 'platform_module') { ?>target="_blank"<?php  } ?>>
										<?php  if($menu['icon']) { ?>
											<?php  if($frame_section_id == 'platform_module') { ?>
											<img src="<?php  echo $menu['icon'];?>"/>
											<?php  } else { ?>
											<i class="<?php  echo $menu['icon'];?>"></i>
											<?php  } ?>
										<?php  } ?>
										<?php  echo $menu['title'];?>
										</a>
									</li>
									<?php  } ?>
									<?php  } ?>
									<?php  } } ?>
								</ul>
							</div>
						<?php  } ?>
						<?php  } } ?>
					</div>
				</div>
			<?php  } ?>
			</div>
		</div>
		<div class="right-content">
	<?php  } ?>
<?php  } ?>

<?php  } else { ?>
	<?php  if($_W['role'] != 'clerk') { ?>
	<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="./?refresh"><i class="fa fa-reply-all"></i>返回系统</a></li>
				<?php  global $top_nav;?>
				<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?>
					<?php  if(!empty($_W['isfounder']) || empty($_W['setting']['permurls']['sections']) || in_array($nav['name'], $_W['setting']['permurls']['sections'])) { ?><li<?php  if(FRAME == $nav['name']) { ?> class="active"<?php  } ?>><a href="<?php  echo url('home/welcome/' . $nav['name']);?>"><i class="<?php  echo $nav['append_title'];?>"></i><?php  echo $nav['title'];?></a></li><?php  } ?>
				<?php  } } ?>
				<li <?php  if($action == 'emulator') { ?>class="active"<?php  } ?>>
					<a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile"></i> 模拟测试</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown topbar-notice">
					<a type="button" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="badge" id="notice-total">0</span>
					</a>
					<div class="dropdown-menu" aria-labelledby="dLabel">
						<div class="topbar-notice-panel">
							<div class="topbar-notice-arrow"></div>
							<div class="topbar-notice-head">
								<span>系统公告</span>
								<a href="<?php  echo url('article/notice-show/list');?>" class="pull-right">更多公告>></a>
							</div>
							<div class="topbar-notice-body">
								<ul id="notice-container"></ul>
							</div>
						</div>
					</div>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-group"></i><?php  echo $_W['account']['name'];?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php  if($_W['role'] != 'operator') { ?>
						<li><a href="<?php  echo url('account/post', array('uniacid' => $_W['uniacid']));?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑当前账号资料</a></li>
						<?php  } ?>
						<li><a href="<?php  echo url('account/display');?>" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
						<li><a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" style="display:block; max-width:185px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><i class="fa fa-user"></i><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 我的账号</a></li>
						<?php  if($_W['role'] == 'founder') { ?>
						<li class="divider"></li>
						<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i> 系统选项</a></li>
						<li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> 自动更新</a></li>
						<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i> 更新缓存</a></li>
						<li class="divider"></li>
						<?php  } ?>
						<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
		<div class="upgrade-tips" id="setmeal-tips">
			<a href="<?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?>" target="_blank">
				您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
				<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
				目前已到期，请联系管理员续费
				<?php  } else { ?>
				将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
				<?php  } ?>
			</a><span class="tips-close" style="background:#d03e14;" onclick="check_setmeal_hide();"><i class="fa fa-times-circle"></i></span>
		</div>
		<script>
			function check_setmeal_hide() {
				util.cookie.set('check_setmeal', 1, 1800);
				$('#setmeal-tips').hide();
				return false;
			}
		</script>
	<?php  } ?>
	<?php  } else { ?>
		<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="position:static;">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="<?php  echo url('activity/desk/index');?>"><i class="fa fa-desktop"></i> 工作台首页</a></li>
					<li><a href="javascript:;" class="login-qrcode"><i class="fa fa-qrcode"></i> 手机登录</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="javascript:;"><i class="fa fa-user"></i> <?php  echo $_W['user']['name'];?> - <?php  echo $_W['user']['store_name'];?></a></li>
					<li><a href="<?php  echo url('user/profile/profile');?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 账号信息</a></li>
					<li><a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出系统</a></li>
				</ul>
			</div>
		</div>
	<?php  } ?>
	<div class="container-fluid">
		<?php  if(defined('IN_MESSAGE')) { ?>
		<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-lg-2">
					<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
					<?php  if(is_array($msg)) { ?>
						<h2>MYSQL 错误：</h2>
						<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
						<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
					<?php  } else { ?>
					<h2><?php  echo $caption;?></h2>
					<p><?php  echo $msg;?></p>
					<?php  } ?>
					<?php  if($redirect) { ?>
					<p><a href="<?php  echo $redirect;?>">如果你的浏览器没有自动跳转，请点击此链接</a></p>
					<script type="text/javascript">
						setTimeout(function () {
							location.href = "<?php  echo $redirect;?>";
						}, 3000);
					</script>
					<?php  } else { ?>
						<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh">首页</a>]</p>
					<?php  } ?>
				</div>
		<?php  } else { ?>
		<div class="row">
			<?php $frames = empty($frames) ? $GLOBALS['frames'] : $frames; _calc_current_frames($frames);?>
			<?php  if(!empty($frames)) { ?>
				<div class="col-xs-12 col-sm-3 col-lg-2 big-menu">
					<div id="search-menu">
						<input class="form-control input-lg" style="border-radius:0; font-size:14px; height:43px;" type="text" placeholder="输入菜单名称可快速查找">
					</div>
					<?php  if($GLOBALS['ext_type'] > 0) { ?>
						<div class="btn-group">
							<button class="btn <?php  if($GLOBALS['ext_type'] == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="1">默认</button>
							<button class="btn <?php  if($GLOBALS['ext_type'] == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="2">系统</button>
							<button class="btn <?php  if($GLOBALS['ext_type'] == 3) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?> ext-type" data-id="3">复合</button>
						</div>
					<?php  } ?>
					<?php  if(is_array($frames)) { foreach($frames as $k => $frame) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><?php  echo $frame['title'];?></h4>
							<a class="panel-collapse collapsed" data-toggle="collapse" href="#frame-<?php  echo $k;?>">
								<i class="fa fa-chevron-circle-down"></i>
							</a>
						</div>
						<ul class="list-group collapse in" id="frame-<?php  echo $k;?>">
							<?php  if(is_array($frame['items'])) { foreach($frame['items'] as $link) { ?>
							<?php  if(!empty($link['append'])) { ?>
							<li class="list-group-item<?php  echo $link['active'];?>" onclick="window.location.href = '<?php  echo $link['url'];?>';" style="cursor:pointer; overflow:hidden;" kw="<?php  echo $link['title'];?>">
								<a class="pull-right" href="<?php  echo $link['append']['url'];?>"><?php  echo $link['append']['title'];?></a>
								<?php  echo $link['title'];?>
							</li>
							<?php  } else { ?>
							<a class="list-group-item<?php  echo $link['active'];?>" href="<?php  echo $link['url'];?>" kw="<?php  echo $link['title'];?>"><?php  echo $link['title'];?></a>
							<?php  } ?>
							<?php  } } ?>
						</ul>
					</div>
					<?php  } } ?>
					<script type="text/javascript">
						require(['bootstrap'], function(){
							$('.ext-type').click(function(){
								var id = $(this).data('id');
								util.cookie.del('ext_type');
								util.cookie.set('ext_type', id, 8640000);
								location.reload();
								return false;
							});

							$('#search-menu input').keyup(function() {
								var a = $(this).val();
								$('.big-menu .list-group-item, .big-menu .panel-heading').hide();
								$('.big-menu .list-group-item').each(function() {
									$(this).css('border-left', '0');
									if(a.length > 0 && $(this).attr('kw').indexOf(a) >= 0) {
										$(this).parents(".panel").find('.panel-heading').show();
										$(this).show().css('border-left', '3px #428bca double');
									}
								});
								if(a.length == 0) {
									$('.big-menu .list-group-item, .big-menu .panel-heading').show();
								}
							});
						});
					</script>
				</div>
				<div class="col-xs-12 col-sm-9 col-lg-10">
					<?php  if(CRUMBS_NAV == 1) { ?>
						<?php  global $module_types;global $module;global $ptr_title;?>
						<ol class="breadcrumb" style="padding:5px 0;">
							<li><a href="<?php  echo url('home/welcome/ext');?>"><i class="fa fa-cogs"></i> &nbsp; 扩展功能</a></li>
							<li><a href="<?php  echo url('home/welcome/ext', array('m' => $module['name']));?>"><?php  echo $module_types[$module['type']]['title'];?>模块 - <?php  echo $module['title'];?></a></li>
							<li class="active"><?php  echo $ptr_title;?></li>
						</ol>
					<?php  } else if(CRUMBS_NAV == 2) { ?>
						<?php  global $module_types;global $module;global $ptr_title; global $site_urls; $m = $_GPC['m'];?>
						<ul class="nav nav-tabs">
							<li><a href="<?php  echo url('platform/reply', array('m' => $m));?>">管理<?php  echo $module['title'];?></a></li>
							<li><a href="<?php  echo url('platform/reply/post', array('m' => $m));?>"><i class="fa fa-plus"></i> 添加<?php  echo $module['title'];?></a></li>
							<?php  if(!empty($site_urls)) { ?>
								<?php  if(is_array($site_urls)) { foreach($site_urls as $site_url) { ?>
									<li <?php  if($_GPC['do'] == $site_url['do']) { ?> class="active"<?php  } ?>><a href="<?php  echo $site_url['url'];?>"> <?php  echo $site_url['title'];?></a></li>
								<?php  } } ?>
							<?php  } ?>
						</ul>
					<?php  } ?>
			<?php  } else { ?>
				<div class="col-xs-12 col-sm-12 col-lg-12">
			<?php  } ?>
		<?php  } ?>
<?php  } ?>