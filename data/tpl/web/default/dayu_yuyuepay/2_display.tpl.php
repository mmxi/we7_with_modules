<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	h4{padding:3px 0;margin:0;}
<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('display', array('op' => 'simple'))?>">预约列表</a></li>
    <li><a href="<?php  echo $this->createWebUrl('post')?>">新建预约主题</a></li>
</ul>
<div class="panel panel-info">
				</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>