<?php defined('IN_IA') or exit('Access Denied');?><div class="panel panel-warning">
	<div class="panel-heading">消费相关</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">奖励：</label>
				<div class="col-xs-12 col-sm-9">
				<div class="input-group">
					<span class="input-group-addon">每消费1元返</span><input type="number" class="form-control" name="credit" value="<?php  echo $par['credit'];?>" /><span class="input-group-addon">积分，0 不返</span>
				</div>
				</div>
			</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知设置：</label>
					<div class="col-xs-12 col-sm-9">
						<a target="_blank" class="btn btn-success col-lg-3" href="/web/index.php?c=mc&a=tplnotice" />点击我  填写【会员积分变更模板】</a>
					</div>
				</div>
	</div>
</div>
