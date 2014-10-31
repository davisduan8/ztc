<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ztc_tjhz.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
 <!--
 function ExChgClsName(Obj,NameA,NameB){
  var Obj=document.getElementById(Obj)?document.getElementById(Obj):Obj;
  Obj.className=Obj.className==NameA?NameB:NameA;
 }
 function showMenu(iNo){
 ExChgClsName("Menu_"+iNo,"MenuBox","MenuBox2");
 }
-->
</script>

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/site/index')),
				array('label'=>'预约挂号', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'专家会诊', 'url'=>array('/site/contact')),
				array('label'=>'登录', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'退出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		  Copyright © <?php echo date('Y'); ?>北京金卫医康科技有限公司 版权所有(KingWay Medical Technology Co.Ltd).<br/>
		公司地址：北京海淀区中关村南大街48号九龙商务中心A座802 电话：010-62165190 传真：010-61265325.<br/>
		<?php /* echo Yii::powered(); */ ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
