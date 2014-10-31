<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
		'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl.'?r=manage/index'), 
	)); ?><!-- breadcrumbs -->
<?php endif?>
<style type="text/css">
.con{width:980px; margin:0 auto; min-height:500px;}
.con .con_left{float:left; width:190px; border:1px solid #D2D2D2;}
.con .con_left p{font-size:18px; text-align:center; height:50px; line-height:50px; background-color:#68AD5C; color:#FFFFFF; margin:0px; border-bottom:1px solid #FFFFFF; border-top:1px solid #FFFFFF;}
.con .con_left ul{list-style-type:none; margin:0px; padding:0px;}
.con .con_left ul li{height:45px; list-style-type:none; width:190px; border-top:1px solid #D2D2D2; line-height:45px; text-indent:50px; background:url(/images/sanj.gif) #F3F3F3 10% no-repeat;}
.con .con_left ul li a{text-decoration:none; color:#000000;}
.con .con_left ul li a:hover{color:#FF6600;}
.con .con_right{float:right; width:780px; background-color:#FFFFFF;}
</style>
<div class="con">
	<div class="con_left">
		<p>栏目导航</p>
		<ul>
            <li><a href="./index.php?r=manage/site">站点管理</a></li>
            <li><a href="./index.php?r=manage/user">用户管理</a></li>
			<li><a href="./index.php?r=manage/useradd">新建用户</a></li>
			<li><a href="./index.php?r=manage/departzl">问诊准备</a></li>
			<li><a href="./index.php?r=manage/depart">科室管理</a></li>
			<li><a href="./index.php?r=manage/editps">修改密码</a></li>
		</ul>
	</div>
	<div class="con_right">
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>