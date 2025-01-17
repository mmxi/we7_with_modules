<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="./resource/css/sweetalert.css">
<?php  if($do == 'mplist') { ?>
<style>
	.mpstatus span {cursor: pointer	}
</style>

<ul class="nav nav-tabs">
	<li class="pull-right"><a href="<?php  echo url('fournet/wxauth/mpadd')?>">添加公众号</a></li>
	<li class="active"><a href="javascript:void(0);">公众号列表</a></li>
</ul>
<div class="main">
	<div class="category">
		<form action="" method="post" onsubmit="return formcheck(this)">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead>
						<tr>
							<th>名称</th>
							<th>平台数量</th>
							<th>状态（点击修改）</th>
							<th>创建时间</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php  if(is_array($mplist)) { foreach($mplist as $v) { ?>
						<tr>
							<td>
								<div class="type-parent">
									<span class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php  echo $v['desc']?>"><?php  echo $v['name'];?></span>
								</div>
							</td>
							<td><span class="badge"><?php  echo $v['appnum'];?></span>
							</td>
							<td class="mpstatus">
								<span class="label label-<?php  if($v['is_yz'] == 1) echo 'success'; else echo 'danger';?>" onclick="window.location.href = '<?php  echo url('fournet/wxauth/mpjoin',array('id'=>$v['id']))?>'">
                                    <?php  if($v['is_yz'] == 1) echo '接入成功'; else echo '未接入';?>
                                </span>
								&nbsp;&nbsp;
								<span class="label tooltips disabled_nav label-<?php  if($v['status'] == 1) echo 'success'; else echo 'danger';?>" title="<?php  if($v['status'] == 1) echo '禁用'; else echo '启用';?>" data-toggle="tooltip" data-placement="bottom" data-href="<?php  echo url('fournet/wxauth/MpDisable', array('op' => 'disabled', 'id' => $v['id']))?>">
                                    <?php  if($v['status'] == 1) echo '使用中'; else echo '已禁用';?>
                                </span>
							</td>
							<td>
								<?php  echo date('Y-m-d H:i',$v['create_time'])?>
							</td>
							<td>
								<a href="<?php  echo url('fournet/wxauth/applist/list', array('id' => $v['id']))?>" class="btn btn-default btn-sm tooltips" data-toggle="tooltip" data-placement="bottom" title="管理平台"><i class="fa fa-anchor"></i></a>&nbsp;&nbsp;
								<a href="<?php  echo url('fournet/wxauth/mpedit', array('id' => $v['id']))?>" class="btn btn-default btn-sm tooltips" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
								<a href="<?php  echo url('fournet/wxauth/mpdel', array('id' => $v['id']))?>" class="btn btn-default btn-sm del_nav tooltips" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	require(['bootstrap'],function($){
		$('.tooltips').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
	$('.del_nav').click(function(){
		var url = $(this).attr('href');
		swal({
			title: "确定要删除吗？",
			text: "删除之后该公众号下的所有平台接入将会失效",
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function () {
			$.ajax({
				url: url,
				dataType:'json',
				success:function(res){
					swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
						if( CheckCode(res.Code,2) == 'success')
							window.location.href = '<?php  echo url('fournet/wxauth/mplist', array('op' => 'index'))?>';
					});
				},
				error:function(){ swal("Error", "请检查您的网络", "error"); }
			});
		});
		return false;
	});
	$('.disabled_nav').click(function(){
		var url = $(this).attr('data-href');
		var status = $(this).attr('data-original-title');
		swal({
			title: "确定要"+status+"吗？",
			text: "",
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function () {
			$.ajax({
				url: url,
				dataType:'json',
				success:function(res){
					swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
						if( CheckCode(res.Code,2) == 'success')
							window.location.href = '<?php  echo url('fournet/wxauth/mplist', array('op' => 'index'))?>';
					});
				},
				error:function(){ swal("Error", "请检查您的网络", "error"); }
			});
		});
		return false;
	});

</script>
<?php  } else if($do == 'mpadd') { ?>
<style>
	.nav-width{border-bottom:0;}
	.nav-width li.active{width:50%;text-align:center;overflow:hidden;height:40px;}
	.nav-width .normal{background:#EEEEEE;width:50%;text-align:center;overflow:hidden;height:40px;}
	.bg-self-1{background-color: rgba(228, 232, 234, 0.29); border: 2px solid rgba(33, 63, 80, 0.12);}
	.mp-info .row{height: 50px; line-height: 50px;}
	.mp-info em{font-weight: bold}
	.mpaddMain{width: 100%; clear: both; padding-top: 40px;}
	.mpaddMain a{margin-right: 15px}
</style>
<ul class="nav nav-tabs nav-width">
	<li class="active normal"><a href="javascript:;">1. 设置公众号信息</a></li>
	<li class="normal"><a href="javascript:;">2. 接入公众号</a></li>
</ul>

<div class="main">
	<form action="<?php  echo url('fournet/wxauth/mpadd')?>" method="post" class="form-horizontal form" id="mpadd-form">
		<div class="panel panel-default">
			<div class="panel-heading">设置公众号信息</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane  active" id="tab_basic">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>公众号名称：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="name" required class="form-control" maxlength="15" value="" />
								<span class="help-block">要接入的公众号的名称</span>
							</div>
						</div>
		                <div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">备注：</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="desc" rows="8" maxlength="100" placeholder=""></textarea>
		                        <span class="help-block"></span>
		                    </div>
		                </div>
						<div class="form-group col-sm-12">
							<input type="submit" name="submit" value="设置完成，下一步" class="btn btn-success" />
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="hidden" name="type" value="add" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="mpaddTab2" style="display: none">
		<div class="panel panel-default">
			<div class="panel-heading">接入公众号</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active mp-info">
						<h4 class="alert alert-danger">
							<br />
							您绑定的微信公众号：<em class="text-danger"></em>，请将以下信息填入微信公众平台中。
							<br />
							<br />
						</h4>
						<div class="row">
							<div class="bg-self-1 col-md-8">
								<div class="row">
									<div class="col-md-2 text-right"><em>URL：</em></div>
									<div class="col-md-10"></div>
								</div>
								<div class="row">
									<div class="col-md-2 text-right"><em>Token：</em></div>
									<div class="col-md-10"></div>
								</div>
								<div class="row">
									<div class="col-md-2 text-right"><em>EncodingAESKey：</em></div>
									<div class="col-md-10"></div>
								</div>
							</div>
						</div>

						<div class="mpaddMain">
							<a href="javascript:void(0);" class="btn btn-success mpjoin" style="color:#FFF"> 检测是否接入成功</a>
							<a href="javascript:void(0);" class="btn btn-primary applist" style="color:#FFF">暂不接入，先去查看管理功能</a>
							<a href="<?php  echo url('fournet/wxauth/mplist')?>" class="btn btn-info" style="color:#FFF">返回公众号列表</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	$('#mpadd-form').submit(function(){
		var post_data = $(this).serialize();
		var url = $(this).attr('action');
		$.ajax({
			type:'post',
			url: url,
			data: post_data,
			dataType:'json',
			success:function(res){
				if(CheckCode(res.Code) == 'Error'){
					swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){ });
				}else{
					$('#mpadd-form').slideToggle(500)
					$('.normal').eq(0).removeClass('active')
					$('.normal').eq(1).addClass('active')
					$('.mpaddTab2').slideToggle(500)
					$('.mp-info .row .col-md-10').eq(0).html(res.Data.url)
                    $('.mp-info .row .col-md-10').eq(1).html(res.Data.token)
					$('.mp-info .row .col-md-10').eq(2).html(res.Data.key)
					$('.mp-info h4 em').html(res.Data.name)
					$('.mpjoin').attr('href',res.Data.checkUrl)
					$('.applist').attr('href',res.Data.applistUrl)
				}
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); }
		});
		return false;
	});
	$('.mpjoin').click(function(){
		var url = $(this).attr('href');
		$(this).addClass('disabled').html('检测中');
		$.ajax({
			url: url,
			dataType:'json',
			success:function(res){
				swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
					if( CheckCode(res.Code,2) == 'success')
						window.location.href = '<?php  echo url('fournet/wxauth/mplist')?>';
				});
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); },
			complete:function(){
				$('.mpjoin').removeClass('disabled').html('检测是否接入成功');
			}
		});
		return false;
	});
