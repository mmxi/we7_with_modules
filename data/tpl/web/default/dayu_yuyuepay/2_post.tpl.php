<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo TEMPLATE_PATH;?>js/times.js"></script>
<style type="text/css">
.form .alert{width:700px;}
.btn-group .active{background-color:#428bca;color:#fff;}
.control-label{font-weight:600;}
</style>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo $this->createWebUrl('display')?>">预约列表</a></li>
	<?php  if(!$reid) { ?>
	<li class="active"><a href="<?php  echo $this->createWebUrl('post')?>">新建预约</a></li>
	<?php  } else { ?>
	<li class="active"><a href="#">编辑预约</a></li>
	<li><a href="<?php  echo $this->createWebUrl('staff', array('op' => 'list','reid' => $reid))?>">管理客服</a></li>
	<li><a href="<?php  echo $this->createWebUrl('item', array('op' => 'list','reid' => $reid))?>">管理<?php  echo $par['xmname'];?></a></li>
	<?php  } ?>
</ul>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills">
				<li role="presentation" class="active"><a href="#tab_basic" aria-controls="tab_basic" role="tab" data-toggle="pill">基本设置</a></li>
				<li role="presentation" class=""><a href="#tab_customize" aria-controls="tab_customize" role="tab" data-toggle="pill">自定义字段</a></li>
				<li role="presentation" class=""><a href="#tab_time" aria-controls="tab_time" role="tab" data-toggle="pill">时间设置</a></li>
				<li role="presentation" class=""><a href="#tab_list" aria-controls="tab_list" role="tab" data-toggle="pill">首页/分类</a></li>
				<li role="presentation" class=""><a href="#tab_skins" aria-controls="tab_skins" role="tab" data-toggle="pill">模板设置</a></li>
				<li role="presentation" class=""><a href="#tab_plugin" aria-controls="tab_plugin" role="tab" data-toggle="pill">插件设置</a></li>
				<li role="presentation" class=""><a href="#tab_notice" aria-controls="tab_notice" role="tab" data-toggle="pill">通知设置</a></li>
				<li role="presentation" class=""><a href="#tab_xf" aria-controls="tab_xf" role="tab" data-toggle="pill">消费相关</a></li>
				<li role="presentation" class=""><a href="#tab_set" aria-controls="tab_set" role="tab" data-toggle="pill">参数开关</a></li>
				<li role="presentation" class=""><a href="#high_grade" aria-controls="high_grade" role="tab" data-toggle="pill">高级参数</a></li>
			</ul>
		</div>
    </div>
	<div class="tab-content">
		<div class="tab-pane active" role="tabpanel" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_basic', TEMPLATE_INCLUDEPATH)) : (include template('post_basic', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_customize"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_customize', TEMPLATE_INCLUDEPATH)) : (include template('post_customize', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_time"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_time', TEMPLATE_INCLUDEPATH)) : (include template('post_time', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_list"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_list', TEMPLATE_INCLUDEPATH)) : (include template('post_list', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_skins"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_skins', TEMPLATE_INCLUDEPATH)) : (include template('post_skins', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_plugin"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_plugin', TEMPLATE_INCLUDEPATH)) : (include template('post_plugin', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_notice"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_notice', TEMPLATE_INCLUDEPATH)) : (include template('post_notice', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_xf"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_xf', TEMPLATE_INCLUDEPATH)) : (include template('post_xf', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="tab_set"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_set', TEMPLATE_INCLUDEPATH)) : (include template('post_set', TEMPLATE_INCLUDEPATH));?></div>
		<div class="tab-pane" role="tabpanel" id="high_grade"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('post_high_grade', TEMPLATE_INCLUDEPATH)) : (include template('post_high_grade', TEMPLATE_INCLUDEPATH));?></div>
	</div>
        <div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
   </form>
</div>
<div id="dialog"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>设置选项</h3></div>
            <div class="modal-body" >  
               <div class="well">
					<textarea id="re-desc" class="form-control" rows="3"></textarea>
					<span class="help-block"><strong>设置此条目的说明信息</strong></span>
				</div>
				<div class="well re-value hide">
					<textarea id="re-value" class="form-control" rows="6"></textarea>
					<span class="help-block"><strong>设置预约条目的选项(如果有需要的话.) 每行一条记录, 例如: 性别 男, 女</strong></span>
				</div>
				<div class="well re-image hide">
					<?php  echo tpl_form_field_images('image[]','');?>
					<span class="help-block"><strong>示例图：</strong></span>
				</div>
				<div class="well re-loc hide">
					<input type="number" name="loc[]" id="re-loc" class="form-control" style="width:120px;">
					<span class="help-block"><strong>获取地址：输入大于0的数字支持获取地址</strong></span>
				</div>
                <div id="module-menus" style="padding-top:5px;"></div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary btn-ok" data-dismiss="modal" aria-hidden="true">确 定</a>
                <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关 闭</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
require(['angular.sanitize','clockpicker'], function(angular, $, _){
	$('.starttime').clockpicker({autoclose: true});
	$('.endtime').clockpicker({autoclose: true});
});
function TimeInit(input){
	this.input=input;
	  
	this.value=this.unserialize(input.value);
	this.box =$('<div class="timebox">' +
			'<div class="weekset"></div>' +
			'<ul class="list-unstyled timelist clockpicker"></ul>' +
			'<a class="btn btn-success btn-add"><i class="fa fa-plus"></i> 添加时间段</a>' +
			'</div>');
	$(this.input).before(this.box);
	this.weekset=this.box.find('.weekset');
	this.listbox=this.box.find('.timelist');
	this.addbtn=this.box.find('.btn-add');
	this.init();
}

TimeInit.prototype.init=function(){
	var self=this;
	this.addbtn.click(function(){
		self.addrow();
	});
	//设置周
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="1" /> 周一</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="2" /> 周二</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="3" /> 周三</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="4" /> 周四</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="5" /> 周五</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="6" /> 周六</label>');
	$(this.weekset).append('<label class="checkbox-inline"><input type="checkbox" value="0" /> 周日</label>');
	for(var i=0;i<this.value.weekset.length;i++){
		$(this.weekset).find('[value='+this.value.weekset[i]+']').attr('checked',true);
	}
	$(this.weekset).find('label').click(function(){
		self.setValue();
	})
	//设置时间段
	for(var i=0;i<this.value.times.length;i++){
		this.addrow(this.value.times[i]);
	}
}

TimeInit.prototype.addrow=function(val){
	var row =$('<li class="input-group" style="margin:10px 0">' +
			'<span class="input-group-addon">时段</span>' +
			'<input type="text" placeholder="0:00" class="form-control starttime" value="0:00"/>' +
			'<span class="input-group-addon">-</span>' +
			'<input type="text" placeholder="1:00" class="form-control endtime" value="1:00"/>' +
			'<span class="input-group-addon">可预约</span>' +
			'<input type="text" placeholder="5" class="form-control number" value="5"/>' +
			'<span class="input-group-addon">人</span>' +
			'<span class="input-group-btn">' +
			'<button class="btn btn-danger remove" type="button">删除</button>' +
			'</span>' +
			'</li>');
	this.listbox.append(row);
	var self=this;
	row.find('.remove').click(function(){
		if(confirm('确定删除该时段?')){
			row.remove();
			self.setValue();
		}
	})
	row.find('focus').blur(function(){
		$(this).data('oldvalue',this.value);
	})
	row.find('input').blur(function(){
		if(this.value != this.oldvalue)self.setValue();
	})
	if(val){
		row.find('.starttime').val(val.start);
		row.find('.endtime').val(val.end);
		row.find('.number').val(val.number);
	}
}

TimeInit.prototype.setValue=function(){
	var value={weekset:[],times:[]};
	this.weekset.find('input:checked').each(function(){
		value.weekset.push(this.value);
	});

	this.listbox.find('li').each(function(){
		var row={};
		row.start=$(this).find('.starttime').val();
		row.end=$(this).find('.endtime').val();
		row.number=$(this).find('.number').val();
		if(row.start && row.end && row.number){
			value.times.push(row);
		}
	});
	this.value=value;
	$(this.input).val(this.serialize(value));
}

TimeInit.prototype.unserialize=function(val){
	if(val){
		var data=eval('('+val+')');
		if(data)return data;
	}

	  //默认值
	data= {
		weekset:[1,2,3,4,5],
		times:[
		  {start:'8:00',end:'9:00',number:1},
		  {start:'9:00',end:'10:00',number:1},
		  {start:'10:00',end:'11:00',number:1},
		  {start:'11:00',end:'12:00',number:1},
		  {start:'13:30',end:'14:30',number:1},
		  {start:'14:30',end:'15:30',number:1},
		  {start:'15:30',end:'16:30',number:1},
		  {start:'16:30',end:'17:30',number:1}
		]
	};
	this.input.value=this.serialize(data);
	return data;
}

TimeInit.prototype.serialize=function(val){
	return $.toJSON(val);
}
	new TimeInit($('.srvtime')[0]);
//-->

	var currentItem = null;
	$(function(){
		require(['jquery','jquery.ui'],function($,j){
			$('#re-items').sortable({handle: '.fa-move'});
		})
		$('#dialog .btn-ok').on('click', function(){
       
			if(currentItem == null) return;
			var v = $('#dialog #re-value').val();
			$(currentItem).parent().prev().find(':hidden[name="value[]"]').val(encodeURIComponent(v.replace(/\n/g, ',')));
			var v = $('#dialog #re-desc').val();
			$(currentItem).parent().prev().find(':hidden[name="desc[]"]').val(encodeURIComponent(v));
			var v = $('#dialog #re-image').val();
			$(currentItem).parent().prev().find(':hidden[name="image[]"]').val(v);
			var v = $('#dialog #re-loc').val();
			$(currentItem).parent().prev().find(':input[name="loc[]"]').val(v);
		});
		<?php  if($hasData) { ?>
		$('#re-items').find(':text,:checkbox,select').attr('disabled', 'disabled');
		<?php  } ?>
		$('#remove-add').click(function(){
			var index = $('.dayu').length;
			var rhtml = '<div class="form-group">'+
					'<label class="col-xs-12 col-sm-3 col-md-2 control-label">排除的日期</label>'+
					'<div class="col-xs-12 col-sm-3">'+
					'<input type="text" readonly="readonly" onclick="showtime(this,'+index+');" id="datetime'+index+'" class="datetimepicker dayu form-control" name="remove[]" />'+
					'</div>'+
					'<div class="col-sm-9 col-xs-4 col-md-3" style="padding-top:6px">'+
					'<a href="javascript:;" onclick="delhouritem(this);"><i class="fa fa-times-circle" title="删除日期"> </i></a>'+
					'</div>'+
					'</div>';
					$('#remove').append(rhtml);
		});
	});
				function showtime(obj,id) {
				require(["datetimepicker"], function(){
				$(function(){
						var option = {
							lang : "zh",
							step : 5,
							timepicker : false,
							closeOnDateSelect : true,
							format : "Y-m-d"
						};
//					$(".datetimepicker[name = 'remove']").datetimepicker(option);
					$("#datetime"+id).datetimepicker(option);
//					$(obj).datetimepicker(option);
				});
			});

			}
	function delhouritem(obj) {
		$(obj).parent().parent().remove();
		return false;
	}
	function setValues(o) {
		var v = $(o).parent().prev().find(':hidden[name="value[]"]').val();
		v = decodeURIComponent(v);
		$('#dialog #re-value').val(v.replace(/,/g, '\n'));
		
		var v = $(o).parent().prev().find(':hidden[name="image[]"]').val();
		$('#dialog #re-image').val(v);
		
		var v = $(o).parent().prev().find(':input[name="loc[]"]').val();
		$('#dialog #re-loc').val(v);
		
		var v = $(o).parent().prev().find(':hidden[name="desc[]"]').val();
		v = decodeURIComponent(v);
		$('#dialog #re-desc').val(v);
		var v = $(o).parent().prev().prev().find('select[name="type[]"]').val();
             
		if(v == 'radio' || v == 'checkbox' || v == 'select') {
			$('.well.re-value').removeClass('hide');
		} else {
			$('.well.re-value').addClass('hide');
		}
		if(v == 'image') {
			$('.well.re-image').removeClass('hide');
		} else {
			$('.well.re-image').addClass('hide');
		}
		if(v == 'textarea') {
			$('.well.re-loc').removeClass('hide');
		} else {
			$('.well.re-loc').addClass('hide');
		}
		$('#dialog').modal({keyboard: false});
		currentItem = o;
	}
	function addItem() {
		var html = '' + 
				'<tr>' +
					'<td><input name="title[]" type="text" class="form-control" /></td>' +
					'<td><input type="text" name="displayorder[]" class="form-control" /></td>' + 
					'<td style="text-align:center;"><input name="essential[]" type="checkbox" title="必填项" /></td>' +
					'<td>' +
						'<select name="type[]" class="form-control">' +
						<?php  if(is_array($types)) { foreach($types as $k => $v) { ?>'<option value="<?php  echo $k;?>"><?php  echo $v;?></option>' + <?php  } } ?>
						'</select>' +
					'</td>' +
					'<td>' +
						'<select name="bind[]" class="form-control">' +
							'<option value="">不关联粉丝数据</option>' +
						<?php  if(is_array($fields)) { foreach($fields as $k => $v) { ?><?php  if(!empty($v)) { ?>'<option value="<?php  echo $k;?>"><?php  echo $v;?></option>' + <?php  } ?><?php  } } ?>
						'</select>' +
						'<input type="hidden" name="value[]" />' +
						'<input type="hidden" name="image[]" />' +
						'<input type="hidden" name="desc[]" />' +
						'<input type="hidden" name="loc[]" />' +
						'<input type="hidden" name="essentialvalue[]" />' +
					'</td>' +
					'<td>' +
						'<a href="javascript:;" data-toggle="tooltip" data-placement="bottom" class="btn btn-warning btn-sm" title="设置详细信息" onclick="setValues(this);"><i class="fa fa-edit"></i></a>&nbsp;' +
						'<a href="javascript:;" data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm" onclick="deleteItem(this)"  title="删除此条目"><i class="fa fa-times"></i></a>' +
					'</td>' + 
				'</tr>';
		$('#re-items').append(html);
	}
	function deleteItem(o) {
		$(o).parent().parent().remove();
	}
    function message(msg){
        require(['util'],function(util){
            util.message(msg);
        });
    }

	function validate() {
		if($.trim($(':text[name="activity"]').val()) == '') {
			message('必须填写预约标题.', '', 'error');
			return false;
		}
		if($.trim($('textarea[name="information"]').val()) == '') {
			message('必须填写预约成功提示信息.', '', 'error');
			return false;
		}
		<?php  if(empty($reid)) { ?>
		if($.trim($(':input[name="thumb"]').val()) == '') {
			message('必须上传预约封面.', '', 'error');
			return false;
		}
		<?php  } ?>
		if($(':text[name="title[]"]').length == 0) {
			message('必须设定预约的自定义字段.', '', 'error');
			return false;
		}
		var isError = false;
		$(':text[name="title[]"]').each(function(){
			if($.trim($(this).val()) == '') {
				isError = true;
			}
		});
		if(isError) {
			message('必须要设定每个自定义字段的标题.', '', 'error');
			return false;
		}
		
		var isError = false;
		$('#re-items tr').each(function(){
			var t = $(this).find('select[name="type[]"]').val();
			if(t == 'radio' || t == 'checkbox' || t == 'select') {
				if($.trim($(this).find(':hidden[name="value[]"]').val()) == '') {
					isError = true;
				}
			}
		});
		if(isError) {
			message('单选, 多选或下拉选择项目必须要设定备选项.', '', 'error');
			return false;
		}
		$(':checkbox').each(function(){
			if($(this).get(0).checked) {
				$(this).parent().parent().find(':hidden[name="essentialvalue[]"]').val('true');
			} else {
				$(this).parent().parent().find(':hidden[name="essentialvalue[]"]').val('false');
			}
		});
		return true;
	}
</script>
<script type="text/javascript">
	$('.btn-openid').click(function(){
		var nickname = $.trim($(':text[name="nikename"]').val());
		var openid = $.trim($(':text[name="kfid"]').val());
		if(!nickname && !openid) {
			util.message('请输入昵称或者openid');
			return false;
		}
		var param = {
			'nickname':nickname,
			'openid':openid
		};
		$.post("<?php  echo $this->createWebUrl('post', array('op' => 'verify'))?>", param, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno < 0) {
				util.message(data.message.message);
				return false;
			}
			$(':text[name="kfid"]').val(data.message.message.openid);
			$(':text[name="nikename"]').val(data.message.message.nickname);
		});
		return false;
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
