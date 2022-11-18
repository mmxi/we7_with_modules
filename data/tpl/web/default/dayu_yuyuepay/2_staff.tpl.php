<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.require{color:red;}
	.info{padding:6px;width:400px;margin:-20px auto 3px auto;text-align:center;}
</style>
<?php  if($reid) { ?>
<div class="alert alert-info info">
	<i class="fa fa-info-circle"></i>
	<a href="<?php  echo $this->createWebUrl('post', array('id' => $_GPC['reid']))?>">【编辑】主题: <?php  echo $activity['title'];?></a>
</div>
<?php  } ?>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('display')?>">返回预约主题列表</a></li>
	<li<?php  if($op == 'list') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('staff', array('op' => 'list','reid' => $_GPC['reid']))?>">客服列表</a></li>
	<li<?php  if($op == 'post' && !$id) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('staff', array('op' => 'post','reid' => $_GPC['reid']))?>">添加客服</a></li>
	<?php  if($id) { ?><li class="active"><a href="#">编辑客服</a></li><?php  } ?>
	<li><a href="<?php  echo $this->createWebUrl('item', array('op' => 'list','reid' => $_GPC['reid']))?>"><?php  echo $par['xmname'];?>管理</a></li>
</ul>
<?php  if($op == 'post') { ?>
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="reid" value="<?php  echo $reid;?>">
		<input type="hidden" name="weid" value="<?php  echo $weid;?>">
		<div class="main">
			<div class="panel panel-default">
				<div class="panel-heading">添加客服</div>
				<div class="panel-body">
					<div id="tpl">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>微信昵称</label>
							<div class="col-sm-9 col-xs-12">
								<div class="input-group">
									<input type="text" name="nickname" class="form-control">
									<div class="input-group-btn">
										<span class="btn btn-success btn-openid">检 测</span>
									</div>
								</div>
								<div class="help-block">请填写微信昵称。系统根据微信昵称获取该商家对应公众号的粉丝openid</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require"> </span>粉丝编号</label>
							<div class="col-sm-9 col-xs-12">
								<div class="input-group">
									<input type="text" name="openid" class="form-control" value="" placeholder="粉丝编号">
									<div class="input-group-btn">
										<span class="btn btn-success btn-openid">检 测</span>
									</div>
								</div>
								<div class="help-block">请填写粉丝编号。系统根据微信编号获取该商家对应公众号的粉丝昵称。<a href="/web/index.php?c=mc&a=fans&" target="_blank">openid：粉丝管理中的粉丝编号</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-xs-9 col-md-9">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
				</div>	
			</div>
		</div>
	</form>
	<script type="text/javascript">
		require(['util'], function(u){
			$('#post-add').click(function(){
				$('#tpl-container').append($('#tpl').html());
			});
		});
	</script>
<script type="text/javascript">
	$('.btn-openid').click(function(){
		var nickname = $.trim($(':text[name="nickname"]').val());
		var openid = $.trim($(':text[name="openid"]').val());
		if(!nickname && !openid) {
			util.message('请输入昵称或者openid');
			return false;
		}
		var param = {
			'nickname':nickname,
			'openid':openid
		};
		$.post("<?php  echo $this->createWebUrl('post', array('op' => 'verify'))?>", param, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno < 0) {
				util.message(data.message.message);
				return false;
			}
			$(':text[name="openid"]').val(data.message.message.openid);
			$(':text[name="nickname"]').val(data.message.message.nickname);
		});
		return false;
	});
