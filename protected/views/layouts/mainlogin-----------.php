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
</head>

<body>
<style type="text/css">
.duan_login_body{background:url(/images/rcDVAkOLgZ_03.gif) left top repeat-x; padding-top:129px;}
.duan_login_bottom{line-height:20px; text-align:center; color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:30px; padding-top:120px;}
</style>
<div class="duan_login_body">
	<?php echo $content; ?>
	<div class="duan_login_bottom">
		Copyright © <?php echo date('Y'); ?>北京金卫医康科技有限公司 版权所有(KingWay Medical Technology Co.Ltd).<br/>
		公司地址：北京海淀区中关村南大街48号九龙商务中心A座802 电话：010-62165190 传真：010-61265325.<br/>
	</div>
</div>
</body>
</html>