</script>
<?php  } else if($do == 'mpedit') { ?>
<style>
	.nav-width{border-bottom:0;}
	.nav-width li.active{width:50%;text-align:center;overflow:hidden;height:40px;}
	.nav-width .normal{background:#EEEEEE;width:50%;text-align:center;overflow:hidden;height:40px;}
	.bg-self-1{background-color: rgba(228, 232, 234, 0.29); border: 2px solid rgba(33, 63, 80, 0.12);}
	.mp-info .row{height: 50px; line-height: 50px;}
	.mp-info em{font-weight: bold}
	.mpaddMain{width: 100%; clear: both; padding-top: 40px;}
	.mpaddMain a{margin-right: 15px}
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:void(0);">编辑公众号</a></li>
</ul>
<div class="main">
	<form action="<?php  echo url('fournet/wxauth/mpedit', array('op' => 'index','id' => $info['id']))?>" method="post" class="form-horizontal form" id="mpedit-form">
		<div class="panel panel-default">
			<div class="panel-heading">设置公众号信息</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane  active" id="tab_basic">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>公众号名称：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="name" required class="form-control" maxlength="15" value="<?php  echo $info['name'];?>" />
								<span class="help-block">要接入的公众号的名称</span>
							</div>
						</div>
		                <div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">备注：</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="desc" rows="8" maxlength="100" placeholder=""><?php  echo $info['desc'];?></textarea>
		                        <span class="help-block"></span>
		                    </div>
		                </div>
						<div class="form-group col-sm-12">
							<input type="submit" name="submit" value="确定修改" class="btn btn-success" />
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="hidden" name="type" value="edit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	$('#mpedit-form').submit(function(){
		var post_data = $(this).serialize();
		var url = $(this).attr('action');
		$.ajax({
			type:'post',
			url: url,
			data: post_data,
			dataType:'json',
			success:function(res){
				swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
					if( CheckCode(res.Code,2) == 'success')
						window.location.href = '<?php  echo url('fournet/wxauth/mplist', array('op' => 'index'))?>';
				});
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); }
		});
		return false;
	});
