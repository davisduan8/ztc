<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加科室';
$this->breadcrumbs=array(
	'增加科室',
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
	<dt><a href="index.php?r=admin/depart">科室列表</a></dt>
	<dt>增加科室</dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="h_y_title">增加科室</div>
<div class="h_y_name">
	<li>科室名称：</li>
	<li><?php echo $form->textField($depart,'title'); ?></li>
	<li><font color='blue'><?php echo $form->error($depart,'title'); ?></font></li>
</div>

<div class="clear"></div>

<div class="h_y_botton"><?php echo $form->hiddenField($depart,'siteid',array('value'=>Yii::app()->user->siteid));?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/departadd'));; ?></div>

<?php $this->endWidget(); ?>