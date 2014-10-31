<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<!-- header -->
	<div class="header">
		<h1 class="logo fl" title="专家直通车"><a href="#">专家直通车</a></h1>
		<div class="user_name">
			<a href="/index.php?r=site/logout" class="exit" title="退出">退出</a>
			<em>欢迎您！<?php 
	if (Yii::app()->user->role ==1){
		echo"直通车科室";
	}else if(Yii::app()->user->role ==2){
		echo"会诊专家";
	}else if(Yii::app()->user->role ==3){
		echo "管理员";
	}else if(Yii::app()->user->role ==99){
		echo "账户管理员";
	}else{
		echo "未知客户端";
	}

		?>：<a href="#"><?php echo Yii::app()->user->name?></a></em>
		</div>
	</div>
	<!-- end header -->
	<!-- content -->
	<div class="content clearfix">
		<?php echo $content; ?>
	</div>
	<!-- end content -->
	<!-- footer -->
	<div class="footer">
		Copyright © 2014北京金卫医康科技有限公司 版权所有(KingWay Medical Technology Co.Ltd).<br/>公司地址：北京海淀区中关村南大街48号九龙商务中心A座802 电话：010-62165190 传真：010-61265325
	</div>
	<!-- end footer -->
</body>
</html>