</script>

<?php  } else if($do == 'mpjoin') { ?>
<style>
	.bg-self-1{background-color: rgba(228, 232, 234, 0.29); border: 2px solid rgba(33, 63, 80, 0.12);}
	.mp-info .row{height: 50px; line-height: 50px;}
	.mp-info em{font-weight: bold}
	.mpaddMain{width: 100%; clear: both; padding-top: 40px;}
	.mpaddMain a{margin-right: 15px}
</style>

<div class="main">
	<div class="">
		<div class="panel panel-default">
			<div class="panel-heading">接入公众号</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active mp-info">
						<h4 class="alert alert-danger">
							<br />
							您绑定的微信公众号：<em class="text-danger"><?php  echo $info['name'];?></em>，请将以下信息填入微信公众平台中。
							<br />
							<br />
						</h4>
						<div class="row">
							<div class="bg-self-1 col-md-8">
								<div class="row">
									<div class="col-md-2 text-right"><em>URL：</em></div>
									<div class="col-md-10"><?php  echo $info['url'];?></div>
								</div>
								<div class="row">
									<div class="col-md-2 text-right"><em>Token：</em></div>
									<div class="col-md-10"><?php  echo $info['token'];?></div>
								</div>
								<div class="row">
									<div class="col-md-2 text-right"><em>EncodingAESKey：</em></div>
									<div class="col-md-10"><?php  echo $info['encodingaeskey'];?></div>
								</div>
								<div class="row">
									<div class="col-md-2 text-right"><em>接入状态：</em></div>
									<div class="col-md-10">
                                        <span class="label label-<?php  if($info['is_yz'] == 1) echo 'success'; else echo 'danger';?>">
                                            <?php  if($info['is_yz'] == 1) echo '接入成功'; else echo '未接入';?>
                                        </span>
									</div>
								</div>
							</div>
						</div>

						<div class="mpaddMain">
							<?php  if($info['is_yz'] == 0) { ?>
							<a href="<?php  echo url('fournet/wxauth/mpcheck',array('id'=>$info['id']))?>" class="btn btn-success mpjoin" style="color:#FFF"> 检测是否接入成功</a>
							<?php  } ?>
							<a href="<?php  echo url('fournet/wxauth/mplist')?>" class="btn btn-info" style="color:#FFF">返回公众号列表</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	$('.mpjoin').click(function(){
		var url = $(this).attr('href');
		$(this).addClass('disabled').html('检测中');
		$.ajax({
			url: url,
			dataType:'json',
			success:function(res){
				swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
					if( CheckCode(res.Code,2) == 'success')
						window.location.href = '<?php  echo url('fournet/wxauth/mplist', array('op' => 'index'))?>';
				});
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); },
			complete:function(){
				$('.mpjoin').removeClass('disabled').html('检测是否接入成功');
			}
		});
		return false;
	});
