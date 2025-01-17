<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">
	入口设置
</div>
<ul class="we7-page-tab">
	<?php  if(!empty($module['isrulefields'])) { ?><li><a href="<?php  echo url('platform/reply', array('m' => $module['name']));?>">关键字链接入口 </a></li><?php  } ?>
	<?php  if(!empty($frames['section']['platform_module_common']['menu']['platform_module_cover'])) { ?>
	<li class="active"><a href="<?php  echo url('platform/cover', array('m' => $module['name'], 'eid' => $entry_id));?>">封面链接入口</a></li>
	<?php  } ?>
</ul>
<div id="js-keyword-display">
<?php  if($do == 'module') { ?>
	<div ng-controller="KeywordDisplay" ng-cloak>
		<table class="table we7-table table-hover vertical-middle">
			<col width="150px"/>
			<col width="200px" />
			<col width="" />
			<col width="250px" />
			<tr>
				<th>二维码</th>
				<th class="text-left">入口名称</th>
				<th>关键字</th>
				<th class="text-right">操作</th>
			</tr>
			<?php  if(is_array($entries['cover'])) { foreach($entries['cover'] as $menu) { ?>
			<tr>
				<td data-url="<?php  echo $_W['siteroot'];?>app/<?php  echo $menu['url'];?>" data-size="100" class="js-url-qrcode"> 
					<div class="qrcode-block"><canvas></canvas></div>
				</td>
				<td class="text-left"><?php  echo $menu['title'];?></td>
				<td>
					<?php  if(is_array($menu['cover']['rule']['keywords'])) { foreach($menu['cover']['rule']['keywords'] as $kw) { ?>
					<span class="form-control-static keyword-tag" data-toggle="tooltip" data-placement="bottom" title="<?php  if($kw['type']==1) { ?>等于<?php  } else if($kw['type']==2) { ?>包含<?php  } else if($kw['type']==3) { ?>正则<?php  } ?>"><?php  echo $kw['content'];?></span>&nbsp;
					<?php  } } ?>
				</td>
				<td>
					<div class="link-group" style="position:relative;">
						<a href="<?php  echo url('platform/cover/post', array('m' => $modulename, 'eid' => $menu['eid']));?>" class="color-default">编辑</a>
						<a href="javascript:;" data-url="<?php  echo $_W['siteroot'];?>app/<?php  echo $menu['url'];?>" style="margin-right:0px;" class="color-default js-clip">复制链接</a>
					</div>
				</td>
			</tr>
			<?php  } } ?>
		</table>
	</div>
<?php  } else if($do == 'post') { ?>
<!--二维码-->
<div class="panel we7-panel">
	<div class="panel-heading">
		直接链接 
	</div>
	<div class="panel-body  we7-form we7-padding">
		<div class="form-group">
			<label for="" class="control-label col-sm-2">直接URL</label>
			<div class="form-controls col-sm-8">
				<input type="text" class="form-control" readonly="readonly" name="url_show" value="<?php  echo $reply['url_show'];?>">
				<span class="help-block">直接指向到入口的URL。您可以在自定义菜单（有oAuth权限）或是其它位置直接使用。 </span>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2">二维码</label>
			<div data-url="<?php  echo $reply['url_show'];?>" data-size="150" class="js-url-qrcode">
				<div class="qrcode-block"><canvas></canvas></div>
			</div>
		</div>
	</div>
</div>
<!--end二维码-->
<div class="we7-form" id="js-reply-form" ng-controller="KeywordReply" ng-cloak>
	<form id="reply-form" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="entry_id" value="<?php  echo $entry_id;?>" />
	<input type="hidden" name="keywords">
	<table class="we7-table table-hover">
		<col width="530px"/>
		<col />
		<col width="150px"/>
		<tr>
			<th>关键字</th>
			<th>触发类型</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="keyword in reply.entry.keywords">
			<td ng-bind="keyword.content"></td>
			<td>
				<span ng-if="keyword.type == 1">精准触发</span>
				<span ng-if="keyword.type == 2">包含关键字触发</span>
				<span ng-if="keyword.type == 3">正则匹配关键字触发</span>
			</td>
			<td>
				<div class="link-group">
					<a href="javascript:;" class="del" ng-click="delKeyword(keyword)">删除</a>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="new-keyword" ng-click="showAddkeywordModal()">
				<a class="color-gray add-new-keyword" href="javascript:;">
					<span class="add-icon"><i class="wi wi-plus"></i></span>
					<span class="text">添加关键字</span>
				</a>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="addkeywordModal" tabindex="-1" role="dialog" aria-labelledby="addkeywordsModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addkeywordsModalLabel">添加关键字</h4>
				</div>
				<div class="modal-body" ng-style="{'height': '335px'}">
					<div class="form-group">
						<label class="control-label col-sm-3">触发关键字</label>
						<div class="form-controls col-sm-8">
							<input type="radio" id="radio1" name="radio" ng-model="newKeyword.type" value="1" ng-click="changeKeywordType(1)"/>
							<label for="radio1" ng-click="changeKeywordType(1)">精准触发</label>
							<input type="radio" id="radio2" name="radio" ng-model="newKeyword.type" value="2" ng-click="changeKeywordType(2)"/>
							<label for="radio2" ng-click="changeKeywordType(2)">包含关键字触发</label>
							<input type="radio" id="radio3" name="radio" ng-model="newKeyword.type" value="3" ng-click="changeKeywordType(3)"/>
							<label for="radio3" ng-click="changeKeywordType(3)">正则匹配关键字触发</label>
						</div>
					</div>
					<div class="form-group" ng-show="newKeyword.type == 1">
						<label for="" class="control-label col-sm-3"></label>
						<div class="form-controls input-group col-sm-6">
							<input type="text" class="keyword-input form-control" max="30" id="keyword-exact" ng-model="newKeyword.content" ng-blur="checkKeyWord($event);" data-type="keyword">
							<span class="help-block">&nbsp;</span>
							<span class="input-group-btn"><a href="javascript:;" class="btn btn-default" id="emoji-exact" ng-init="initEmotion();" style="position:absolute;top:0px"><i class="fa fa-github-alt" style="font-size:14px;"></i> 表情</a></span>
						</div>
					</div>
					<div class="form-group" ng-show="newKeyword.type == 2">
						<label for="" class="control-label col-sm-3"></label>
						<div class="form-controls input-group col-sm-6">
							<input type="text" class="keyword-input form-control" max="30" id="keyword-indistinct" ng-model="newKeyword.content" ng-blur="checkKeyWord($event);" data-type="keyword">
							<span class="help-block">&nbsp;</span>
							<span class="input-group-btn"><a href="javascript:;" class="btn btn-default" id="emoji-indistinct" style="position:absolute;top:0px"><i class="fa fa-github-alt" style="font-size:14px;"></i> 表情</a></span>
						</div>
					</div>
					<div class="form-group" ng-show="newKeyword.type == 3">
						<label for="" class="control-label col-sm-3"></label>
						<div class="form-controls input-group col-sm-6">
							<input type="text" class="keyword-input form-control" max="30" id="keyword-regexp" ng-model="newKeyword.content" ng-blur="checkKeyWord($event);" data-type="keyword">
							<span class="help-block">&nbsp;</span>
						</div>
					</div>
					<div class="form-controls col-sm-offset-3">
						<span class="help-block" ng-hide="newKeyword.type == 1 || newKeyword.type == 2">
							用户进行交谈时，对话内容符合述关键字中定义的模式才会执行这条规则。<br/>
							注意：如果你不明白正则表达式的工作方式，请不要使用正则匹配<br/>
							注意：正则匹配使用MySQL的匹配引擎，请使用MySQL的正则语法<br/>
							示例：<br/>
							^微信匹配以“微信”开头的语句<br/>
							微信$匹配以“微信”结尾的语句<br/>
							^微信$匹配等同“微信”的语句<br/>
							微信匹配包含“微信”的语句<br/>
							[0-9.-]匹配所有的数字，句号和减号<br/>
							^[a-zA-Z_]$所有的字母和下划线<br/>
							^[[:alpha:]]{3}$所有的3个字母的单词<br/>
							^a{4}$aaaa<br/>
							^a{2,4}$aa，aaa或aaaa<br/>
							^a{2,}$匹配多于两个a的字符串<br/>
						</span>
						<span class="help-block" ng-hide="newKeyword.type == 3">多个关键字请使用逗号隔开，如天气，今日天气</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary" ng-click="addNewKeyword()">确定</button>
				</div>
			</div>
		</div>
	</div>

	<div class="we7-form">

		<div class="form-group">
			<label for="" class="control-label col-sm-2">&nbsp;</label>
			<div class="form-controls color-default col-sm-10 text-right">
				<a href="javascript:void(0);" ng-click="changeShowAdvance()"><span ng-show="!reply.showAdvance">展开</span><span ng-show="reply.showAdvance">收起</span>高级设置<i class="fa fa-chevron-down" ng-class="{'fa-chevron-down': !reply.showAdvance, 'fa-chevron-up': reply.showAdvance}"></i></a>
			</div>
		</div>
		<div class="panel we7-panel" ng-show="reply.showAdvance">
			<div class="panel-body we7-padding" style="background-color: #f4f6f9;">
				<input type="hidden" name="rid" value="<?php  echo $rid;?>" />
				<div class="form-group" ng-show="reply.showAdvance">
					<label for="" class="control-label col-sm-2">规则名称</label>
					<div class="form-controls col-sm-8">
						<input type="text" class="form-control" placeholder="请输入回复规则的名称" name="rulename" value="<?php  echo $reply['title'];?>">
						<span class="help-block">您可以给这组触发关键字规则起一个名字, 方便下次修改和查看. </span>
					</div>
				</div>
				<div class="form-group" ng-show="reply.showAdvance">
					<label for="" class="control-label col-sm-2">全局置顶</label>
					<div class="form-controls col-sm-8">
						<input id="istop-1" type="radio" name="istop" ng-model="reply.entry.istop" ng-value="1" value="1" <?php  if(intval($reply['displayorder'] >= 255)) { ?> checked="checked"<?php  } ?>/>
						<label for="istop-1" >是</label>
						<input id="istop-2" type="radio" name="istop" ng-model="reply.entry.istop" ng-value="0" value="0" <?php  if(intval($reply['displayorder'] < 255)) { ?> checked="checked"<?php  } ?>/>
						<label for="istop-2">否</label>
					</div>

				</div>
				<div class="form-group" ng-show="reply.entry.istop == 0 && reply.showAdvance">
					<label for="" class="control-label col-sm-2">回复优先级</label>
					<div class="form-controls col-sm-4">
					<input type="number" min="0" max="254" name="displayorder_rule" value="<?php  if(intval($reply['rule']['displayorder']) < 255) { ?><?php  echo $reply['rule']['displayorder'];?><?php  } ?>" placeholder="输入这条回复规则的优先级" class="form-control">
					<span class="help-block">
						规则优先级，越大则越靠前，最大不得超过254
					</span>
					</div>
				</div>
				<div class="form-group" ng-show="reply.showAdvance">
					<label for="" class="control-label col-sm-2">是否开启</label>
					<div class="form-controls col-sm-8">
						<label>
							<input name="status" class="form-control" ng-model="reply.status" ng-hide="1">
							<div class="switch" ng-class="{'switchOn': reply.status}" ng-click="changeStatus()"></div>
						</label>
						<span class="help-block">您可以选择临时禁用这条回复.</span>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="form-group">
		<nav class="navbar navbar-wxapp-bottom navbar-fixed-bottom" role="navigation">
			<div class="container">
				<div class="pager">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input type="submit" name="submit" value="发布" class="reply-form-submit hidden">
					<span value="发布" class="btn btn-primary" ng-click="submitForm()">发布</span>
				</div>
			</div>
		</nav>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-sm-2">封面</label>
		<div class="form-controls col-sm-8">
			<?php  echo tpl_form_field_image('thumb', $reply['thumb'], '', array('width' => 400));?>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-sm-2">描述</label>
		<div class="form-controls col-sm-8">
			<textarea class="form-control" placeholder="添加图文消息的简短描述" name="description"><?php  echo $reply['description'];?></textarea>
		</div>
	</div>
	</form>
</div>
<?php  } ?>
</div>
<script type="text/javascript">
	$(function() {
		require(['jquery.qrcode'], function(){
			$('.js-url-qrcode').each(function(){
				url = $(this).data('url');
				$(this).find('.qrcode-block').html('').qrcode({
					render: 'canvas',
					width: $(this).data('size'),
					height: $(this).data('size'),
					text: url
				});
			});
		});
		$('.js-clip').each(function(){
			util.clip(this, $(this).data('url'));
		});
	});
	require(['underscore'], function() {
		angular.module('replyFormApp').value('config', {
			replydata: <?php  echo json_encode($reply['rule'])?>,
			uniacid: <?php  echo json_encode($_W['uniacid'])?>,
			links: {
				postUrl: "<?php  echo url('platform/reply/post', array('m' => $_GPC['m']));?>",
			},
		});
		angular.bootstrap($('#js-keyword-display'), ['replyFormApp']);
	});

	window.validateReplyForm = function(key) {
		return true;
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>