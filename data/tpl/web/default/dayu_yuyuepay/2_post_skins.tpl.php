<?php defined('IN_IA') or exit('Access Denied');?>
<div class="panel panel-default">
	<div class="panel-heading">粉丝信息</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">用户中心</label>
			<div class="col-sm-9 col-xs-12">
			<div class="btn-group" data-toggle="buttons">	
				<label class="btn btn-default <?php  if($par['member'] == 1) { ?>active<?php  } ?>"><input type='radio' name='member' value='1' <?php  if($par['member']==1) { ?>checked<?php  } ?> />关闭</label>
				<label class="btn btn-default <?php  if($par['member'] == 0) { ?>active<?php  } ?>"><input type='radio' name='member' value='0' <?php  if($par['member']==0) { ?>checked<?php  } ?> />启用</label>
					<span class="btn btn-success" disabled>关闭状态，粉丝手动输入姓名、手机，前台底部菜单隐藏，【获取粉丝资料】设置无效</span>
			</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">手机验证码</label>
			<div class="col-xs-12 col-sm-9">
			<?php  if(pdo_tableexists('dayu_sms')) { ?>
				<select name="yzm" class='form-control'>
					<option value="0">不使用短信</option>
					<?php  if(is_array($sms)) { foreach($sms as $s) { ?>
						<option value="<?php  echo $s['id'];?>" <?php  if($s['id'] == $par['smsid']) { ?>selected="selected"<?php  } ?>><?php  echo $s['title'];?></option>
					<?php  } } ?>
				</select>
			<?php  } else { ?>
				<span class="btn btn-default" disabled>需要【dayu短信】支持</span>
			<?php  } ?>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">显示与自定义名称</div>
		<div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">提交页头部</label>
                    <div class="col-xs-12 col-sm-9">
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default <?php  if($activity['isthumb'] == 1) { ?>active<?php  } ?>"><input type="radio" name="isthumb" value="1" <?php  if($activity['isthumb'] == 1) { ?> checked="checked"<?php  } ?> >显示封面</label>
						<label class="btn btn-default <?php  if($activity['isthumb'] == 2) { ?>active<?php  } ?>"><input type="radio" name="isthumb" value="2" <?php  if(empty($activity) || $activity['isthumb'] == 2) { ?> checked="checked"<?php  } ?>>显示文字</label>
						<label class="btn btn-default <?php  if($activity['isthumb'] == 3) { ?>active<?php  } ?>"><input type="radio" name="isthumb" value="3" <?php  if(empty($activity) || $activity['isthumb'] == 3) { ?> checked="checked"<?php  } ?>>显示预约说明</label>
						<label class="btn btn-default <?php  if($activity['isthumb'] == 0) { ?>active<?php  } ?>"><input type="radio" name="isthumb" value="0" <?php  if(empty($activity) || $activity['isthumb'] == 0) { ?> checked="checked"<?php  } ?>>关闭</label>
						<span class="btn btn-success" disabled>仅在 WEUI 系列模板中有。</span>
					</div>
                    </div>
                </div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">获取粉丝资料</label>
				<div class="col-sm-9 col-xs-12">
				<div class="btn-group" data-toggle="buttons">	
					<label class="btn btn-default <?php  if($activity['is_addr'] == 0) { ?>active<?php  } ?>"><input type='radio' name='is_addr' value='0' <?php  if($activity['is_addr']==0) { ?>checked<?php  } ?> />会员资料</label>
					<label class="btn btn-default <?php  if($activity['is_addr'] == 1) { ?>active<?php  } ?>"><input type='radio' name='is_addr' value='1' <?php  if($activity['is_addr']==1) { ?>checked<?php  } ?> />地址组</label>
						<span class="btn btn-success" disabled>地址组使用的是地址库：mc_member_address；会员资料使用会员中心资料：mc_members</span>
				</div>
				</div>
			</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">列表名称</label>
                    <div class="col-xs-12 col-sm-9">
                    <div class="input-group">
                    <input type="text" name="mname" class="form-control" value="<?php  echo $par['mname'];?>" /><span class="input-group-addon">例：我的表单 或是 我的预约、我的报名等</span>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">状态名称设置</label>
                    <div class="col-xs-12 col-sm-10">
                    <div class="input-group">
                    <span class="input-group-addon">待受理/待跟进</span><input type="text" name="state1" class="form-control" value="<?php  echo $par['state1'];?>" />
                    <span class="input-group-addon">已受理/跟进中</span><input type="text" name="state2" class="form-control" value="<?php  echo $par['state2'];?>" />
                    <span class="input-group-addon">退回修改</span><input type="text" name="state8" class="form-control" value="<?php  echo $par['state8'];?>" />
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-xs-12 col-sm-10">
                    <div class="input-group">
                    <span class="input-group-addon">已完成</span><input type="text" name="state3" class="form-control" value="<?php  echo $par['state3'];?>" />
                    <span class="input-group-addon">拒绝受理</span><input type="text" name="state4" class="form-control" value="<?php  echo $par['state4'];?>" />
                    <span class="input-group-addon">已取消</span><input type="text" name="state5" class="form-control" value="<?php  echo $par['state5'];?>" />
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-1 control-label">提交按钮文字</label>
                    <div class="col-xs-12 col-sm-9">
                    <input type="text" name="submits" class="form-control" value="<?php  echo $par['submit'];?>" />
                    </div>
                </div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">提交页模板选择</div>
	<div class="panel-body">
	<?php  if(pdo_tableexists('dayu_yuyuepay_skins') && !empty($skins)) { ?>
		<div class="form-group">
			<div class="col-sm-12 col-xs-12">
				<div class="row row-fix">
                <?php  if(is_array($skins)) { foreach($skins as $skin) { ?>
					<div class="col-xs-8 col-sm-8 col-md-3 template_picker">
						<div class="thumbnail btn" style="text-align:center;width:100%; <?php  if($skin['mode']==9) { ?>background-color:#c8e6c9;<?php  } ?>" data-toggle="tooltip" data-placement="bottom" title="<?php  echo $skin['description'];?>">
							<img  class="imgtip" style="height:100px;overflow:hidden;" src="<?php  echo tomedia($skin['thumb'])?>" bigimg="<?php  echo tomedia($skin['thumb'])?>">
							<span style="display:block;white-space: nowrap;text-overflow:ellipsis; overflow:hidden"><?php  echo $skin['title'];?></span>
							<div class="radio">
								<label>
									<input type="radio" name="skins" value="<?php  echo $skin['name'];?>" <?php  if($activity['skins'] == $skin['name'] || empty($activity['skins'])) { ?> checked="checked"<?php  } ?>>选择
								</label>
							</div>
						</div>
					</div>
                <?php  } } ?>

            </div>
          </div>
        </div>
<script type="text/javascript">
$(function () {
	var x = 10;
	var y = 20;
	$(".imgtip").mouseover(function (e) {
		this.myTitle = this.title;
		this.title = "";
		var imgtip = "<div id='imgtip'><img src='" + $(this).attr("bigimg") + "' width='380' alt='预览图'/><\/div>"; //创建 div 元素
		$("body").append(imgtip); //把它追加到文档中
		if (e.pageX + 300 > $(window).width()) {
			x = 10;
		} else {
			x = $(window).width() - 390;
		}
		$("#imgtip").css({
			"z-index": 9999,
			"position" : "fixed",
			"top": (20) + "px",
			"left": x + "px"
		}).show("fast");   //设置x坐标和y坐标，并且显示
	}).mouseout(function () {
		this.title = this.myTitle;
		$("#imgtip").remove();  //移除
	}).mousemove(function (e) {
		$("#imgtip").css({
			"z-index": 9999,
			"position" : "fixed",
			"top": (20) + "px",
			"left": x + "px"
		});
	});

	$(".template_picker").click(function(e) {
		$(this).find('input').attr('checked', 'checked');
	});
});
</script>
	<?php  } else { ?>
			<div class="form-group">
				<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">WEUI模板</label>
				<div class="col-sm-8 col-xs-12">
					<div class="row row-fix">
						<div class="col-xs-6 col-sm-6 col-md-3 template_picker">
							<div class="thumbnail" style="text-align:center;width:140px;">
								<span style="display:block;white-space: nowrap;text-overflow:ellipsis; overflow:hidden">WEUI</span>
								<div class="radio">
									<label>
										<input type="radio" name="skins" value="weui" <?php  if($activity['skins'] == 'weui' || empty($activity['skins'])) { ?> checked="checked"<?php  } ?>>
										选择
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php  } ?>
	</div>
</div>