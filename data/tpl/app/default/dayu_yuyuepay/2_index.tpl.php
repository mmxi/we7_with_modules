<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('weheader', TEMPLATE_INCLUDEPATH)) : (include template('weheader', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo TEMPLATE_WEUI;?>swipe.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_WEUI;?>picker.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_WEUI;?>select.js"></script>
<script src="<?php echo TEMPLATE_WEUI;?>iscroll.js"></script>
<script>
 $(function(){

$('#slide1').swipeSlide({
autoSwipe:true,//自动切换默认是
speed:3000,//速度默认4000
continuousScroll:true,//默认否
transitionType:'cubic-bezier(0.22, 0.69, 0.72, 0.88)',//过渡动画linear/ease/ease-in/ease-out/ease-in-out/cubic-bezier
lazyLoad:true,//懒加载默认否
firstCallback : function(i,sum,me){
            me.find('.dot').children().first().addClass('cur');
        },
        callback : function(i,sum,me){
            me.find('.dot').children().eq(i).addClass('cur').siblings().removeClass('cur');
        }
});
});
    </script>
<style type="text/css">
body{background-color:#fff;}
.swiper-container { width: 100%;} 
.swiper-container img { display: block; width: 100%;height:150px;}
<?php  if($setting['list_num']==4) { ?>
.weui_grid{width:25%;}
<?php  } ?>
.weui_panel_ft:before{height:0px;border-top:0px solid #e5e5e5;}
.weui_panel_ft span{margin-bottom:0px;}
.weui-navigator-list img {width:18px;height:18px;}
.weui-navigator-list a {font-weight:300;font-size:14px;}
.weui-navigator-list li{line-height:45px;}
</style>
<div class="weui_tab_bd">
	<?php  if(!empty($slide)) { ?>
	<div class="slide" id="slide1">
		<ul>
		<?php  if(is_array($slide)) { foreach($slide as $item) { ?>
        <li>
            <a href="<?php  echo $item['link'];?>">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="<?php  echo $item['thumb'];?>" alt="">
            </a>
            <div class="slide-desc"><?php  echo $item['title'];?></div>
        </li>
		<?php  } } ?>
		</ul>
		<div class="dot">
			<?php  if(is_array($slide)) { foreach($slide as $item) { ?>
			<span></span>
			<?php  } } ?>
		</div>
	</div>
	<?php  } ?>
	<?php  if($category) { ?>
	<div id="tagnav" class="weui-navigator weui-navigator-wrapper">
		<ul class="weui-navigator-list">
			<li class="<?php  if(empty($id)) { ?>weui-state-active<?php  } ?>"><a href="<?php  echo $this->createMobileUrl('list');?>">全部</a></li>
			<?php  if(is_array($category)) { foreach($category as $val) { ?>
			<li class="<?php  if($val['id']==$id) { ?>weui-state-active<?php  } ?>"><a href="<?php  echo $this->createMobileUrl('list', array('id' =>$val['id']));?>"><?php  if(!empty($val['icon'])) { ?><img class="circle middle" src="<?php  echo tomedia($val['icon'])?>"> <?php  } ?><?php  echo $val['title'];?></a></li>
			<?php  } } ?>
		</ul>
	</div>
	<?php  } ?>

	<?php  if($list_num==1) { ?>
	<div class="weui_panel" style="margin:0;">
		<div class="weui_panel_bd">
		<?php  if(is_array($yuyue)) { foreach($yuyue as $item) { ?>
			<div href="<?php  echo $item['link'];?>" class="weui_media_box weui_media_appmsg">
				<div class="weui_media_hd open-popup" onclick="show(<?php  echo $item['reid'];?>)" data-target="#popup">
					<img class="weui_media_appmsg_thumb radius-sm" src="<?php  echo tomedia($item['icon'])?>" alt="<?php  echo $item['subtitle'];?>">
				</div>
				<a class="weui_media_bd" href="<?php  echo $item['link'];?>">
					<h4 class="weui_media_title f-black"><?php  echo $item['subtitle'];?></h4>
					<p class="weui_media_desc"><?php  echo $item['description'];?></p>
				</a>
                <div class="weui_panel_ft">
					<span class="weui_btn weui_btn_mini weui_btn_plain_primary open-popup" onclick="show(<?php  echo $item['reid'];?>)" data-target="#popup" style="border: 1px solid <?php  if(!empty($nav_btn)) { ?><?php  echo $nav_btn;?><?php  } else { ?>#5c6bc0<?php  } ?>;color:<?php  if(!empty($nav_btn)) { ?><?php  echo $nav_btn;?><?php  } else { ?>#5c6bc0<?php  } ?>;">介绍</span>
				</div>
			</div>
		<?php  } } ?>
		</div>
	</div>
	<?php  } else { ?>
		<div class="weui_grids">
		<?php  if(is_array($yuyue)) { foreach($yuyue as $item) { ?>
			<a href="<?php  echo $item['link'];?>" class="weui_grid js_grid">
				<div class="weui_grid_icon"><img src="<?php  echo tomedia($item['icon'])?>" alt="<?php  echo $item['subtitle'];?>"></div>
                <p class="weui_grid_label"><?php  echo $item['subtitle'];?></p>
			</a>
		<?php  } } ?>
		</div>
	<?php  } ?>
</div>
<div id="popup" class="weui-popup-container" style="z-index:999;">
	<div class="weui-popup-modal"></div>
	<div class="nav"></div>
</div>
<script>
function show(id){
	$.post("<?php  echo $this->createMobileUrl('getyuyue')?>",{id:id},function(data){
		$("#popup .weui-popup-modal").html(data.message.html);
		$("#popup .nav").html(data.message.html2); 
	},"json");
}
$(function(){
    TagNav('#tagnav',{
        type: 'scrollToFirst',
    });
})
	</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footers', TEMPLATE_INCLUDEPATH)) : (include template('footers', TEMPLATE_INCLUDEPATH));?>