<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
		'homeLink'=>CHtml::link('首页',Yii::app()->homeUrl.'?r=doctor/index'), 
	)); ?><!-- breadcrumbs -->
<?php endif?>
<style type="text/css">
.con{width:980px; margin:0 auto; min-height:500px;}
.con .con_left{float:left; width:190px; border:1px solid #D2D2D2;}
.con .con_left p{font-size:18px; text-align:center; height:50px; line-height:50px; background-color:#68AD5C; color:#FFFFFF; margin:0px; border-bottom:1px solid #FFFFFF; border-top:1px solid #FFFFFF;}
.con .con_left ul{list-style-type:none; margin:0px; padding:0px;}
.con .con_left ul li{height:60px; list-style-type:none; width:190px; border-top:1px solid #D2D2D2; line-height:60px; text-indent:50px; background:url(/images/sanj.gif) #F3F3F3 10% no-repeat;}
.con .con_left ul li a{text-decoration:none; color:#000000;}
.con .con_left ul li a:hover{color:#FF6600;}
.con .con_right{float:right; width:780px; background-color:#FFFFFF;}
</style>
<div class="con">
	<div class="con_left">
		<p>栏目导航</p>
		<ul>
			<li><a href="./index.php?r=doctor/addhz" >普通会诊</a></li>
			<li><a href="kwdicomclient://auth?un=zxj&pwd=<?php echo rand(100000,999999);?>1">影像会诊</a></li>
			<li><a href="./index.php?r=doctor/waithz">待处理会诊</a></li>
			<li><a href="./index.php?r=doctor/endhz">已完成会诊</a></li>
			<li><a href="./index.php?r=doctor/xginfo">修改资料</a></li>
			<li><a href="./index.php?r=doctor/xgps">修改密码</a></li>
			<li><a href="./index.php?r=doctor/zjlist">专家列表</a></li>
			<li><a href="./index.php?r=doctor/zjpaiban">专家排班</a></li>
			<li><a href="./index.php?r=doctor/departzl">问诊准备</a></li>
		</ul>
	</div>
	<div class="con_right">
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>