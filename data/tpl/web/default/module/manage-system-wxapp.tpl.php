<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'installed') { ?>
<div class="we7-page-title">
	小程序管理
</div>
<div id="js-system-module" ng-controller="installedCtrl" ng-cloak>
	<ul class="we7-page-tab">
		<li class="active"><a href="<?php  echo url('module/manage-system/installed', array('account_type' => 4))?>">已安装的小程序  </a></li>
		<li><a href="<?php  echo url('module/manage-system/not_installed', array('account_type' => 4))?>" ng-if="isFounder == 1">未安装的小程序<span class="color-red">  (<?php  echo $total_uninstalled;?>) </span></a></li>
		<li><a href="<?php  echo url('module/manage-system/not_installed', array('account_type' => 4, 'status' => 'recycle'))?>" ng-if="isFounder == 1">已停用小程序</a></li>
	</ul>
	<div class="we7-page-search clearfix">
		<!--<div class="pull-right">-->
		<!--<a href="添加.html" class="btn btn-danger">购买应用模块</a>-->
		<!--</div>-->
		<form action="" method="get" class="row">
			<div class="form-group we7-margin-bottom  col-sm-4">
				<input type="hidden" name="letter" ng-model="activeLetter">
				<input type="hidden" name="c" value="module">
				<input type="hidden" name="a" value="manage-system">
				<input type="hidden" name="do" value="page">
				<input type="hidden" name="account_type" value="4">
				<div class="input-group">
					<input class="form-control" name="title" value="<?php  echo $title;?>" type="text" placeholder="名称" >
					<span class="input-group-btn"><button class="btn btn-default" id="search"><i class="fa fa-search"></i></button></span>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>

	<ul class="letters-list">
		<li ng-class="activeLetter == letter ? 'active' : ''" ng-repeat="letter in letters"><a href="javascript:;" ng-click="searchLetter(letter)">{{ letter }}</a></li>
	</ul>

	<form action="" method="get">
		<table class="table we7-table table-hover vertical-middle table-manage table-manage-td">
			<col width="120px" />
			<col width="350px"/>
			<col width="230px" />
			<tr>
				<th colspan="2" class="text-left">小程序应用</th>
				<!--<th>公众号</th>-->
				<!--<th>数量</th>-->
				<th class="text-right">操作</th>
			</tr>
			<tr ng-repeat="module in module_list">
				<td class="text-left">
					<img ng-src="{{ module.logo }}" class="img-responsive icon"/>
				</td>
				<td class="text-left">
					<p>{{ module.title }}</p>
					<span>版本：{{ module.version }} </span><span class="color-red" ng-if="module.upgrade && isFounder == 1">发现新版本</span>
				</td>
				<!--<td >{{ module.use_account }}</td>-->
				<!--<td >{{ module.enabled_use_account }}</td>-->
				<td class="text-left vertical-middle table-manage-td">
					<div class="link-group">
						<a ng-href="{{ './index.php?c=module&a=manage-system&do=upgrade&module_name='+module.name}}&account_type=<?php echo ACCOUNT_TYPE;?>" class="color-red" ng-if="module.upgrade && module.from != 'cloud' && isFounder == 1">升级</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&show=upgrade&account_type=<?php echo ACCOUNT_TYPE;?>" class="color-red del" ng-if="module.upgrade && module.from == 'cloud' && isFounder == 1">升级</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="isFounder == 1">管理设置</a>
						<!--<a href="javascript:;" ng-if="isFounder == 1" ng-click="editModule(module.mid)">编辑</a>-->
					</div>
					<div class="manage-option text-right">
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="isFounder == 1">基本信息</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&show=group" ng-if="isFounder == 1">应用权限组</a>
						<a href="<?php  echo url('module/manage-system/module_detail')?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>&show=subscribe" ng-if="isFounder == 1 && module.subscribes.length">订阅消息</a>
						<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
						<a href="<?php  echo url('module/manage-system/uninstall', array('account_type' => 4))?>&name={{ module.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-if="isFounder == 1" class="del">停用</a>
						<?php  } ?>
					</div>
				</td>
			</tr>
		</table>
		<div class="select-all">
			<div class="we7-form text-right">
				<?php  echo $pager;?>
			</div>
		</div>
	</form>

	<div class="modal fade" id="module-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form" id="form-info">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">编辑模块信息</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块标题</label>
							<div class="col-sm-10">
								<input type="text" name="title" ng-model="moduleinfo.title" class="form-control">
								<span class="help-block">模块的名称, 显示在用户的模块列表中. 不要超过10个字符</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块简述</label>
							<div class="col-sm-10">
								<input type="text" name="ability" ng-model="moduleinfo.ability" class="form-control">
								<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块介绍</label>
							<div class="col-sm-10">
								<textarea type="text" name="description" ng-model="moduleinfo.description" class="form-control" rows="5">{{ moduleinfo.description }}</textarea>
								<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块缩略图</label>
							<div class="col-sm-10">
								<div class="we7-input-img" ng-class="{ 'active' : moduleinfo.logo }" style="width: 100px;height: 100px; font-size: 45px;">
									<img ng-src="{{ moduleinfo.logo }}" ng-if="moduleinfo.logo">
									<a href="javascript:;" class="input-addon" ng-hide="moduleinfo.logo" ng-click="changePicture('logo')"><span>+</span></a>
									<input type="hidden" name="thumb">
									<div class="cover-dark">
										<a href="javascript:;" class="cut" ng-click="changePicture('logo')">更换</a>
										<a href="javascript:;" class="del" ng-click="delPicture('logo')"><i class="fa fa-times text-danger"></i></a>
									</div>
								</div>
								<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧。仅支持jpg格式</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 模块封面</label>
							<div class="col-sm-10">
								<div class="we7-input-img" ng-class="{ 'active' : moduleinfo.logo}"  style="width: 100px;height: 100px; font-size: 45px;">
									<img ng-src="{{ moduleinfo.preview }}">
									<a href="javascript:;" class="input-addon" ng-click="changePicture('preview')"><span>+</span></a>
									<input type="hidden" name="thumb">
									<div class="cover-dark">
										<a href="javascript:;" class="cut" ng-click="changePicture('preview')">更换</a>
										<a href="javascript:;" class="del" ng-click="delPicture('preview')"><i class="fa fa-times text-danger"></i></a>
									</div>
								</div>
								<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置。仅支持jpg格式</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button  class="btn btn-primary" type="text" name="submit" ng-click="save()" data-dismiss="modal">保存</button>
						<input type="hidden" name="token" value="c781f0df">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="upgrade-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabels" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">模块分支版本信息</h4>
				</div>
				<div class="modal-body">
					<div style="margin:-30px -30px 30px;" class="modal-alert">
						<div class="alert alert-info">
							<p><i class="wi  wi-info-sign"></i> 应用分支按照等级顺序排列。</p>
							<p><i class="wi  wi-info-sign"></i> 如果要升级到其它分支最新版本，需要花费对应分支价格数量的交易币。</p>
							<p><i class="wi  wi-info-sign"></i> 已购买的模块分支可以免费升级到该分支的最新版本。</p>
						</div>
					</div>
					<table class="table we7-table vertical-middle">
						<col width="">
						<col width="180px">
						<col width="400px">
						<tr>
							<th colspan="3" class="text-left">{{ module_list[upgradeInfo.name].title }}---模块分支信息</th>
						</tr>
						<tr>
							<td class="text-left">
								分支名称
							</td>
							<td class="text-center">
								升级价格
							</td>
							<td class="text-center">
								操作
							</td>
						</tr>
						<tr ng-repeat="branch in upgradeInfo.branches">
							<td class="text-left">  {{ branch.name }}</td>
							<td class="text-center">  {{  branch.id > upgradeInfo.site_branch.id ? branch.upgrade_price : 0 }}元</td>

							<td class="text-right">
								<div class="link-group">
									<a tabindex="2" href="javascript:;" role="button" data-toggle="popover" title="{{ module_list[upgradeInfo.name].title }}升级说明" data-container="#upgrade-info" data-placement="bottom" data-trigger="focus" data-html="true" data-content="{{ branch.version.description }}">升级说明</a>
									<a ng-href="{{ './index.php?c=cloud&a=process&m='+upgradeInfo.name+'&is_upgrade=1' }}&account_type=<?php echo ACCOUNT_TYPE;?>" onclick="return confirm('确定要升级到此分之的最新版吗？')" ng-if="branch.id == upgradeInfo.site_branch.id">免费升级到【{{branch.name}}】最新版本</a>
									<a ng-href="{{ './index.php?c=cloud&a=redirect&do=buybranch&m='+upgradeInfo.name+'&branch='+branch.id+'&is_upgrade=1' }}&account_type=<?php echo ACCOUNT_TYPE;?>" ng-click="upgrade(branch.upgrade_price)" ng-if="branch.id > upgradeInfo.site_branch.id">付费升级到【{{branch.name}}】最新版本</a>
								</div>
							</td>
							<script>
								$('[data-toggle="popover"]').popover();
							</script>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	require(['fileUploader'], function() {
		angular.module('moduleApp').value('config', {
			'isFounder' : '<?php  if($_W['isfounder']) { ?>1<?php  } else { ?>2<?php  } ?>',
			'letters': <?php  echo json_encode($letters)?>,
			'module_list': <?php  echo json_encode($module_list)?>,
			'editModuleUrl': "<?php  echo url('module/manage-system/get_module_info')?>",
			'saveModuleUrl' :  "<?php  echo url('module/manage-system/save_module_info')?>",
			'checkUpgradeUrl' : "<?php  echo url('module/manage-system/check_upgrade')?>",
			'get_upgrade_info_url' : "<?php  echo url('module/manage-system/get_upgrade_info')?>"
		});
		angular.bootstrap($('#js-system-module'), ['moduleApp']);
	});