</script>
<?php  } else if($do == 'applist') { ?>
<style>
	.mpstatus span {cursor: pointer	}
</style>

<ul class="nav nav-tabs">
	<li class="pull-right"><a href="<?php  echo url('fournet/wxauth/appadd',array('id'=>$info['id']))?>">添加平台</a></li>
	<li class="active"><a href="javascript:void(0);"><?php  echo $info['name'];?>-平台列表</a></li>
</ul>
<div class="main">
	<div class="category">
		<form action="" method="post" onsubmit="return formcheck(this)">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead>
						<tr>
							<th>名称</th>
							<th>接口地址</th>
							<th>状态（点击修改）</th>
							<th>权重</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<?php  if(is_array($applist)) { foreach($applist as $v) { ?>
						<tr>
							<td>
								<div class="type-parent">
									<span class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php  echo $v['desc']?>"><?php  echo $v['name'];?></span>
								</div>
							</td>
							<td><?php  echo $v['url'];?>
							</td>
							<td class="mpstatus">
								<span class="label tooltips disabled_nav label-<?php  if($v['status'] == 1) echo 'success'; else echo 'danger';?>" title="<?php  if($v['status'] == 1) echo '禁用'; else echo '启用';?>" data-toggle="tooltip" data-placement="bottom" data-href="<?php  echo url('fournet/wxauth/AppDisable', array('op' => 'disabled', 'id' => $info['id'],'appid'=>$v['id']))?>">
                                    <?php  if($v['status'] == 1) echo '使用中'; else echo '已禁用';?>
                                </span>
							</td>
							<td>
								<?php  echo $v['sort'];?>
							</td>
							<td>
								<a href="<?php  echo url('fournet/wxauth/appedit', array('id' => $info['id'],'appid'=>$v['id']))?>" class="btn btn-default btn-sm tooltips" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
								<a href="<?php  echo url('fournet/wxauth/appdel', array('id' => $info['id'],'appid'=>$v['id']))?>" class="btn btn-default btn-sm del_nav tooltips" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php  } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	require(['bootstrap'],function($){
		$('.tooltips').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
	$('.del_nav').click(function(){
		var url = $(this).attr('href');
		swal({
			title: "确定要删除吗？",
			text: "",
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function () {
			$.ajax({
				url: url,
				dataType:'json',
				success:function(res){
					swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
						if( CheckCode(res.Code,2) == 'success')
							window.location.href = '<?php  echo url('fournet/wxauth/applist', array('op' => 'index','id'=>$info['id']))?>';
					});
				},
				error:function(){ swal("Error", "请检查您的网络", "error"); }
			});
		});
		return false;
	});
	$('.disabled_nav').click(function(){
		var url = $(this).attr('data-href');
		var status = $(this).attr('data-original-title');
		swal({
			title: "确定要"+status+"吗？",
			text: "",
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function () {
			$.ajax({
				url: url,
				dataType:'json',
				success:function(res){
					swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
						if( CheckCode(res.Code,2) == 'success')
							window.location.href = '<?php  echo url('fournet/wxauth/applist', array('op' => 'index','id'=>$info['id']))?>';
					});
				},
				error:function(){ swal("Error", "请检查您的网络", "error"); }
			});
		});
		return false;
	});

</script>
<?php  } else if($do == 'appadd') { ?>
<style>
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:void(0);"><?php  echo $info['name'];?> + 添加平台</a></li>
</ul>

<div class="main">
	<form action="<?php  echo url('fournet/wxauth/appadd', array('op' => 'index'))?>" method="post" class="form-horizontal form" id="appadd-form">
		<div class="panel panel-default">
			<div class="panel-heading">添加平台</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane  active" id="tab_basic">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>平台名称：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="name" required class="form-control" maxlength="15" value="" />
								<span class="help-block">要添加的平台的名称</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>Url：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="url" name="url" required class="form-control" value="" />
								<span class="help-block">请填写平台对接url</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>Token：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="tokens" required class="form-control" value="" />
								<span class="help-block">请填写平台生成的Token</span>
							</div>
						</div>
						<!--<div class="form-group">-->
							<!--<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>EncodingAESKey：</label>-->
							<!--<div class="col-xs-12 col-sm-8">-->
								<!--<input type="text" name="encodingaeskey" required class="form-control" maxlength="15" value="" />-->
								<!--<span class="help-block">请填写平台生成的EncodingAESKey</span>-->
							<!--</div>-->
						<!--</div>-->
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">权重：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="number" name="sort" required class="form-control" max="100" min="0" value="50" />
								<span class="help-block">设置平台处理消息的优先级(可填写值为0-100)</span>
							</div>
						</div>
		                <div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">备注：</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="desc" rows="8" maxlength="100" placeholder=""></textarea>
		                        <span class="help-block"></span>
		                    </div>
		                </div>
						<div class="form-group col-sm-12">
							<input type="submit" name="submit" value="完成添加" class="btn btn-success" />
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="hidden" name="type" value="add" />
							<input type="hidden" name="id" value="<?php  echo $info['id'];?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	$('#appadd-form').submit(function(){
		var post_data = $(this).serialize();
		var url = $(this).attr('action');
		$.ajax({
			type:'post',
			url: url,
			data: post_data,
			dataType:'json',
			success:function(res){
				swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
					if( CheckCode(res.Code,2) == 'success')
						window.location.href = '<?php  echo url('fournet/wxauth/applist', array('op' => 'index','id'=>$info['id']))?>';
				});
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); }
		});
		return false;
	});
