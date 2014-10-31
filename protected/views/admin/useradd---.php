<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 用户增加';
$this->breadcrumbs=array(
	'用户增加',
);
?>
<style type="text/css">
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.h_y_title{ font-size:18px; font-weight:700; width:200px; text-align:center; height:50px; line-height:50px;}
.h_y_name{ height:50px; line-height:50px;}
.h_y_name li{float:left; margin-right:20px;}
.h_y_botton{padding-left:80px; padding-top:20px;}
</style>
<dl class="h_flm">
	<dt>用户增加</dt>
	<dt><a href="index.php?r=admin/user">用户列表</a></dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form',	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),)); ?>

<div class="h_y_title">用户增加</div>
<div class="h_y_name">
	<li>用户名：</li>
	<li><?php echo $form->textField($users,'username'); ?></li>
	<li><?php echo $form->error($users,'username'); ?></li>
</div>
<div class="clear"></div>

<?php if ($where !== "edit"){?>
<div class="h_y_name">
	<li>密　码：</li>
	<li><?php echo $form->textField($users,'password'); ?></li>
	<li><?php echo $form->error($users,'password'); ?></li>
</div>
<div class="clear"></div>
<?php }?>

<div class="h_y_name">
	<li>用户组：</li>
	<li><?php echo $form->dropDownlist($users,'role',$htmlOptions=array('1'=>'医生','2'=>'专家','3'=>'管理员')); ?></li>
	<li><?php echo $form->error($users,'role'); ?></li>
</div>
<div class="clear"></div>
<?php if ($where !== "edit"){?>
<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/useradd'));; ?></div>
<?php
}else{
	?>
<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => "index.php?r=admin/userupdate&id={$users->id}"));; ?></div>
<?php
}
?>

<?php $this->endWidget(); ?>