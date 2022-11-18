<?php defined('IN_IA') or exit('Access Denied');?><div class="panel panel-warning">
	<div class="panel-heading">参数设置 <span style="color:red;">蓝色按钮为激活状态</span></div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">微站首页展示</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">					  
					<label class="btn btn-default <?php  if($activity['inhome'] == 1) { ?>active<?php  } ?>"><input type="radio" name="inhome" value="1" <?php  if($activity['inhome'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
					<label class="btn btn-default <?php  if($activity['inhome'] == 0) { ?>active<?php  } ?>"><input type="radio" name="inhome" value="0" <?php  if(empty($activity) || $activity['inhome'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					<span class="btn btn-success" disabled>是否在微站中显示此表单链接</span>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用状态</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default <?php  if($activity['status'] == 1) { ?>active<?php  } ?>"><input type="radio" name="status" value="1" <?php  if($activity['status'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
					<label class="btn btn-default <?php  if($activity['status'] == 0) { ?>active<?php  } ?>"><input type="radio" name="status" value="0" <?php  if(empty($activity) || $activity['status'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					<span class="btn btn-success" disabled>关闭状态下前台无法访问</span>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">在线支付设置</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">
                	<label class="btn btn-default <?php  if($activity['pay'] == 1) { ?>active<?php  } ?>"><input type="radio" name="pay" value="1" <?php  if($activity['pay'] == 1) { ?> checked="checked"<?php  } ?> />在线 + 线下</label>
		 			<label class="btn btn-default <?php  if($activity['pay'] == 2) { ?>active<?php  } ?>"><input type="radio" name="pay" value="2" <?php  if(empty($activity['pay']) || $activity['pay'] == 2) { ?> checked="checked"<?php  } ?> />仅在线支付</label>
						<span class="btn btn-success" disabled>支付参数设置：功能选项 -> 支付参数</span>
				</div>
				<span class="btn btn-info"><a href="./index.php?c=profile&a=payment&" target="_blank" style="color:#fff;">线下汇款设置</a></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码核销</label>
				<div class="col-sm-9 col-xs-12">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default <?php  if($activity['code'] == 1) { ?>active<?php  } ?>"><input type='radio' name='code' value='1' <?php  if($activity['code']==1) { ?>checked<?php  } ?> />启用</label>
					<label class="btn btn-default <?php  if($activity['code'] == 0) { ?>active<?php  } ?>"><input type='radio' name='code' value='0' <?php  if($activity['code']==0) { ?>checked<?php  } ?> />关闭</label>
						<span class="btn btn-success" disabled>启用状态，用户端预约详情可出示二维码，客服使用微信扫一扫即可更新预约状态</span>
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否需要关注</label>
				<div class="col-sm-9 col-xs-12">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default <?php  if($activity['follow'] == 1) { ?>active<?php  } ?>"><input type='radio' name='follow' value='1' <?php  if($activity['follow']==1) { ?>checked<?php  } ?> />启用</label>
					<label class="btn btn-default <?php  if($activity['follow'] == 0) { ?>active<?php  } ?>"><input type='radio' name='follow' value='0' <?php  if($activity['follow']==0) { ?>checked<?php  } ?> />关闭</label>
						<span class="btn btn-success" disabled>启用状态，用户在未关注公众号情况下自动跳转至二维码关注引导页</span>
				</div>
				</div>
			</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户删除记录权限</label>
					<div class="col-sm-9 col-xs-12">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default <?php  if($activity['isdel'] == 1) { ?>active<?php  } ?>"><input type="radio" name="isdel" value="1" <?php  if($activity['isdel'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
						<label class="btn btn-default <?php  if($activity['isdel'] == 0) { ?>active<?php  } ?>"><input type="radio" name="isdel" value="0" <?php  if(empty($activity) || $activity['isdel'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
						<span class="btn btn-success" disabled>启用状态，用户可自行删除待受理情况下的记录</span>
                    </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">修改预约内容</label>
					<div class="col-sm-9 col-xs-12">
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($par['edit'] == 1) { ?>active<?php  } ?>"><input type="radio" name="edit" value="1" <?php  if($par['edit'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
						<label class="btn btn-default <?php  if($par['edit'] == 0) { ?>active<?php  } ?>"><input type="radio" name="edit" value="0" <?php  if($par['edit'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
						<span class="btn btn-success" disabled><span class="text-danger">【<?php  echo($this->get_status_name($reid,'8'))?>】</span>状态，用户是否支持修改</span>
                    </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">可使用的会员组</label>
					<div class="col-sm-9 col-xs-12">
						<select class="form-control" multiple="multiple" name="group[]">
							<?php  if($group) { ?>
							<?php  if(is_array($group)) { foreach($group as $li) { ?>
							<option value="<?php  echo $li['groupid'];?>" <?php  if($li['groupid_select'] == '1') { ?>selected<?php  } ?>><?php  echo $li['title'];?></option>
							<?php  } } ?>
							<?php  } ?>
						</select>
					<span class="help-block">留空即所有用户均可提交，按住CTRL可多选</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">每人可预约次数</label>
					<div class="col-xs-12 col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">0 不限制次数</span><input type="text" class="form-control" name="pretotal" value="<?php  echo $activity['pretotal'];?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">每人每天可预约次数</label>
					<div class="col-xs-12 col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">0 不限制次数</span><input type="text" class="form-control" name="daynum" value="<?php  echo $activity['daynum'];?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">提交总次数</label>
					<div class="col-xs-12 col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">0 不限制次数</span><input type="text" class="form-control" name="allnum" value="<?php  echo $par['allnum'];?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
