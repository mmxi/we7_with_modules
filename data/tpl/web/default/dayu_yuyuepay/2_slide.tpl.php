<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  load()->func('tpl')?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('slide',array('op' =>'display'))?>">幻灯片</a></li>
    <li<?php  if($operation == 'post') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('slide',array('op' =>'post'))?>">添加幻灯片</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<div class="main">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th style="width:80px;">排序</th>
                    <th>标题</th>
                    <th>连接</th>
                    <th style="width:10%;">分类</th>
                    <th style="width:150px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $slide) { ?>
                <tr>
                    <td><?php  echo $slide['id'];?></td>
                    <td><?php  echo $slide['displayorder'];?></td>
                    <td><?php  echo $slide['title'];?></td>
                    <td><?php  echo $slide['link'];?></td>
                    <td><?php  echo $slide['cate']['title'];?></td>
                    <td style="text-align:left;">
						<a href="<?php  echo $this->createWebUrl('slide', array('op' => 'post', 'id' => $slide['id']))?>" class="btn btn-default">修改</a>
						<a href="<?php  echo $this->createWebUrl('slide', array('op' => 'delete', 'id' => $slide['id']))?>" class="btn btn-default">删除</a>
					</td>
                </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <?php  echo $pager;?>
    </div>
</div>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
    	<div class="panel panel-default">
            <div class="panel-heading">
        <input type="hidden" name="id" value="<?php  echo $slide['id'];?>" />
                幻灯片 <span class="text-muted">幻灯片设置</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="displayorder" value="<?php  echo $slide['displayorder'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片标题</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="title" id="title" value="<?php  echo $slide['title'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片图片</label>
                    <div class="col-xs-12 col-sm-9">
						<?php  echo tpl_form_field_image('thumb',$slide['thumb']);?>
	      				<span class="help-block">用幻灯片来更好的表现你的预约主题</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">幻灯片链接</label>
                    <div class="col-xs-12 col-sm-9">
                         <input type="text" class="form-control" placeholder="" name="link" id="link" value="<?php  echo $slide['link'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否显示</label>
                    <div class="col-xs-12 col-sm-9">
                		<label class="radio-inline"><input type="radio" name="enabled" value="1" id="enabled1" <?php  if(empty($slide) || $slide['enabled'] == 1) { ?>checked="true"<?php  } ?> /> 显示</label>
		 				<label class="radio-inline"><input type="radio" name="enabled" value="0" id="enabled2" <?php  if(!empty($slide) && $slide['enabled'] == 0) { ?>checked="true"<?php  } ?> /> 隐藏</label>
                    <div class="help-block">是否在手机端显示该图片</div>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">请选择首页分类：</label>
					<div class="col-sm-9">
						<select class="form-control" name="cate">
								<option value="0" <?php  if($slide['cid']=='0') { ?> selected="selected"<?php  } ?>>仅首页显示</option>
							<?php  if(is_array($category)) { foreach($category as $row) { ?>
								<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $slide['cid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				
     </div>
     </div>
        <div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		</div>
	</form>
</div>
<script language='javascript'>
    function formcheck() {
        if ($("#title").isEmpty()) {
            Tip.focus("title", "请填写幻灯片名称!", "right");
            return false;
        }
       
        return true;
    }
    
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>