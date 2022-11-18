<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('weheader', TEMPLATE_INCLUDEPATH)) : (include template('weheader', TEMPLATE_INCLUDEPATH));?>
	<div class="weui_msg">
		<div class="weui_icon_area"><i class="weui_icon_<?php  if($label=='success') { ?>success<?php  } ?><?php  if($label=='danger') { ?>cancel<?php  } ?><?php  if($label=='info') { ?>info<?php  } ?><?php  if($label=='warning') { ?>warn<?php  } ?> weui_icon_msg"></i></div>
					<?php  if(is_array($msg)) { ?>
		<div class="weui_text_area">
			<h2 class="weui_msg_title">MYSQL 错误：</h2>
			<p class="weui_msg_desc"><?php  echo cutstr($msg['sql'], 300, 1);?></p>
			<p class="weui_msg_desc"><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
		</div>
					<?php  } else { ?>
		<div class="weui_text_area">
			<h2 class="weui_msg_title"><?php  echo $info;?></h2>
			<p class="weui_msg_desc"><?php  echo $caption;?></p>
			<p class="weui_msg_desc"><?php  echo $msg;?></p>
		</div>
					<?php  } ?>
		<div class="weui_opr_area">
			<p class="weui_btn_area">
					<?php  if($redirect) { ?>
				<a href="<?php  echo $redirect;?>" class="weui_btn weui_btn_primary">确定</a>
					<script type="text/javascript">
						setTimeout(function () {
							location.href = "<?php  echo $redirect;?>";
						}, 3000);
					</script>
					<?php  } else { ?>
				<a href="javascript:history.back(-1);" class="weui_btn weui_btn_default">点击这里返回上一页</a>
					<?php  } ?>
			</p>
		</div>
    </div>
<?php  $footer_off = 1;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footers', TEMPLATE_INCLUDEPATH)) : (include template('footers', TEMPLATE_INCLUDEPATH));?>
