<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="panel panel-cut" id="js-module-display" ng-controller="userModuleDisplayCtrl" ng-cloak>
	<div class="panel-heading">
		<i class="wi wi-apply" style="font-size: 24px; margin-right: 10px; vertical-align:middle;"></i>请选择您要操作的应用【选择公众号后才可以选择以下程序】
	</div>
	<div class="panel-body" >
		<div class="we7-page-search cut-header">
			<div class="cut-search">
				<div class="input-group pull-left">
					<input class="form-control" name="keyword" ng-model="searchKeyword" type="text" placeholder="请输入应用名称" ng-keypress="searchKeywordModule()">
					<span class="input-group-btn"><button class="btn btn-default button" ng-click="searchKeywordModule()"><i class="fa fa-search"></i></button></span>
				</div>
			</div>
		</div>
		<ul class="letters-list">
			<li ng-repeat="letter in alphabet" ng-style="{'background-color': letter == activeLetter ? '#ddd' : 'none'}" ng-class="{'active': letter == activeLetter}" ng-click="searchLetterModule(letter)">
				<a href="javascript:;" ng-bind="letter"></a>
			</li>
		</ul>
		<div class="cut-list" infinite-scroll='loadMore()'>
			<!--应用-->
			<div class="item module-list-item" ng-repeat="list in userModule" ng-if="userModule">
				<div class="content">
					<img ng-src="{{list.logo}}" class="icon" onerror="this.src='./resource/images/nopic-107.png'">
					<div class="name text-over" ng-bind="list.title"></div>
				</div>
				<div class="version">
					<span class="name">支持</span>
					<div class="version-detail">
						<span ng-if="list.app_support == 2">公众号</span>
						<span ng-if="list.app_support == 2 && list.wxapp_support == 2">、</span>
						<span ng-if="list.wxapp_support == 2">小程序</span>
					</div>
				</div>
				<div class="mask">
					<a ng-href="./index.php?c=module&a=display&do=switch&module_name={{list.name}}" class="entry">
						<div>进入应用 <i class="wi wi-angle-right"></i></div>
					</a>
					<a href="javascript:;" class="cut-btn stick" ng-click="showAccounts($event, list.name)">
						<i class="wi wi-changing-over"></i>
					</a>
					<!-- <a href="{{links.rank}}&uniacid={{list.uniacid}}" class="stick" title="置顶">
						<i class="wi wi-stick-sign"></i>
					</a> -->
				</div>
				<div class="cut-select" ng-mouseleave="hideSelect($event)" ng-show="list.accounts">
					<div class="arrow-left"></div>
					<div class="cut-item">
						<a href="javascript:;">
							<div class="detail" ng-repeat="account in list.accounts" ng-if="list.accounts">
								<div class="text-over text-left" ng-if="account.app_name"><span class="wi wi-wechat"></span>{{account.app_name}}</div>
								<div class="text-over text-left" ng-if="account.wxapp_name"><span class="wi wi-small-routine"></span>{{account.wxapp_name}}</div>
								<a class="cut-select-mask" href="./index.php?c=module&a=display&do=switch&module_name={{list.name}}&uniacid={{account.uniacid}}&version_id={{account.version_id}}" ng-if="account.version_id">
									<div class="entry">选择进入 <i class="wi wi-angle-right"></i></div>
								</a>
								<a class="cut-select-mask" href="./index.php?c=module&a=display&do=switch&module_name={{list.name}}&uniacid={{account.uniacid}}" ng-if="!account.version_id">
									<div class="entry">选择进入 <i class="wi wi-angle-right"></i></div>
								</a>
							</div>
							<div class="detail" ng-if="!list.accounts">
								<div class="text-over text-center">暂无数据</div>
							</div>
						</a>
					</div>
					<!-- <div class="cut-select-pager">
						<a href="{{links.more_version}}&uniacid={{list.uniacid}}" class="more color-default">更多 >></a>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('moduleApp').value('config', {
		'userModule': <?php echo !empty($user_module) ? json_encode($user_module) : 'null'?>,
		'activeLetter': <?php echo !empty($_GPC['letter']) ? json_encode($_GPC['letter']) : 'null'?>,
		'links': {
			'moduleAccounts': "<?php  echo url('module/display/have_permission_uniacids')?>",
			'getallLastSwitch': "<?php  echo url('module/display/getall_last_switch')?>",
		}
	});
	angular.bootstrap($('#js-module-display'), ['moduleApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>