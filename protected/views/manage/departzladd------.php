<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加内容';
$this->breadcrumbs=array(
	'增加内容',
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
	<dt><a href="index.php?r=manage/departzl">问诊科室</a></dt>
	<dt>增加所需资料</dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kszladd-form')); ?>

<!--<div class="h_y_title">增加科室</div>
--><div class="h_y_name">
	<li>问诊科室：</li>
	<li><?php echo $form->textField($departzl,'title'); ?></li>
	<li><font color='blue'><?php echo $form->error($departzl,'title'); ?></font></li>
</div>
<!--<div class="h_y_title">增加科室内容</div>
--><div class="h_y_name">
	<li>所需资料：</li>
	<li><?php echo $form->textArea($departzl,'content',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></li>
	<li><font color='blue'><?php echo $form->error($departzl,'content'); ?></font></li>
</div>
<div class="clear"></div>

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=manage/departzladd'));; ?></div>

<?php $this->endWidget(); ?>