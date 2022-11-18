<?php defined('IN_IA') or exit('Access Denied');?><div class="panel panel-warning">
	<div class="panel-heading">高级参数 <span style="color:red;">蓝色按钮为激活状态</span></div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-3 control-label">服务项目数量+时间段人数限制</label>
				<div class="col-xs-12 col-sm-9">
				<div class="btn-group" data-toggle="buttons">					  
					<label class="btn btn-default <?php  if($activity['restrict'] == 1) { ?>active<?php  } ?>"><input type="radio" name="restrict" value="1" <?php  if($activity['restrict'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
					<label class="btn btn-default <?php  if($activity['restrict'] == 0) { ?>active<?php  } ?>"><input type="radio" name="restrict" value="0" <?php  if(empty($activity) || $activity['restrict'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
				</div>
					<span class="help-block" style="color:red;">将服务项目数量纳入预约人数限制</span>
					<span class="help-block" style="color:red;">此项属性必须使用【时间段预约人数限制】</span>
				</div>
			</div>
			<?php  if($setting['role']==1 && ($_W['role'] == 'founder' || $_W['role'] == 'manager')) { ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-3 control-label">后台管理分权</label>
					<div class="col-xs-12 col-sm-6">
						<select class="form-control" multiple="multiple" name="role[]">
							<?php  if(is_array($permission)) { foreach($permission as $row) { ?>
							<option value="<?php  echo $row['user']['uid'];?>" <?php  if($row['select'] == '1') { ?>selected<?php  } ?>><?php  echo $row['user']['username'];?></option>
							<?php  } } ?>
						</select>
					<span class="help-block">按住CTRL可多选</span>
					</div>
				</div>
			<?php  } ?>
	</div>
</div>
