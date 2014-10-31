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
.login_1{ padding-top:100px; padding-bottom:100px;}
.login_1 h1{text-align:center; margin:15px;}
.login_k{margin:20px auto; width:400px;}
.login_k li{float:left; list-style-type:none; line-height:30px; height:30px;}

.clear{clear:both;}
.login_button{text-align:center;}
</style>
<div class="login_1">
<h1>用户登录</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="login_k">
	<li><?php echo $form->labelEx($model,'username'); ?>：</li>
	<li><?php echo $form->textField($model,'username'); ?></li>
	<li><?php echo $form->error($model,'username'); ?></li>
</div>
<div class="clear"></div>
<div class="login_k">
	<li><?php echo $form->labelEx($model,'password'); ?>：</li>
	<li><?php echo $form->passwordField($model,'password'); ?></li>
	<li><?php echo $form->error($model,'password'); ?></li>
</div>
<div class="clear"></div>
<div class="login_k">
	<li><?php echo $form->checkBox($model,'rememberMe'); ?>　</li>
	<li><?php echo $form->label($model,'rememberMe'); ?></li>
	<li><?php echo $form->error($model,'rememberMe'); ?></li>
</div>
<div class="clear"></div>
<div class="login_button"><?php echo CHtml::submitButton('登 陆'); ?></div>
<?php $this->endWidget(); ?>
</div>

