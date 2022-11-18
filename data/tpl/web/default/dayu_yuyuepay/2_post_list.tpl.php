<?php defined('IN_IA') or exit('Access Denied');?>	<div class="panel panel-default">
		<div class="panel-heading">参数设置 <span style="color:red;">蓝色按钮为激活状态</span></div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">首页列表显示</label>
				<div class="col-xs-12 col-sm-9">
					<label class="radio-inline"><input type="radio" name="is_list" value="1" <?php  if($activity['is_list'] == 1) { ?> checked="checked"<?php  } ?> onclick="$('#is_list').show();" /> 显示</label>
					<label class="radio-inline"><input type="radio" name="is_list" value="0" <?php  if($activity['is_list'] == 0) { ?> checked="checked"<?php  } ?> onclick="$('#is_list').hide();" /> 隐藏</label>
				</div>
			</div>
			<div id="is_list"<?php  if($activity['is_list'] == 0) { ?> style="display:none"<?php  } ?>>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">列表显示简短标题</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="subtitle" value="<?php  echo $activity['subtitle'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">主题列表页图标</label>
                    <div class="col-xs-12 col-sm-9">
                         <?php  echo tpl_form_field_image('icon',$activity['icon']);?>
	        			<span class="help-block">四方形图标，80像素左右即可</span>
                    </div>
                </div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">请选择首页分类：</label>
				<div class="col-sm-9">
						<select class="form-control" name="cate">
								<option value="0" <?php  if($activity['cid']=='0') { ?> selected="selected"<?php  } ?>>无分类</option>
							<?php  if(is_array($category)) { foreach($category as $row) { ?>
								<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $activity['cid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
							<?php  } } ?>
						</select>
				</div>
			</div>
		</div>
	</div>