</script>
<?php  } else if($op == 'list') { ?>
	<style type="text/css">
		.status-toggle{cursor:pointer;}
	</style>
	<div class="main">
		<div class="panel panel-info">
			<div class="panel-heading">筛选</div>
			<div class="panel-body">
				<form action="./index.php" method="get" class="form-horizontal" role="form">
					<input type="hidden" name="c" value="site">
					<input type="hidden" name="a" value="entry">
					<input type="hidden" name="m" value="dayu_yuyuepay">
					<input type="hidden" name="do" value="staff"/>
					<input type="hidden" name="op" value="list"/>
					<input type="hidden" name="reid" value="<?php  echo $_GPC['reid'];?>">
					<div class="form-group clearfix">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">客服</label>
						<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
							<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
						</div>
						<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
							<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php  if($reid) { ?>
			<div class="alert alert-info" style="width:100%:">
				<?php  if($activity['guanli'] == 0) { ?>
					<a class="btn btn-warning pull-right" href="javascript:void(0);" onclick="change('<?php  echo $reid;?>','guanli','1')">切换为 多管理员</a>
				<h4>点击 <i class="fa fa-dot-circle-o" style="font-size:2rem"></i> 设置为管理员</h4> <i class="fa fa-check-square-o" style="font-size:2rem"></i> 为微信端管理员，<i class="fa fa-dot-circle-o" style="font-size:2rem"></i> 为普通客服，只接收通知，无管理权限
				<?php  } else if($activity['guanli'] == 1) { ?>
					<a class="btn btn-success" href="javascript:void(0);" onclick="change('<?php  echo $reid;?>','guanli','0')">切换为 单管理员多客服</a>
				<?php  } ?>
			</div>
		<?php  } else { ?>
				<div class="alert alert-info" style="width:100%:">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>此客服为接收用户注册通知，</h4>
				</div>
		<?php  } ?>
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th width="80px">管理员</th>
								<th>客服</th>
								<th><a href="/web/index.php?c=mc&a=fans&" target="_blank">openid：粉丝管理中的粉丝编号</a></th>
								<th>归属</th>
								<th style="width:80px; text-align:right;">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
							<tr <?php  if($item['openid'] == $activity['kfid']) { ?>style="background-color:#fff8e1;"<?php  } ?>>
								<input type="hidden" name="ids[]" value="<?php  echo $item['id'];?>">
								<input type="hidden" name="weid[]" value="<?php  echo $weid;?>">
								<td>
				<?php  if($item['openid'] != $activity['kfid'] && $reid && $activity['guanli']=='0') { ?>
					<a class="btn" href="javascript:void(0);" onclick="change('<?php  echo $item['reid'];?>','kfid','<?php  echo $item['openid'];?>')" title="设置 <?php  echo $item['nickname'];?> 为微信端管理员"><i class="fa fa-dot-circle-o" style="font-size:3rem"></i></a>
				<?php  } else if(($item['openid'] === $activity['kfid'] && $reid) || $activity['guanli']=='1') { ?>
					<span class="btn" title="微信端管理员"><i class="fa fa-check-square-o" style="font-size:3rem"></i></span>
				<?php  } ?></td>
								<td><input type="text" name="nickname[]" class="form-control" value="<?php  echo $item['nickname'];?>"></td>
								<td><input type="text" name="openid[]" class="form-control" value="<?php  echo $item['openid'];?>"></td>
								<td><input type="text" class="form-control" value="<?php  if($reid) { ?><?php  echo $activity['title'];?><?php  } else { ?>注册通知<?php  } ?>" disabled></td>
								<td style="text-align:right;">
									<a href="<?php  echo $this->createWebUrl('staff', array('op' => 'staffdel', 'id' => $item['id'], 'reid' => $_GPC['reid']))?>" class="btn btn-default btn-sm" title="删除" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('删除客服，确定删除吗?')) return false;"><i class="fa fa-times"> </i></a>
								</td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-xs-9 col-md-9">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input name="submit" id="submit" type="submit" value="批量修改" class="btn btn-primary">
				</div>	
			</div>
			<?php  echo $pager;?>
		</form>
	</div>
<script>
	require(['bootstrap'],function($){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
</script>
	<script>
	    function change(id, field, change){
	    	$.post(
	    			'<?php  echo $this->createWebUrl("changecheckedAjax")?>',
	    	        {"id":id, "field":field, "change":change},
	    	        function (data){
	    	        	location.reload();
	    	        }
	    	);
	    }
	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>