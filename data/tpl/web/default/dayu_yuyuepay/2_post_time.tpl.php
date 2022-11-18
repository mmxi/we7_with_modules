<?php defined('IN_IA') or exit('Access Denied');?>        <div class="panel panel-info">
            <div class="panel-heading">
                时间设置
            </div>
            <div class="panel-body table-responsive">
                <div class="alert-new">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:#ff0000;">预约时间设置</label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
		 				<label class="radio-inline"><input type="radio" name="is_time" value="0" <?php  if(empty($activity) || $activity['is_time'] == 0) { ?> checked="checked"<?php  } ?> onclick="$('#time').show();" /> 普通时间</label>
		 				<label class="radio-inline"><input type="radio" name="is_time" value="2" <?php  if(empty($activity) || $activity['is_time'] == 2) { ?> checked="checked"<?php  } ?> onclick="$('#time').show();" /> 时间段预约人数限制</label>
                		<label class="radio-inline"><input type="radio" name="is_time" value="1" <?php  if($activity['is_time'] == 1) { ?> checked="checked"<?php  } ?> onclick="$('#time').hide();" /> 关闭(我要自己设置)</label>
                    </div>
					</div>
                </div>
			<div id="times"<?php  if($activity['is_time'] == 1 || $activity['is_time'] == 0) { ?> style="display:none"<?php  } ?>>
			 	<div class="form-group">
			 		<label class="col-xs-12 col-sm-3 col-md-2 control-label">预约时间段</label>
			 		<div class="col-xs-12 col-sm-9">
						<span class="help-block">选中表示可预约</span>
				 		<input type="hidden" name="srvtime" class="srvtime" value="<?php  echo htmlspecialchars($activity['srvtime'])?>">
			 		</div>
			 	</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">启用状态<?php  echo $par['today'];?></label>
					<div class="col-xs-12 col-sm-9">
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($par['today'] == 1) { ?>active<?php  } ?>"><input type="radio" name="today" value="1" <?php  if($par['today'] == 1) { ?> checked="checked"<?php  } ?> >不可预约当天</label>
						<label class="btn btn-default <?php  if($par['today'] == 0) { ?>active<?php  } ?>"><input type="radio" name="today" value="0" <?php  if($par['today'] == 0) { ?> checked="checked"<?php  } ?>>可预约当天</label>
					</div>
					</div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">可预约天数范围</label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<input type="text" class="form-control" name="day" value="<?php  echo $activity['day'];?>" />
						<span class="input-group-addon">/天</span>
                    </div>
							<div class="help-block">如果设置6天并周六周日不选中，那么1、2、3、4、5、8日可预约，6、7日是周六周日自动排除</div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:#ff0000;">时间显示方式</label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
		 				<label class="radio-inline"><input type="radio" name="timelist" value="1" <?php  if($activity['timelist'] == 1) { ?> checked="checked"<?php  } ?> /> weui九宫格</label>
                		<label class="radio-inline"><input type="radio" name="timelist" value="0" <?php  if($activity['timelist'] == 0) { ?> checked="checked"<?php  } ?> /> 列表</label>
                		<label class="radio-inline"><input type="radio" name="timelist" value="2" <?php  if($activity['timelist'] == 2) { ?> checked="checked"<?php  } ?> /> 九宫格</label>
                    </div>
					</div>
                </div>
					<div id="remove">
						<div id="remove-tpl">
						<?php  if(!empty($remove)) { ?>
						    <?php  if(is_array($remove)) { foreach($remove as $key => $f) { ?>
                <div class="form-group remove-item">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排除的日期</label>
                   <div class="col-sm-9 col-xs-4 col-md-3">
							<input type="text" onclick="showtime(this,<?php  echo $key;?>);" name="remove[]" id="datetime<?php  echo $key;?>" class="datetimepicker dayu form-control" value="<?php  echo $f;?>" readonly/>
                    </div>
					<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">
						<a href="javascript:;" onclick="delhouritem(this);"><i class="fa fa-times-circle" title="删除日期"> </i></a>
					</div>	
                </div>
						    <?php  } } ?>
						<?php  } ?>
						</div>
					</div>
				<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
							<a href="javascript:;" id="remove-add" class="btn btn-success"><i class="fa fa-plus-circle"></i> 添加排除的日期</a>
							<div class="help-block">排除的日期前台不可预约，用于节假日休息使用</div>
						</div>
					</div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排除时间段</label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周一</span><input type="text" class="form-control" name="out1" value="<?php  echo $activity['out1'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周二</span><input type="text" class="form-control" name="out2" value="<?php  echo $activity['out2'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周三</span><input type="text" class="form-control" name="out3" value="<?php  echo $activity['out3'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周四</span><input type="text" class="form-control" name="out4" value="<?php  echo $activity['out4'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周五</span><input type="text" class="form-control" name="out5" value="<?php  echo $activity['out5'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周六</span><input type="text" class="form-control" name="out6" value="<?php  echo $activity['out6'];?>" />
                    </div>
					</div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    	<span class="input-group-addon">周日</span><input type="text" class="form-control" name="out7" value="<?php  echo $activity['out7'];?>" />
                    </div>
					</div>
                </div>
			</div>
		</div>
		</div>
		</div>