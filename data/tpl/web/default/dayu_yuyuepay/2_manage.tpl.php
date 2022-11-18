<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  load()->func('tpl')?>
<style>
.account-basicinformation span{font-weight:700;}
.account-stat-num > {padding:10px;}
.account-stat-num > a{width:16.666%; float:left; font-size:16px; text-align:center;padding:10px 0 5px;}
.account-stat-num > a.active{background-color:#0288d1;color:#fff;}
.account-stat-num > a span{display:block; font-size:20px; font-weight:bold; color:#ef6c00;}
.account-stat-num > a.active span, .account-stat-num > a.active dd{color:#fff;}
.account-stat-num > a dd{display:block;font-size:14px; font-weight:bold; color:#666;}
.account-stat-num > a dd i{font-size:18px;}
</style>
<?php  if($reid) { ?>
<script type="text/javascript" src="<?php echo TEMPLATE_WEUI;?>select/bootstrap-select.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_WEUI;?>select/bootstrap-select.css">
<script type="text/javascript">
	$(window).on('load', function () {
		$('.selectpicker').selectpicker({
			'selectedText': 'cat'
		});
//		$('.selectpicker').selectpicker('hide');
	});
</script>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('display')?>">返回主题列表</a></li>
	<li class="active">
	<a href="<?php  echo $this->createWebUrl('manage', array('id' => $reid))?>">所有记录</a>
	</li>
</ul>

<div class="main">
	<div class="panel panel-info">
		<div class="panel-body" style="padding:0;">
			<div class="account-stat-num row">
				<a <?php  if($status == '0' && $paystatus == '1') { ?> class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 0, 'paystatus' => 1, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					未付 <?php  echo($this->get_status_name($reid,'0'))?> <dd><?php  echo $order_count_confirm;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_confirm['sum_money'];?></span>
				</a>
				<a <?php  if($status == '0' && $paystatus == '2') { ?>class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 0, 'paystatus' => 2, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					已付 <?php  echo($this->get_status_name($reid,'0'))?><dd><?php  echo $order_count_pay;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_pay['sum_money'];?></span>
				</a>
				<a <?php  if($status == '1' && $paystatus == '2') { ?>class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 1, 'paystatus' => 2, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					已付 <?php  echo($this->get_status_name($reid,'1'))?><dd><?php  echo $order_count_finish;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_finish['sum_money'];?></span>
				</a>
				<a <?php  if($status == '2') { ?>class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 2, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					<?php  echo($this->get_status_name($reid,'9'))?> / <?php  echo($this->get_status_name($reid,'2'))?><dd><?php  echo $order_count_cancel;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_cancel['sum_money'];?></span>
				</a>
				<a <?php  if($status == '3') { ?>class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 3, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					<?php  echo($this->get_status_name($reid,'3'))?><dd><?php  echo $order_count_end;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_end['sum_money'];?></span>
				</a>
				<a <?php  if($status == '7') { ?>class="active"<?php  } ?> href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'status' => 7, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">
					<?php  echo($this->get_status_name($reid,'7'))?><dd><?php  echo $order_count_refund;?> 条</dd><span><i class="fa fa-cny"></i> <?php  echo $sum_price_refund['sum_money'];?></span>
				</a>
			</div>
		</div>
	</div>
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" id="activity" class="form-horizontal form" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="dayu_yuyuepay" />
                <input type="hidden" name="do" value="manage" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-3 col-lg-1 control-label">主题</label>
				<div class="col-sm-8 col-lg-7">
				<select name="id" id="id" class="form-control">
					<option>选择预约主题</option>
					<?php  if(is_array($zhuti)) { foreach($zhuti as $val) { ?>
						<option value="<?php  echo $val['reid'];?>" <?php  if($val['reid']==$reid) { ?>selected="selected"<?php  } ?>><?php  echo $val['title'];?></option>
					<?php  } } ?>
				</select>
				</div>                  
			</div>
            </form>
            <form action="./index.php" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="dayu_yuyuepay" />
                <input type="hidden" name="do" value="manage" />
                <input type="hidden" name="id" value="<?php  echo $reid;?>" />
                <input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>" />
                <input type="hidden" name="paystatus" value="<?php  echo $_GPC['paystatus'];?>" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-3 col-lg-1 control-label">搜索条件</label>
				<div class="col-xs-12 col-sm-9 col-lg-9">
					<div class="input-group">
						<span class="input-group-addon">手机号/姓名</span><input class="form-control" name="keywords" id="" type="text" value="<?php  echo $_GPC['keywords'];?>" placeholder="可查询手机号 / 姓名">
						<span class="input-group-addon">单号/微信单号</span><input class="form-control" name="orderid" id="" type="text" value="<?php  echo $_GPC['orderid'];?>" placeholder="可查询订单号 / 微信订单号"> 
					</div>
				</div>                  
			</div>
			<?php  if(pdo_tableexists('dayu_yuyuepay_plugin_store_store') && !empty($setting['store'])) { ?>
                <div class="form-group">
                    <label for="lunchBegins" class="col-xs-12 col-sm-3 col-md-1 control-label">选择店铺</label>
                    <div class="col-xs-12 col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">支持模糊搜索 店名或店铺ID</span>
							<select id="lunchBegins" name="storeid" class="selectpicker show-tick form-control" data-live-search="true" data-live-search-style="begins">
								<option value="" <?php  if($s['id']=='') { ?>selected<?php  } ?>>全部</option>
								<?php  if(is_array($store)) { foreach($store as $s) { ?>
								<option value="<?php  echo $s['id'];?>" <?php  if($s['id']==$_GPC['storeid']) { ?>selected<?php  } ?>><?php  echo $s['title'];?> (ID:<?php  echo $s['id'];?>)</option>
								<?php  } } ?>
							</select>
						</div>
                    </div>
                </div>
			<?php  } ?>
                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-3 col-lg-1 control-label">预约日期</label>
                    <div class="col-xs-12 col-sm-9 col-lg-9">
                        <div class='btn-group input-group'>
						<?php  if($activity['is_time']==2) { ?>
                        <?php  echo tpl_field_date('yytime',$yytime,$activity['is_time'])?>
						<?php  } else { ?>
                        <?php  echo tpl_form_field_daterange('yytime',array('starttime'=>date('Y-m-d', $stime),'endtime'=>date('Y-m-d', $etime)))?>
						<?php  } ?>
                        <span class="btn btn-danger"><i class="fa fa-clock-o"></i> 提交时间</span>
                        <?php  echo tpl_form_field_daterange('time',array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)), true)?>
                        <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                        <input type="submit" name="export" value="导出匹配的数据" class="btn btn-primary">
                        <a class="btn btn-default <?php  if($status == '') { ?>btn-warning<?php  } ?>" href="<?php  echo $this->createWebUrl('manage', array('id' => $reid, 'yytime' => $yytime, 'time[start]' => $_GPC['time']['start'], 'time[end]' => $_GPC['time']['end'], 'keywords' => $_GPC['keywords'], 'orderid' => $_GPC['orderid']))?>">全部 <span class="fa fa-cny"> <?php  echo $sum_price_all['sum_money'];?></span> <span class="badge"><?php  echo $order_count_all;?></span></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
			<form method="post" class="form-horizontal" id="form1">
	<div class="panel panel-info">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
                    <thead class="navbar-inner2">
                        <tr>
							<th style="width:30px;text-align:center;">删</th>
                            <th style="width:60px;text-align:center;">粉丝</th>
                            <th style="width:120px;">姓名</th>
                            <th style="width:120px;">手机</th>
                            <th style="width:150px;"><?php  echo $par['xmname'];?></th>
                            <th style="width:150px;" class="text-center">提交/预约时间</th>
                            <th class="text-center" style="width:80px;">处理状态</th>
							<th style="width:150px;">订单号</th>
							<th style="width:120px;">付款状态/方式</th>
							<th style="width:120px;">支付单号<small>点击复制</small></th>
                            <th style="width:120px;" class="text-right">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
							<td style="text-align:center;"><input type="checkbox" name="recordid[]" value="<?php  echo $row['rerid'];?>" class=""></td>
							<td>
								<?php  if(!empty($row['openid'])) { ?><span class="text-info" style="text-align:center;"><a href="<?php  echo url('mc/member/post', array('uid'=>$row['user']['uid']));?>" target="_blank"><img src="<?php  if(!empty($row['user']['tag']['avatar'])) { ?><?php  echo $row['user']['tag']['avatar'];?><?php  } else { ?>resource/images/noavatar_middle.gif<?php  } ?>" width="48" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs" title="<?php  echo $row['user']['nickname'];?>"></a></span><?php  } ?>
							</td>
							<td class="row-hover"><a href="javascript:;" title="<?php  echo $row['from_user'];?>"><?php  echo $row['member'];?></a></td>
							<td class="row-hover"><?php  echo $row['mobile'];?></td>
							<td>
								<?php  if(!empty($row['sid'])) { ?>
									<span class="btn btn-xs btn-success status" style="margin-bottom:2px;"><?php  echo $row['store']['name'];?></span><br>
								<?php  } ?>
								<span class="btn btn-primary btn-xs">
									<?php  echo $row['xm']['title'];?> <?php  if($row['price']!='0.00') { ?>
									<span class="badge"><i class="fa fa-cny"></i> <?php  echo $row['price'];?></span><?php  } ?>
								</span>
							</td>
							<td class="text-center">
								<small><?php  echo date('Y-m-d H:i:s', $row['createtime']);?></small><br>
								<small style="color:#ce0000;"><?php  if($activity['is_time']==0) { ?><?php  echo date('Y-m-d H:i', $row['yuyuetime']);?><?php  } else if($activity['is_time']==2) { ?><?php  echo $row['restime'];?><?php  } ?></small>
							</td>
							<td class="text-center">
								<span class="btn btn-sm status <?php  echo $row['status']['css2'];?>"><?php  echo $row['status']['name'];?></span>
							</td>
							<td><small><?php  echo $row['ordersn'];?></small></td>
							<td>
								<?php  if($row['paystatus'] == 1) { ?><span class="btn btn-xs btn-warning">未支付</span><?php  } ?>
								<?php  if($row['paystatus'] == 2 && $row['price'] != '0.00') { ?><span class="btn btn-xs btn-danger">已支付</span><?php  } ?>
								<span class="btn btn-xs btn-<?php  echo $row['css'];?>"><?php  echo $row['paytype'];?></span>
								<?php  if($row['paydetail']) { ?><span class="btn btn-xs btn-danger">券</span><?php  } ?>
							</td>
							<td title="点击可直接复制单号" style="position:relative;"><a class="js-clip" href="javascript:;" data-url="<?php  echo $row['transid'];?>"><small><?php  echo $row['transid'];?></small></a></td>
                            <td class="text-right">
								<a href="<?php  echo $this->createWebUrl('detail', array('id' => $row['rerid']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="查看详情">详情</a>
								<a href="<?php  echo $this->createWebUrl('dayu_yuyuepaydelete', array('id' => $row['rerid']))?>"  class="btn btn-default btn-sm" onclick="return confirm('删除预约记录，此操作不可恢复，确认删除？');return false;" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
							</td>
                        </tr>
                        <?php  } } ?>
						<tr>
							<td style="text-align:center;"><input type="checkbox" name="" onclick="var ck = this.checked;$(':checkbox').each(function(){this.checked = ck});"></td>
							<td colspan="10">
								<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
								<a data="<?php  echo $activity['state2'];?>" class="btn btn-success" onclick="setstatus(this,<?php  echo $reid;?>,'1')">审核订单</a>
								<a data="<?php  echo $activity['state3'];?>" class="btn btn-success" onclick="setstatus(this,<?php  echo $reid;?>,'3')">完成订单</a>
								<a data="<?php  echo $activity['state4'];?>" class="btn btn-success" onclick="setstatus(this,<?php  echo $reid;?>,'2')">关闭订单</a>
								<a data="已退款" class="btn btn-warning" onclick="setstatus(this,<?php  echo $reid;?>,'7')">已退款</a>
								<a class="btn btn-danger pull-right" onclick="delarr(this,<?php  echo $reid;?>)">删除选中的记录</a>
							</td>
						</tr>
                    </tbody>
                </table>
			</div>
		</div>
	</form>
	<?php  echo $pager;?>
</div>
<script language='javascript'>
	function selectall(obj, name){
		$('input[name="'+name+'[]"]:checkbox').each(function() {
			$(this).get(0).checked =  $(obj).get(0).checked;
		});
	}
	require(['bootstrap'],function($){
		$('.btn').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});
	});
	$("#id").change(function(){		
		$("#activity").submit();
	});
</script>
<script>
    function message(msg){
        require(['util'],function(util){
            util.message(msg);
        });
    }
	function delarr(obj,reid) {
		if($(":checkbox[name='recordid[]']:checked").size() > 0){
			var check = $(":checkbox[name='recordid[]']:checked");
			var rerid = new Array();
			check.each(function(i){
				rerid[i] = $(this).val();
			});
			if(confirm("确认要删除选择的记录?")){
				$.post('<?php  echo $this->createWebUrl('batchrrcord')?>', {idArr:rerid,reid:reid}, function(s) {
					if(s.message.status == 1) {
						message(s.message.msg, '', 'success');
						setTimeout(function() {
							location.reload();
							return;
						}, 1000)
					} else {
						message(s.message.msg, '', 'error');
					}
				},"json");
			}
		}else{
			message('没有选择要删除记录', '', 'error');
			return false;
		}
	}
	function setstatus(obj,reid,state) {
		if($(":checkbox[name='recordid[]']:checked").size() > 0){
			var check = $(":checkbox[name='recordid[]']:checked");
			var rerid = new Array();
			check.each(function(i){
				rerid[i] = $(this).val();
			});
			if(confirm("确认批量更新状态为："+obj.getAttribute("data"))){
				$.post('<?php  echo $this->createWebUrl('setstatus')?>', {idArr:rerid,reid:reid,state:state}, function(s) {
					if(s.message.status == 1) {
						message(s.message.msg, '', 'success');
						setTimeout(function() {
							location.reload();
							return;
						}, 1000)
					} else {
						message(s.message.msg, '', 'error');
					}
				},"json");
			}
		}else{
			message('请选择要更新状态的记录', '', 'error');
			return false;
		}
	}
</script>
<?php  } else { ?>

    <div class="panel panel-info">
        <div class="panel-heading">请选择预约主题</div>
        <div class="panel-body">
            <form action="./index.php" method="get" id="activity" class="form-horizontal" role="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="dayu_yuyuepay" />
                <input type="hidden" name="do" value="manage" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 control-label">主题</label>
				<div class="col-sm-8 col-lg-6">
				<select name="id" id="id" class="form-control">
							<option>选择预约主题</option>
					<?php  if(is_array($zhuti)) { foreach($zhuti as $val) { ?>
							<option value="<?php  echo $val['reid'];?>" <?php  if($val['reid']==$reid) { ?>selected="selected"<?php  } ?>><?php  echo $val['title'];?></option>
					<?php  } } ?>
				</select>
				</div>                  
			</div>
            </form>
        </div>
    </div>
<script>
	$("#id").change(function(){		
		$("#activity").submit();
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
