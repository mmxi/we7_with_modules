<?php defined('IN_IA') or exit('Access Denied');?>        <div class="panel panel-success">
            <div class="panel-heading">邮件通知设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">提醒接收邮箱</label>
                    <div class="col-xs-12 col-sm-5">
                        <input type="text" name="noticeemail" class="form-control" value="<?php  echo $activity['noticeemail'];?>" />
                    </div>
					<div class="col-xs-12 col-sm-4"><a href="./index.php?c=profile&a=notify&" target="_blank">邮件参数设置</a></div>
                </div>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">模板消息设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知客服-模板消息ID</label>
                    <div class="col-xs-12 col-sm-9 input-group">
                        <input type="text" class="form-control" name="k_templateid" value="<?php  echo $activity['k_templateid'];?>" />
	        			<span class="input-group-addon">IT，互联网：(搜索)订单提交通知 - 编号：OPENTM401887542</span>
                    </div>
                </div>
                <div class="form-group" style="background-color:#eee;">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知粉丝-模板消息ID</label>
                    <div class="col-xs-12 col-sm-9 input-group">
                    	<input type="text" name="m_templateid" class="form-control" value="<?php  echo $activity['m_templateid'];?>" /><span class="input-group-addon">例（IT，互联网）：预约结果通知，编号：OPENTM206305207</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9 input-group">
                    <span class="input-group-addon">标题(留空：预约结果通知)：</span><input type="text" name="mfirst" class="form-control" value="<?php  echo $par['mfirst'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-6 input-group">
                    <span class="input-group-addon">{{keyword1.DATA}}：</span><input type="text" class="form-control" value="客户姓名" readonly="readonly"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-6 input-group">
                    <span class="input-group-addon">{{keyword2.DATA}}：</span><input type="text" class="form-control" value="预约服务项目" readonly="readonly"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-6 input-group">
                    <span class="input-group-addon">{{keyword3.DATA}}：</span><input type="text" class="form-control" value="预约时间" readonly="readonly"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-6 input-group">
                    <span class="input-group-addon">{{keyword4.DATA}}：</span><input type="text" class="form-control" value="预约结果，客服已确认（拒绝等），客服备注" readonly="readonly"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-xs-12 col-sm-9 input-group">
                    <span class="input-group-addon">尾注(留空：如有疑问，请致电联系我们)：</span><input type="text" name="mfoot" class="form-control" value="<?php  echo $par['mfoot'];?>" />
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">短信通知设置 （表单所有内容-包含预约填写的所有项目,内容较多可能分拆成数条短信,请慎用）</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知对象</label>
                    <div class="col-xs-12 col-sm-9">
		 				<label class="radio-inline"><input type="radio" name="sms" value="0" <?php  if(empty($activity) || $par['sms'] == 0) { ?> checked="checked"<?php  } ?> onclick="$('#sms').show();" /> 1、提交通知管理员</label>
                		<label class="radio-inline"><input type="radio" name="sms" value="1" <?php  if($par['sms'] == 1) { ?> checked="checked"<?php  } ?> onclick="$('#sms').hide();" /> 2、受理通知用户(预约项目、受理状态)</label>
                		<label class="radio-inline"><input type="radio" name="sms" value="2" <?php  if($par['sms'] == 2) { ?> checked="checked"<?php  } ?> onclick="$('#sms').show();" /> 支持1、2</label>
                    </div>
                </div>
                <div class="form-group" id="sms" <?php  if($par['sms'] == 1) { ?>style="display:none"<?php  } ?>>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">提醒接收手机</label>
                    <div class="col-xs-12 col-sm-9">
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $activity['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">短信通知模板</label>
                    <div class="col-xs-12 col-sm-9">
					<?php  if(pdo_tableexists('dayu_sms')) { ?>
						<select name="smsid" class='form-control'>
							<option value="0">不使用短信</option>
							<?php  if(is_array($sms)) { foreach($sms as $s) { ?>
							<option value="<?php  echo $s['id'];?>" <?php  if($s['id'] == $activity['smsid']) { ?>selected="selected"<?php  } ?>><?php  echo $s['title'];?></option>
							<?php  } } ?>
						</select>
					<?php  } else { ?>
						<span class="btn btn-default" disabled>需要【dayu短信】支持</span>
					<?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">通知内容</label>
                    <div class="col-xs-12 col-sm-9">
						<select name="smstype" class='form-control'>
							<option value="1" <?php  if($activity['smstype'] == 1) { ?>selected="selected"<?php  } ?>>姓名、手机、状态</option>
						</select>
                    </div>
                </div>
            </div>
        </div>