</script>
<?php  } else if($do == 'not_installed') { ?>
<div class="we7-page-title">
	应用管理
</div>
<ul class="we7-page-tab">
	<li><a href="<?php  echo url('module/manage-system/installed', array('account_type' => 4))?>">已安装的小程序  </a></li>
	<li <?php  if($status == 'uninstalled') { ?>class="active"<?php  } ?>><a href="<?php  echo url('module/manage-system/not_installed', array('account_type' => 4))?>">未安装的小程序<span class="color-red">  (<?php  echo $total_uninstalled;?>) </span></a></li>
	<li <?php  if($status == 'recycle') { ?>class="active"<?php  } ?>><a href="<?php  echo url('module/manage-system/not_installed', array('account_type' => 4, 'status' => 'recycle'))?>">已停用小程序</a></li>
</ul>
<div id="js-system-module-not_installed" ng-controller="notInstalledCtrl" ng-cloak>
	<div class="we7-page-search clearfix">
		<!--<div class="pull-right">-->
		<!--<a href="添加.html" class="btn btn-danger">购买应用模块</a>-->
		<!--</div>-->
		<form action="" method="get" class="row">
			<div class="form-group col-sm-4">
				<div class="input-group we7-margin-bottom">
					<input type="hidden" name="c" value="module">
					<input type="hidden" name="a" value="manage-system">
					<input type="hidden" name="do" value="not_installed">
					<input type="hidden" name="status" value="<?php  if($status == 'recycle') { ?>recycle<?php  } else { ?>uninstalled<?php  } ?>">
					<input type="hidden" name="account_type" value="4">
					<input type="hidden" name="letter" value="<?php  echo $letter;?>">
					<input class="form-control" name="title" value="<?php  echo $title;?>" type="text" placeholder="名称" >
					<span class="input-group-btn"><button id="search" class="btn btn-default"><i class="fa fa-search"></i></button></span>
				</div>
			</div>
		</form>
	</div>
	<div class="clearfix">	</div>

	<ul class="letters-list">
		<li ng-repeat="letter in letters"><a href="javascript:;" ng-click="searchLetter(letter)">{{ letter }}</a></li>
	</ul>

	<table class="table we7-table table-hover vertical-middle table-manage">
		<tr>
			<th colspan="2" class="text-left">小程序应用</th>
			<th class="text-left">操作</th>
		</tr>
		<tr ng-repeat="module in module_list">
			<td class="text-left">
				<img ng-src="{{ module.logo }}" class="img-responsive" style="width: 50px;height: 50px;"/>
			</td>
			<td class="text-left">
				<p>{{ module.title }}</p>
				<span>版本：{{ module.version }} </span>
			</td>
			<td class="text-left">
				<a href="<?php  echo url('module/manage-system/upgrade', array('account_type' => 4))?>&module_name={{ module.name }}" ng-if="module.upgrade_support == true" class="btn btn-primary">安装应用模块</a>
				<a href="<?php  echo url('module/manage-system/install', array('account_type' => 4))?>&module_name={{ module.name }}" ng-if="module.upgrade_support != true" class="btn btn-primary">安装应用模块</a>
			</td>
		</tr>
	</table>
	</form>
	<div class="text-right">
		<?php  echo $pager;?>
	</div>
</div>
<script>
	angular.module('moduleApp').value('config', {
		'letters' : <?php  echo json_encode($letters)?>,
		'module_list' : <?php  echo json_encode($uninstallModules)?>
	});
	angular.bootstrap($('#js-system-module-not_installed'), ['moduleApp']);
</script>
<?php  } else if($do == 'module_detail') { ?>
<div class="js-system-module-detail" ng-controller="detailCtrl" ng-cloak>
	<ol class="breadcrumb we7-breadcrumb">
		<a href="<?php  echo referer()?>"><i class="wi wi-back-circle"></i> </a>
		<li>
			应用列表
		</li>
		<li>
			应用管理
		</li>
	</ol>
	<div class="user-head-info we7-padding-bottom">
		<span class="icon pull-left" ng-if="moduleinfo.app_support == 2"><i class="wi wi-wx-apply"></i></span>
		<span class="icon pull-left" ng-if="moduleinfo.wxapp_support == 2 && moduleinfo.app_support != 2"><i class="wi wi-wxapp-apply"></i></span>
		<div class="img pull-left" ng-if="moduleinfo.main_module != ''">
			<img alt="子应用icon" class="plugin-img" ng-src="{{ moduleinfo.logo }}"/>
			<img alt="主应用icon" class="module-img" ng-src="{{ moduleinfo.main_module_logo }}"/>
		</div>
		<img ng-src="{{ moduleinfo.logo }}" class="user-avatar img-rounded pull-left" ng-if="moduleinfo.main_module == ''">
		<h3 class="pull-left">{{ moduleinfo.title }}</h3>
	</div>

	<div class="btn-group we7-btn-group we7-margin-bottom">
		<a href="javascript:;" ng-click="changeShow('base')" class="btn " ng-class="{'active' : show == 'base' || show == ''}">基本信息</a>
		<a href="javascript:;" ng-click="changeShow('group')" class="btn " ng-class="{'active' : show == 'group'}">应用权限组</a>
		<a href="javascript:;" ng-click="changeShow('upgrade')" class="btn " ng-class="{'active' : show == 'upgrade'}" ng-show="checkupgrade == 1">升级</a>
	</div>
	<form action="" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
	<table class="table we7-table table-hover table-form" ng-show="show == 'base' || show == ''">
	<tr>
	<th class="text-left" colspan="3">小程序授权发布模板ID</th>
	</tr>
		<tr>
			<td width="140px" class="table-label">小程序模板ID</td>
			<td style="padding-top:16px">
			<input type="text" name="template_id"  class="form-control col-sm-10 col-xs-12" value="<?php  echo $modules['template_id'];?>" />
			<span class="help-block">一键授权发布：开通微信开发平台--》绑定1个小程序--》用开发工具上传小程序--》草稿箱添加到模板</span>
			</td>
			<td class="text-right">
				<div class="link-group"><input name="submit" type="submit" value="提交" class="btn btn-primary span3" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /></div>
			</td>
	</tr>
	</table>
	</form>
	<table class="table we7-table table-hover table-form" ng-show="show == 'base' || show == ''">
		<col width="140px">
		<col />
		<col width="100px">
		<tr>
			<th class="text-left" colspan="3">编辑模块基本信息</th>
		</tr>
		<tr>
			<td class="table-label">模块标题</td>
			<td>{{ moduleinfo.title }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('title', moduleinfo.title)">修改</a></div>
			</td>
		</tr>
		<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
		<tr>
			<td class="table-label">模块作者</td>
			<td colspan="2">{{ moduleinfo.author }}</td>
		</tr>
		<tr>
			<td class="table-label">模块版本</td>
			<td colspan="2">{{ moduleinfo.version }}</td>
		</tr>
		<?php  } ?>
		<tr>
			<td class="table-label">模块简述</td>
			<td>{{ moduleinfo.ability }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('ability', moduleinfo.ability)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块介绍</td>
			<td>{{ moduleinfo.description }}</td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('description', moduleinfo.description)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块缩略图</td>
			<td><img ng-src="{{ moduleinfo.logo }}" alt="" style="width:65px; height:65px;" class="img-rounded"/></td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('logo', moduleinfo.logo)">修改</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">模块封面</td>
			<td><img ng-src="{{ moduleinfo.preview }}" alt="" style="width:65px; height:65px;" class="img-rounded"/></td>
			<td class="text-right">
				<div class="link-group"><a href="javascript:;" ng-click="editModule('preview', moduleinfo.preview)">修改</a></div>
			</td>
		</tr>
	</table>
	<?php  if(!empty($module_info['is_relation'])) { ?>
	<table class="table we7-table table-hover vertical-middle table-manage">
		<col width="150px"/>
		<col />
		<col />
		<tr>
			<th colspan="3" class="text-left">可关联</th>
		</tr>
		<tr>
			<td class="text-left">
				{{ moduleinfo.relation_name }}
			</td>
			<td class="text-left">
				<img ng-src="{{ moduleinfo.logo }}" class="img-responsive pull-left" style="width: 50px;height: 50px; margin-right: 10px;"/>
				<p>{{ moduleinfo.title }}</p>
				<span class="color-gray">版本：{{ moduleinfo.version }} </span>
			</td>
			<td class="text-right">
				<div class="link-group"><a href="<?php  echo url('module/manage-system/module_detail')?>name={{moduleinfo.name}}&account_type={{moduleinfo.account_type}}&type={{moduleinfo.type}}">查看</a></div>
			</td>
		</tr>
	</table>
	<?php  } ?>
	<table class="table we7-table table-hover vertical-middle" ng-show="show == 'upgrade'" ng-if="isFounder == 1 && upgradeInfo.from == 'local'">
		<col width="300px"/>
		<col />
		<col />
		<col />
		<col width="200px;"/>
		<tr>
			<th>目前版本</th>
			<th>最新版本</th>
			<th class="text-right">操作</th>
		</tr>
		<tr>
			<td>{{ moduleinfo.version }}</td>
			<td>{{ upgradeInfo.best_version }}</td>
			<td class="text-right">
				<a href="<?php  echo url('module/manage-system/upgrade')?>module_name={{ moduleinfo.name }}&account_type=<?php echo ACCOUNT_TYPE;?>" class="btn btn-danger">升级</a>
			</td>
		</tr>
	</table>
	<table class="table we7-table table-hover vertical-middle" ng-show="show == 'upgrade'" ng-if="isFounder == 1 && upgradeInfo.from == 'cloud' && branch.displayorder >= upgradeInfo.site_branch.displayorder" ng-repeat="branch in upgradeInfo.branches">
		<col width="300px"/>
		<col />
		<col />
		<col />
		<col width="200px"/>
		<tr>
			<th class="text-left">分支名称</th>
			<th>分支价格</th>
			<th>目前版本</th>
			<th>最新版本</th>
			<th class="text-right">操作</th>
		</tr>
		<tbody>
		<tr>
			<td class="text-left">{{ branch.name }}</td>
			<td class="color-red">{{ branch.displayorder > upgradeInfo.site_branch.displayorder || (branch.displayorder == upgradeInfo.site_branch.displayorder && branch.id > upgradeInfo.site_branch.id) ? branch.upgrade_price : ''}}<span class="label label-success" ng-if="branch.id == upgradeInfo.site_branch.id">当前分支</span></td>
			<td>{{ upgradeInfo.site_branch.id == branch.id ? moduleinfo.version : ''}}</td>
			<td>{{ branch.version.version }}</td>
			<td class="text-right">
				<span class="text text-success" ng-if="branch.id == upgradeInfo.site_branch.id && branch.version.version ==  moduleinfo.version">无需升级</span>
				<a href="javascript:;" ng-click="upgrade(branch.upgrade_price, upgradeInfo.name, branch.id)" ng-if="branch.displayorder > upgradeInfo.site_branch.displayorder || (branch.displayorder == upgradeInfo.site_branch.displayorder && branch.id > upgradeInfo.site_branch.id)" class="btn btn-danger">购买</a>
			</td>
		</tr>
		<tr>
			<td class="text-left">{{ branch.id == upgradeInfo.site_branch.id ? '版本更新内容' : ''}}</td>
			<td colspan="4" class="text-right">
				<a class="color-default view-detail" ng-if="branch.id == upgradeInfo.site_branch.id && branch.version.version !=  moduleinfo.version" href="javascript:;" data-id="{{ branch.id }}" onclick="change($(this))">查看详情 <i class="wi wi-angle-down"></i></a>
			</td>
		</tr>
		<tr id="version-detail-{{ branch.id }}" style="display:none">
			<td colspan="5" class="details-versions">
				<div class="js-version-lists">

					<div class="details-version">
						<div class="details-version-time">
							<p class="time-d">{{ branch.day }}</p>
							<p class="time-y-m">{{ branch.month }}</p>
						</div>
						<i class="fa fa-circle-o"></i>
						<div class="details-version-content">
							<div class="panel panel-version">
								<div class="panel-heading">
									版本号：{{ branch.version.version }} - {{ branch.name }}  <span class="time-h" ng-bind="branch.hour"></span>
								</div>
								<div class="panel-body" ng-bind-html="branch.version.description">
								</div>
							</div>
						</div>
					</div>

				</div>
				<?php  if($recent_versions['total'] > 10) { ?>
				<div class="text-center">
					<a href="javascript:;" class="btn c-blue js-versions-more">加载更多<i class="fa fa-angle-down"></i></a>
				</div>
				<?php  } ?>
			</td>
		</tr>
		</tbody>
	</table>
	<div class="module-group" ng-if="isFounder == 1">
		<table class="table we7-table table-hover" ng-show="show == 'group'">
			<col />
			<col width="100px" />
			<tr>
				<th class="text-left">
					应用权限组
				</th>
				<th class="text-right">
					<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
					<a href="<?php  echo url('module/group')?>" class="color-default">添加</a>
					<?php  } ?>
				</th>
			</tr>
			<tr>
				<td class="text-left">
					<span>所有服务</span>
				</td>
				<td>
				</td>
			</tr>
			<?php  if(is_array($module_group)) { foreach($module_group as $group) { ?>
			<tr>
				<td class="text-left">
					<span><?php  echo $group['name'];?></span>
				</td>
				<td class="text-right">
					<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
					<div class="link-group"><a href="<?php  echo url('module/group/post', array('id' => $group['id']))?>">设置</a></div>
					<?php  } ?>
				</td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
	<table class="table we7-table table-hover" ng-if="isFounder == 1">
		<col width="255px"/>
		<col width="130px"/>
		<col width="250px"/>
		<col width="122px"/>
		<col />
	</table>
	<div class="modal fade" id="module-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">编辑模块信息</h4>
				</div>
				<div class="modal-body">
					<div class="form-group" ng-show="editType == 'title'">
						<label class="col-sm-2 control-label"> 模块标题</label>
						<div class="col-sm-10">
							<input type="text" name="title" ng-model="moduleOriginal.title" class="form-control">
							<span class="help-block">模块的名称, 显示在用户的模块列表中. 不要超过10个字符</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'ability'">
						<label class="col-sm-2 control-label"> 模块简述</label>
						<div class="col-sm-10">
							<input type="text" name="ability" ng-model="moduleOriginal.ability" class="form-control">
							<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'description'">
						<label class="col-sm-2 control-label"> 模块介绍</label>
						<div class="col-sm-10">
							<textarea type="text" name="description" ng-model="moduleOriginal.description" class="form-control" rows="5">{{ moduleinfo.description }}</textarea>
							<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'logo'">
						<label class="col-sm-2 control-label"> 模块缩略图</label>
						<div class="col-sm-10">
							<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.logo }" style="width: 100px;height: 100px;">
								<img ng-src="{{ moduleOriginal.logo }}" ng-if="moduleOriginal.logo">
								<a href="javascript:;" class="input-addon" ng-hide="moduleOriginal.logo" ng-click="changePicture('logo')"><span>+</span></a>
								<input type="hidden" name="thumb">
								<div class="cover-dark">
									<a href="javascript:;" class="cut" ng-click="changePicture('logo')">更换</a>
									<a href="javascript:;" class="del" ng-click="delPicture('logo')"><i class="fa fa-times text-danger"></i></a>
								</div>
							</div>
							<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧。仅支持jpg格式</span>
						</div>
					</div>
					<div class="form-group" ng-show="editType == 'preview'">
						<label class="col-sm-2 control-label"> 模块封面</label>
						<div class="col-sm-10">
							<div class="we7-input-img" ng-class="{ 'active' : moduleOriginal.preview}"  style="width: 100px;height: 100px;">
								<img ng-src="{{ moduleOriginal.preview }}">
								<a href="javascript:;" class="input-addon" ng-click="changePicture('preview')"><span>+</span></a>
								<input type="hidden" name="thumb">
								<div class="cover-dark">
									<a href="javascript:;" class="cut" ng-click="changePicture('preview')">更换</a>
									<a href="javascript:;" class="del" ng-click="delPicture('preview')"><i class="fa fa-times text-danger"></i></a>
								</div>
							</div>
							<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置。仅支持jpg格式</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button  class="btn btn-primary" type="text" name="submit" ng-click="save()" data-dismiss="modal">保存</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<input type="hidden" name="token" value="c781f0df">
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	require(['fileUploader'], function() {
		angular.module('moduleApp').value('config', {
			'isFounder' : "<?php  if($_W['isfounder']) { ?>1<?php  } else { ?>2<?php  } ?>",
			'receive_ban' : "<?php  echo $receive_ban;?>",
			'show' : "<?php  echo $_GPC['show'];?>",
			'moduleInfo' : <?php  echo json_encode($module_info)?>,
			'url' : "<?php  echo url('module/manage-system/change_receive_ban')?>",
			'modulename' : "<?php  echo $module_info['name'];?>",
			'editModuleUrl' : "<?php  echo url('module/manage-system/get_module_info')?>",
			'saveModuleUrl' : "<?php  echo url('module/manage-system/save_module_info')?>",
			'checkReceiveUrl' : "<?php  echo url('module/manage-system/check')?>",
			'checkUpgradeUrl' : "<?php  echo url('module/manage-system/check_upgrade')?>",
			'get_upgrade_info_url' : "<?php  echo url('module/manage-system/get_upgrade_info')?>"
		});
		angular.bootstrap($('.js-system-module-detail'), ['moduleApp']);
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>