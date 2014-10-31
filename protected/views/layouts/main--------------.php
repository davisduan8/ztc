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
<style type="text/css">
body{background-color:#FFFFFF;}
.duan_con{width:980px; margin:0 auto;}
.con_header{height:64px; line-height:64px; border-bottom:1px solid #CFCFCF; background-color:#F8F8F8;}
.duan_header_logo{float:left;}
.duan_header_logout{float:right; height:64px; margin-right:50px;}
.breadcrumbs{height:40px; line-height:40px;}

.con_foot{text-align:center; line-height:25px; padding:20px 0px 20px 0px;border-top:1px solid #CFCFCF; background-color:#F8F8F8;}
</style>
<div class="con_header">
<div class="duan_con">
	<div class="duan_header_logo"><img src="/images/logo.gif" alt="<?php echo CHtml::encode(Yii::app()->name); ?>" border="0" /></div>
	<div class="duan_header_logout">欢迎您：
	<?php 
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

		?>：<?php echo Yii::app()->user->name?> 　　<a href="/index.php?r=site/logout">退出登录</a></div>
</div>
</div>
<div style="clear:both"></div>

<div class="duan_con">
<?php echo $content; ?>
</div>
<div style="clear:both"></div>

<div class="con_foot">
	  Copyright © <?php echo date('Y'); ?>北京金卫医康科技有限公司 版权所有(KingWay Medical Technology Co.Ltd).<br/>
	公司地址：北京海淀区中关村南大街48号九龙商务中心A座802 电话：010-62165190 传真：010-61265325.<br/>
</div><!-- footer -->

</div><!-- page -->

</body>
</html>
