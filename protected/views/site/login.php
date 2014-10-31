<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 登录页面';
$this->breadcrumbs=array(
	'Login',
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
		<table class="log_table">
			<tr>
				<td width="135" align="right"><label>用户名：</label></td>
				<td><?php echo $form->textField($model,'username',array('class'=>'log_inp')); ?></td>
			</tr>
			<tr>
				<td align="right"><label>密  码：</label></td>
				<td><?php echo $form->passwordField($model,'password',array('class'=>'log_inp')); ?></td>
			</tr>
			<tr>
				<td></td>
				<td class="pt15">
					<a href="#" class="log_btn"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/dl_0224.jpg',array('submit' => 'index.php?r=site/login'));; ?></a>
					<em><?php echo $form->checkBox($model,'rememberMe'); ?>  记住密码</em>
				</td>
			</tr>
		</table>
<?php $this->endWidget(); ?>
