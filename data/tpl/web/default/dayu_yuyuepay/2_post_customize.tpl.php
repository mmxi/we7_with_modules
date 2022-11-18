<?php defined('IN_IA') or exit('Access Denied');?>        <div class="panel panel-success">
            <div class="panel-heading">
                预约内容管理
            </div>
            <div class="panel-body table-responsive">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:#ff0000;">服务项目数量</label>
                    <div class="col-xs-12 col-sm-9 input-group">
		 				<label class="radio-inline"><input type="radio" name="is_num" value="1" <?php  if($activity['is_num'] == 1) { ?> checked="checked"<?php  } ?> onclick="$('#is_num').show();" /> 开启</label>
                		<label class="radio-inline"><input type="radio" name="is_num" value="0" <?php  if($activity['is_num'] == 0) { ?> checked="checked"<?php  } ?> onclick="$('#is_num').hide();" /> 关闭</label>
                    </div>
                </div>
                <div class="alert-new">
					<table class="table table-hover">
						<thead>
						<tr>
							<th style="width:45%;">自定义字段</th>
							<th style="width:15%;text-align:center;">排序</th>
							<th style="width:8%;text-align:center;">是否必填</th>
							<th style="width:12%;">类型</th>
							<th style="width:10%;">关联默认值</th>
							<th style="width:10%;color:red">操作</th>
						</tr>
						</thead>
						<tr>
							<td>
							<div class="input-group">
							<input type="text" name="xmname" class="form-control" value="<?php  echo $par['xmname'];?>" /><span class="input-group-addon">例：服务项目</span>
							</div>
							</td>
							<td><input type="text" class="form-control" value="顶端" readonly /></td>
							<td style="text-align:center;"><input type="checkbox" title="必填项" checked="checked" disabled="true" /></td>
							<td>
								<select class="form-control" readonly>
									<option>选择(select)</option>
								</select>
							</td>
							<td>
								<select class="form-control" readonly>
									<option>不关联粉丝数据</option>
								</select>
							</td>
							<td>
							</td>
						</tr>
						<tr id="is_num"<?php  if($activity['is_num'] == 0) { ?> style="display:none"<?php  } ?>>
							<td>
							<div class="input-group">
							<input type="text" name="numname" class="form-control" value="<?php  echo $par['numname'];?>" ><span class="input-group-addon">服务项目 × 数量</span>
							</div>
							</td>
							<td><input type="text" class="form-control" value="顶端" readonly /></td>
							<td style="text-align:center;"><input type="checkbox" title="必填项" checked="checked" disabled="true" /></td>
							<td>
								<select class="form-control" readonly>
									<option>数字(number)</option>
								</select>
							</td>
							<td>
								<select class="form-control" readonly>
									<option>不关联粉丝数据</option>
								</select>
							</td>
							<td>
							</td>
						</tr>
						<tr id="time"<?php  if($activity['is_time'] == 1) { ?> style="display:none"<?php  } ?>>
							<td>
							<div class="input-group"><input type="text" name="yuyuename" class="form-control" value="<?php  echo $par['yuyuename'];?>" /><span class="input-group-addon">例：预约时间</span>
							</div>
							</td>
							<td><input type="text" class="form-control" value="顶端" readonly /></td>
							<td style="text-align:center;"><input type="checkbox" title="必填项" checked="checked" disabled="true" /></td>
							<td>
								<select class="form-control" readonly>
									<option>时间(range)</option>
								</select>
							</td>
							<td>
								<select class="form-control" readonly>
									<option>不关联粉丝数据</option>
								</select>
							</td>
							<td>
							</td>
						</tr>
						<tbody id="re-items">
						<?php  if(is_array($ds)) { foreach($ds as $r) { ?>
						<tr>
							<td><input name="title[]" type="text" class="form-control" value="<?php  echo $r['title'];?>"/></td>
							<td><input type="text" name="displayorder[]" class="form-control" value="<?php  echo $r['displayorder'];?>" /></td>
							<td style="text-align:center;"><input name="essential[]" type="checkbox" title="必填项" <?php  if($r['essential']) { ?> checked="checked"<?php  } ?>/></td>
							<td>
								<select name="type[]" class="form-control">
									<?php  if(is_array($types)) { foreach($types as $k => $v) { ?>
									<option value="<?php  echo $k;?>"<?php  if($k == $r['type']) { ?> selected="selected"<?php  } ?>><?php  echo $v;?></option>
									<?php  } } ?>
								</select>
							</td>
							<td>
								<select name="bind[]" class="form-control">
									<option value="">不关联粉丝数据</option>
									<?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?>
									<option value="<?php  echo $k;?>"<?php  if($k == $r['bind']) { ?> selected="selected"<?php  } ?>><?php  echo $v;?></option>
									<?php  } } ?>
								</select>
								<input type="hidden" name="value[]" value="<?php  echo $r['value'];?>"/>
								<input type="hidden" name="desc[]" value="<?php  echo $r['description'];?>"/>
								<input type="hidden" name="image[]" value="<?php  echo $r['image'];?>"/>
								<input type="hidden" name="loc[]" value="<?php  echo $r['loc'];?>"/>
								<input type="hidden" name="essentialvalue[]" value="<?php  if($r['essential']) { ?>true<?php  } else { ?>false<?php  } ?>"/>
							</td>
							<td>
								<?php  if(!$hasData) { ?>
								<a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="设置详细信息" onclick="setValues(this);" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> &nbsp;
								<a href="javascript:;" onclick="deleteItem(this)" data-toggle="tooltip" data-placement="bottom" title="删除此条目" class="btn btn-default btn-sm"><i class="fa fa-times"></i></a>
								<?php  } ?>
							</td>
						</tr>
						<?php  } } ?>
						</tbody>
					</table>
				</div>
				<div class="help-block">
					<?php  if($hasData) { ?>
					<a href="<?php  echo $this->createWebUrl('manage', array('id' => $reid));?>" target="_blank">已经存在预约数据, 不能修改预约条目信息</a>
					<?php  } else { ?>
					<a href="javascript:;" class="btn btn-success" onclick="addItem();"><i class="fa fa-plus" title="添加自定义字段"></i> 添加自定义字段</a>
					<?php  } ?>
				</div>
				<span class="help-block">关联默认值：关联粉丝资料，免二次输入. </span>
				<span class="help-block">预约成功启动以后(已经有粉丝用户提交预约信息), 将不能再修改预约条目, 请仔细编辑. </span>
				<span class="help-block">如果需要关联生日，项目类型设置为日历，只能设置关联一次生日，超出报错。</span>
				<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<h4>提示！</h4>已关联粉丝姓名、手机，无需再添加姓名、手机字段（见 <a href="#tab_skins">模板设置</a> - 获取粉丝资料）
				</div>

            </div>
        </div>