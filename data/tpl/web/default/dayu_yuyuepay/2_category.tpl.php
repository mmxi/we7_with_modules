<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common_css', TEMPLATE_INCLUDEPATH)) : (include template('common_css', TEMPLATE_INCLUDEPATH));?>

<ul class="nav nav-tabs">
	<li <?php  if($operation == 'post' && empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'post'))?>">添加分类</a></li>
	<li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'display'))?>">管理分类</a></li>
	<?php  if($operation == 'reply' && !empty($id) && !empty($rid)) { ?><li <?php  if($operation == 'reply') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('category', array('op' => 'reply','id' => $id,'rid' => $rid))?>">关键字设置</a></li><?php  } ?>
    <?php  if($operation == 'post' && !empty($id)) { ?><li class="active"><a href="#">
    编辑分类
    </a></li><?php  } ?>
</ul>

<?php  if($operation == 'post') { ?>

<div class="main">

    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <div class="panel panel-default">
            <div class="panel-heading">分类详细设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">分类名称</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $cate['title'];?>" />
                    </div>
				</div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">图标</label>
                    <div class="col-xs-12 col-sm-9">
                         <?php  echo tpl_form_field_image('thumb',$cate['icon']);?>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">主题列表显示</label>
					<div class="col-xs-12 col-sm-9">
						<div class="btn-group" data-toggle="buttons">					  
							<label class="btn btn-default <?php  if(empty($cate) || $cate['list'] == '1') { ?>active<?php  } ?>"><input type="radio" name="list" value="1" <?php  if(empty($cate) || $cate['list'] == 1) { ?>checked="checked"<?php  } ?> >一行1个主题</label>
							<label class="btn btn-default <?php  if($cate['list'] == '3') { ?>active<?php  } ?>"><input type="radio" name="list" value="3" <?php  if(!empty($cate) && $cate['list'] == 3) { ?> checked="checked"<?php  } ?>>一行3个主题</label>
							<label class="btn btn-default <?php  if($cate['list'] == '4') { ?>active<?php  } ?>"><input type="radio" name="list" value="4" <?php  if(!empty($cate) && $cate['list'] == 4) { ?> checked="checked"<?php  } ?>>一行4个主题</label>
						</div>
					</div>
				</div> 
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分类导航栏景色</label>
					<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<?php  echo tpl_form_field_color('nav_index', $color['nav_index']);?>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">介绍导航栏背景色</label>
					<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<?php  echo tpl_form_field_color('nav_page', $color['nav_page']);?>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-4 col-md-3 col-lg-2 control-label">分类按钮栏背景色</label>
					<div class="col-sm-9 col-xs-12">
					<div class="input-group">
						<?php  echo tpl_form_field_color('nav_btn', $color['nav_btn']);?>
					</div>
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
<script type="text/javascript" src="../web/resource/components/colorpicker/spectrum.js"></script>
<link type="text/css" rel="stylesheet" href="../web/resource/components/colorpicker/spectrum.css" />
<script type="text/javascript">
<!--
	$(function(){
		colorpicker();
	});
//-->
</script>
<?php  } else if($operation == 'display') { ?>

<div class="main">
    <div class="store">
        <form action="" method="post" onsubmit="return formcheck(this)">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center" style="width:50px;">ID</th>
								<th>分类名称</th>
								<th>链接 / 二维码</th>
								<th style="width:20%;">颜色</th>
								<th style="width:180px;">操作</th>
							</tr>
						</thead>
						<tbody>
			<?php  if(is_array($category)) { foreach($category as $row) { ?>
				<tr>
					<td class="text-center"><?php  echo $row['id'];?></td>
					<td><div class="type-parent"><?php  echo $row['title'];?></div></td>
					<td style="position:relative;">
						<span class="pull-left"><a class="btn btn-default js-clip" href="javascript:;" data-url="<?php  echo $row['link'];?>">复制链接</a></span>
						<div class="pull-left" id="q_<?php  echo $row['id'];?>">
							<?php  echo $row['qr'];?>
						</div>
						<span class="btn btn-default btn-primary btn-sm QRcode" value="<?php  echo $row['id'];?>">生成二维码</span>
					</td>
					<td>
						<span class="badge" style="background-color:<?php  if($row['color']['nav_index']) { ?><?php  echo $row['color']['nav_index'];?><?php  } else { ?>#5c6bc0<?php  } ?>">导航栏</span>
						<span class="badge" style="background-color:<?php  if($row['color']['nav_page']) { ?><?php  echo $row['color']['nav_page'];?><?php  } else { ?>#4db6ac<?php  } ?>">介绍导航栏</span>
						<span class="badge" style="background-color:<?php  if($row['color']['nav_btn']) { ?><?php  echo $row['color']['nav_btn'];?><?php  } else { ?>#5c6bc0<?php  } ?>">按钮</span>
					</td>
					<td>
						<a href="<?php  echo $this->createWebUrl('category', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default"><i class="fa fa-edit"></i> 编辑</a>
						<a href="<?php  echo $this->createWebUrl('category', array('op' => 'delete', 'id' => $row['id']))?>" class="btn btn-danger" onclick="return confirm('确认删除此分类吗？');return false;"><i class="fa fa-remove"></i> 删除</a>
					</td>
				</tr>
			<?php  } } ?>
			</tbody>
					</table>
				</div>
           </div>
		<div class="form-group col-sm-12">
			<a href="<?php  echo $this->createWebUrl('category', array('op' => 'post'))?>" class="btn btn-default btn-primary"><i class="fa fa-plus-circle"></i> 添加新分类</a>
		</div>
        </form>
<?php  echo $pager;?>
    </div>
</div>
	<script>
    $(function() {
		$(".main").delegate("span.QRcode", "click", function() {
            var a = $(this).find("i");
            var id = $(this).attr("value");
            var html = '<a href="<?php echo MODULE_URL;?>QRcode/<?php  echo $weid;?>/'+id+'.png" target="_blank"><img src="<?php echo MODULE_URL;?>QRcode/<?php  echo $weid;?>/'+id+'.png" data-toggle="tooltip" data-placement="bottom" class="btn btn-xs" title="点击查看二维码" class="media-object" style="width:40px;"></a>';
            $.post('<?php  echo $this->createWebUrl('QRcode')?>', {'id': id}, function(dat) {
				document.getElementById('q_'+id).innerHTML = html;
            });
		});
	});
	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>