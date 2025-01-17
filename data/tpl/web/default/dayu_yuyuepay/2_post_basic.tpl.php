<?php defined('IN_IA') or exit('Access Denied');?>
        <div class="panel panel-primary">
            <div class="panel-heading">基本设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约主题</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="activity" value="<?php  echo $activity['title'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约封面</label>
                    <div class="col-xs-12 col-sm-9">
                         <?php  echo tpl_form_field_image('thumb',$activity['thumb']);?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">关键字回复简介</label>
                    <div class="col-xs-12 col-sm-9">
                         <textarea style="height:200px;" class="form-control" id="description" name="description" cols="70"><?php  echo $activity['description'];?></textarea>
	        			<span class="help-block">显示于关键字回复及分享描述</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">预约说明</label>
                    <div class="col-xs-12 col-sm-9">
						<?php  echo tpl_ueditor('content', $activity['content']);?>
	        			<span class="help-block">显示于提交页使用说明</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">线下付款<br>提交成功提示</label>
                    <div class="col-xs-12 col-sm-9">
                            <textarea type="text" class="form-control"  placeholder="" name="information"><?php  echo $activity['information'];?></textarea>
	        			<span class="help-block">此预约的说明信息. 例如: 您的预约申请我们已经收到, 请等待客服确认.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">开始时间</label>
                    <div class="col-xs-12 col-sm-9">
                  		<?php  echo tpl_form_field_date('starttime', $activity['starttime'], true)?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">结束时间</label>
                    <div class="col-xs-12 col-sm-9">
                 		<?php  echo tpl_form_field_date('endtime', $activity['endtime'], true)?>
                    </div>
                </div>
            </div>
        </div>