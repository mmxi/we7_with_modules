<?php defined('IN_IA') or exit('Access Denied');?>

		 <div class="panel panel-default">
            <div class="panel-heading">领取会员卡</div>
            <div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员卡限制</label>
					<div class="col-sm-9 col-xs-12">
					<div class="btn-group" data-toggle="buttons">
						<?php  if(pdo_tableexists('dayu_card_fields')) { ?>
						<label class="btn btn-default <?php  if($activity['iscard'] == 2) { ?>active<?php  } ?>"><input type="radio" name="iscard" value="2" <?php  if($activity['iscard'] == 2) { ?> checked="checked"<?php  } ?> >【<?php  echo $modules['dayu_card']['title'];?>领取会员卡】模块</label>
						<?php  } else { ?>
						<span class="btn btn-default" disabled>【<?php  echo $modules['dayu_card']['title'];?>】模块</span>
						<?php  } ?>
						<label class="btn btn-default <?php  if($activity['iscard'] == 1) { ?>active<?php  } ?>"><input type="radio" name="iscard" value="1" <?php  if($activity['iscard'] == 1) { ?> checked="checked"<?php  } ?> >系统会员卡</label>
						<label class="btn btn-default <?php  if($activity['iscard'] == 0) { ?>active<?php  } ?>"><input type="radio" name="iscard" value="0" <?php  if($activity['iscard'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
						<span class="btn btn-success" disabled>启用状态，未领取会员卡的粉丝跳转至领取会员卡页面</span>
                    </div>
					</div>
				</div>
			</div>
        </div>
		 <div class="panel panel-default">
            <div class="panel-heading">打分评论</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">请选择评论主题</label>
                    <div class="col-xs-12 col-sm-9">
					<?php  if(pdo_tableexists('dayu_comment_category')) { ?>
						<select name="comment" class='form-control'>
							<option value="0">关闭评论</option>
							<?php  if(is_array($comment)) { foreach($comment as $c) { ?>
							<option value="<?php  echo $c['id'];?>" <?php  if($c['id'] == $par['comment']) { ?>selected="selected"<?php  } ?>><?php  echo $c['title'];?></option>
							<?php  } } ?>
						</select>
					<?php  } else { ?>
						<span class="btn btn-default" disabled>需要【评价打分插件】支持</span>
					<?php  } ?>
                    </div>
                </div>
			</div>
        </div>
		
		
	<div class="panel panel-default">
		<div class="panel-heading">多城市网点商圈</div>
            <div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">关联多城市网点商圈</label>
				<div class="col-xs-12 col-sm-9">
					<?php  if(pdo_tableexists('dayu_yuyuepay_plugin_store_store')) { ?>
					<div class="btn-group" data-toggle="buttons">					  
						<label class="btn btn-default <?php  if($activity['store'] == 1) { ?>active<?php  } ?>"><input type="radio" name="store" value="1" <?php  if($activity['store'] == 1) { ?> checked="checked"<?php  } ?> >启用</label>
						<label class="btn btn-default <?php  if($activity['store'] == 0) { ?>active<?php  } ?>"><input type="radio" name="store" value="0" <?php  if($activity['store'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
					</div>
					<span class="help-block pull-right" style="color:red;">开启后不要限制预约人数</span>
					<?php  } else { ?>
						<span class="btn btn-default" disabled>需要【多城市网点商圈】支持</span>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>