</script>
<?php  } else if($do == 'appedit') { ?>
<style>
</style>
<ul class="nav nav-tabs">
	<li class="active"><a href="javascript:void(0);"><?php  echo $info['name'];?> - 编辑平台</a></li>
</ul>

<div class="main">
	<form action="<?php  echo url('fournet/wxauth/appedit', array('op' => 'index'))?>" method="post" class="form-horizontal form" id="appedit-form">
		<div class="panel panel-default">
			<div class="panel-heading">添加平台</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane  active" id="tab_basic">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>平台名称：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="name" required class="form-control" maxlength="15" value="<?php  echo $appInfo['name'];?>" />
								<span class="help-block">要添加的平台的名称</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>Url：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="url" name="url" required class="form-control" value="<?php  echo $appInfo['url'];?>" disabled />
								<span class="help-block">请填写平台对接url</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>Token：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="token" required class="form-control" value="<?php  echo $appInfo['token'];?>" disabled />
								<span class="help-block">请填写平台生成的Token</span>
							</div>
						</div>
						<!--<div class="form-group">-->
							<!--<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label"><span style="color:red">*</span>EncodingAESKey：</label>-->
							<!--<div class="col-xs-12 col-sm-8">-->
								<!--<input type="text" name="encodingaeskey" required class="form-control" maxlength="15" value="<?php  echo $appInfo['encodingaeskey'];?>" disabled />-->
								<!--<span class="help-block">请填写平台生成的EncodingAESKey</span>-->
							<!--</div>-->
						<!--</div>-->
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">权重：</label>
							<div class="col-xs-12 col-sm-8">
								<input type="number" name="sort" required class="form-control" max="100" min="0" value="<?php  echo $appInfo['sort'];?>" />
								<span class="help-block">设置平台处理消息的优先级(可填写值为0-100)</span>
							</div>
						</div>
		                <div class="form-group">
		                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">备注：</label>
		                    <div class="col-sm-8 col-xs-12">
		                        <textarea class="form-control" name="desc" rows="8" maxlength="100" placeholder=""><?php  echo $appInfo['desc'];?></textarea>
		                        <span class="help-block"></span>
		                    </div>
		                </div>
						<div class="form-group col-sm-12">
							<input type="submit" name="submit" value="完成修改" class="btn btn-success" />
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="hidden" name="type" value="edit" />
							<input type="hidden" name="id" value="<?php  echo $info['id'];?>" />
							<input type="hidden" name="appid" value="<?php  echo $appInfo['id'];?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="./resource/js/sweetalert.min.js"></script>
<script src="./resource/js/public.js"></script>
<script>
	$('#appedit-form').submit(function(){
		var post_data = $(this).serialize();
		var url = $(this).attr('action');
		$.ajax({
			type:'post',
			url: url,
			data: post_data,
			dataType:'json',
			success:function(res){
				swal({title:CheckCode(res.Code),text: res.Message,type: CheckCode(res.Code,2)},function(){
					if( CheckCode(res.Code,2) == 'success')
						window.location.href = '<?php  echo url('fournet/wxauth/applist', array('op' => 'index','id'=>$info['id']))?>';
				});
			},
			error:function(){ swal("Error", "请检查您的网络", "error"); }
		});
		return false;
	});
</script>
<?php  } else if($do == 'static') { ?>
<style>
    .account-stat{overflow:hidden; color:#666;}
    .account-stat .account-stat-btn{width:100%; overflow:hidden;}
    .account-stat .account-stat-btn > div{text-align:center; margin-bottom:5px;margin-right:2%; float:left;width:23%; height:80px; padding-top:10px;font-size:16px; border-left:1px #DDD solid;}
    .account-stat .account-stat-btn > div:first-child{border-left:0;}
    .account-stat .account-stat-btn > div > span{display:block; font-size:30px; font-weight:bold}
    .account-stat .account-stat-btn > div p{width: 50%;font-weight:bold;float: left;margin: 0 0 5px;position: relative}
    .span-color{    width: 30px; height: 3px;  position: absolute; top: 45%;}
    .span-text{margin-left: 35px;overflow: hidden}
</style>
<div class="page-header">
    <h4><i class="fa fa-android"></i> 应用服务统计</h4>
</div>
<div class="panel panel-default" style="padding:2em;">
    <nav role="navigation" class="navbar navbar-default navbar-static-top" id="clear" style="margin: -1em -1em 1em -1em;">
        <div class="container-fluid">
            <ul class="nav navbar-nav nav-btns">
                <?php  if(is_array($mplist)) { foreach($mplist as $v) { ?>
                <li class="app-select"><a href="javascript:;" data-id="<?php  echo $v['id'];?>"><?php  echo $v['name'];?></a></li>
                <?php  } } ?>
            </ul>
        </div>
    </nav>

    <div class="account-stat">
        <div class="account-stat-btn">
            <div>总服务次数<span id="rule">0</span></div>
            <div>今日服务次数<span id="today">0</span></div>
            <div>本月服务次数<span id="month">0</span></div>
            <div style="height: 100%" class="app_info_color">
            </div>
        </div>
    </div>

    <div style="margin-top:20px;" id="myChartParent">
        <canvas id="myChart" height="80"></canvas>
    </div>
</div>

<script>
    require(['chart'], function(c) {
        var label = '';
        var lineChartData = null;
        var obj = null;
        var data = null;
        var datasets = new Array();
        $('.app-select').click(function(){
            $('.app-select').each(function(i){
                $('.app-select').eq(i).removeClass('active')
            })
            $(this).addClass('active')
            $.post(location.href, {'mp' : $('a',$(this)).data('id')}, function(data){
                var myLine = new Chart(document.getElementById("myChart").getContext("2d"));
                $('.app_info_color').html('');
                data = $.parseJSON(data);

                $("#rule").html(data.stat.rule);
                $("#today").html(data.stat.today);
                $("#month").html(data.stat.month);
                var datasets = new Array();
                if(data.value == null){
                        var tmp_color = GetRandomNum(20,150) + ',' + GetRandomNum(20,255) + ',' + GetRandomNum(20,255);
                        datasets[0] = {
                            fillColor: "rgba(" + tmp_color + ",0.1)",
                            strokeColor: "rgba(" + tmp_color + ",1)",
                            pointColor: "rgba(" + tmp_color + ",1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(" + tmp_color + ",1)",
                            data: [0, 0, 0, 0, 0, 0, 0]
                        }
                }else{
                    for(var i = 0,l = data.value.length;i < l; i ++){
                        var tmp_color = GetRandomNum(20,255) + ',' + GetRandomNum(20,255) + ',' + GetRandomNum(20,255);
                        datasets[i] = {
                            fillColor : "rgba("+tmp_color+",0.1)",
                            strokeColor : "rgba("+tmp_color+",1)",
                            pointColor : "rgba("+tmp_color+",1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba("+tmp_color+",1)",
                            data : data.value[i].data
                        }
                        $('.app_info_color').append('<p><span class="span-color" style="background: rgba('+tmp_color+',1)"></span><span class="span-text" style="color: rgba('+tmp_color+',1)">'+data.value[i].name+'</span></p>')

                    }
                }

                lineChartData = {
                    labels : data.key,
                    datasets : datasets
                }
                obj = myLine.Line(lineChartData, {responsive: true});
            });
        });
        $('.app-select').eq(0).addClass('active').click();
        function GetRandomNum(Min,Max)
        {
            var Range = Max - Min;
            var Rand = Math.random();
            return(Min + Math.round(Rand * Range));
        }
    });
</script>
<?php  } else if($do == 'help') { ?>
<div class="main">
    <?php  if($_W['isfounder']) { ?> <form class="form-horizontal form" action="" method="post"><?php  } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            微信公众号多平台接入
        </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            ① 添加一个公众号
        </div>
        <div class="panel-body">
            <div class="form-group clearfix">
                <ul>
                    <li>进入微信平台后，点击接入平台 -> 添加公众号 -> 输入公众号名称</li>
                    <li>获得生成后的接入信息后，将生成的信息对应填写到微信公众平台中（跟绑定公众号一样的）</li>
                    <li>在微信公众平台添加成功后，回到微信平台，可在界面中点击检测是否接入成功验证</li>
                </ul>
            </div>
        </div>
		<div class="panel-heading">
            ② 添加一个平台
        </div>
		<div class="panel-body">
            <div class="form-group clearfix">
                <ul>
                    <li>公众号接入成功后，点击管理平台 -> 添加平台 -> </li>
                    <li>添写平台名称和平台生成的Url，Token -> 点击完成添加</li>
                    <li>平台Url，Token 指平台如微米添加完一个公众号后生成的接入Url，Token 微米的用户在后台首页-管理公众号-API接口 即可看见）</li>
					<li>（权重 默认为50 权重是指多个平台如果出现重复消息处理的优先级 权重越高优先级越高）</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>