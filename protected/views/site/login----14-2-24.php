<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 登录页面';
$this->breadcrumbs=array(
	'Login',
);
?>

<style type="text/css">
.duan_login{width:620px; height:430px; margin:0 auto; background:url(/images/rcDVAkOLgZ_07.gif) left top no-repeat; position:relative;}
.duan_login_usr{position:absolute;left:190px; top:222px; height:30px; line-height:30px;}
.duan_login_usr input,.duan_login_pass input{border:none;}
.duan_login_pass{position:absolute;left:190px; top:275px; height:30px; line-height:30px;}
.duan_login_rem{position:absolute;left:167px; top:330px;}
.duan_login_login{position:absolute;left:387px; top:227px;}
.duan_login_biaoji_1{position:absolute;left:187px; top:250px; font-size:9px; font-family:Arial, Helvetica, sans-serif; color:#F07019;}
.duan_login_biaoji_2{position:absolute;left:187px; top:305px; font-size:9px; font-family:Arial, Helvetica, sans-serif; color:#F07019;}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="duan_login">
	<div class="duan_login_usr"><?php echo $form->textField($model,'username'); ?></div>
	<div class="duan_login_pass"><?php echo $form->passwordField($model,'password'); ?></div>
	<div class="duan_login_rem"><?php echo $form->checkBox($model,'rememberMe'); ?></div>
	<div class="duan_login_login"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/login.gif',array('submit' => 'index.php?r=site/login'));; ?></div>
	<div class="duan_login_biaoji_1"><?php echo $form->error($model,'username'); ?></div>
	<div class="duan_login_biaoji_2"><?php echo $form->error($model,'password'); ?></div>
</div>
<?php $this->endWidget(); ?>
