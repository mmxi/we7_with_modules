<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.account-basicinformation span{font-weight:700;}
.account-stat-num > div{width:16.6666%; float:left; font-size:16px; text-align:center;}
.account-stat-num > div span{display:block; font-size:30px; font-weight:bold;}
.account-stat-num > div dd{display:block; font-size:20px; font-weight:bold; color:#ef6c00;}
.account-stat-num > div dd i{font-size:18px;}
.col-md-6{padding:0;}
.col-md-6 .account-stat-num > div{width:33.333%; float:left; font-size:16px; text-align:center;}
.today span{color:#e53935;}
</style>
<div class="row">
 <div class="col-md-6">
<div class="panel panel-default" style="width:99%;">
	<div class="panel-heading">
		本月订单
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>全部订单<span><?php  echo $by;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $by_price_all['sum_money'];?></dd></div>
			<div>已付款<span><?php  echo $by_0;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $by_price_0['sum_money'];?></dd></div>
			<div>已完成<span><?php  echo $by_1;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $by_price_1['sum_money'];?></dd></div>
		</div>
	</div>
</div></div>
 <div class="col-md-6">
<div class="panel panel-default" style="width:99%;float:right;">
	<div class="panel-heading">
		上月订单
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>全部订单<span><?php  echo $sy;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $sy_price_all['sum_money'];?></dd></div>
			<div>已付款<span><?php  echo $sy_0;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $sy_price_0['sum_money'];?></dd></div>
			<div>已完成<span><?php  echo $sy_1;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $sy_price_1['sum_money'];?></dd></div>
		</div>
	</div>
</div></div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		今日订单
	</div>
	<div class="panel-body">
		<div class="account-stat-num row today">
			<div>全部订单<span><?php  echo $today;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_all['sum_money'];?></dd></div>
			<div>未付款待确认<span><?php  echo $today_0;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_0['sum_money'];?></dd></div>
			<div>已付款待确认<span><?php  echo $today_1;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_1['sum_money'];?></dd></div>
			<div>已付款已确认<span><?php  echo $today_2;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_2['sum_money'];?></dd></div>
			<div>已取消/拒绝<span><?php  echo $today_3;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_3['sum_money'];?></dd></div>
			<div>已完成<span><?php  echo $today_4;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $today_price_4['sum_money'];?></dd></div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		昨日订单
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>全部订单<span><?php  echo $yesterday;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_all['sum_money'];?></dd></div>
			<div>未付款待确认<span><?php  echo $yesterday_0;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_0['sum_money'];?></dd></div>
			<div>已付款待确认<span><?php  echo $yesterday_1;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_1['sum_money'];?></dd></div>
			<div>已付款已确认<span><?php  echo $yesterday_2;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_2['sum_money'];?></dd></div>
			<div>已取消/拒绝<span><?php  echo $yesterday_3;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_3['sum_money'];?></dd></div>
			<div>已完成<span><?php  echo $yesterday_4;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $yesterday_price_4['sum_money'];?></dd></div>
		</div>
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		所有订单
	</div>
	<div class="panel-body">
		<div class="account-stat-num row">
			<div>全部订单<span><?php  echo $all;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_all['sum_money'];?></dd></div>
			<div>未付款待确认<span><?php  echo $all_0;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_0['sum_money'];?></dd></div>
			<div>已付款待确认<span><?php  echo $all_1;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_1['sum_money'];?></dd></div>
			<div>已付款已确认<span><?php  echo $all_2;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_2['sum_money'];?></dd></div>
			<div>已取消/拒绝<span><?php  echo $all_3;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_3['sum_money'];?></dd></div>
			<div>已完成<span><?php  echo $all_4;?></span><dd><i class="fa fa-rmb"></i> <?php  echo $all_price_4['sum_money'];?></dd></div>
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>