<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加内容';
$this->breadcrumbs=array(
	'增加内容',
);
?>
				<div class="clearfix part1">
					<p>
						<a href="index.php?r=manage/departzl" class="btn1 btn_cur">问诊科室</a>
						<a href="#" class="btn2">增加所需资料</a>
					</p>
				</div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kszladd-form')); ?>

<div class="form1 mt20">
					<strong class="form_tit">增加所需资料</strong>
						<div class="clearfix form_box">
							<label>问诊科室：</label>
							<?php echo $form->textField($departzl,'title',array('class'=>'form_txt1')); ?><?php echo $form->error($departzl,'title'); ?>
						</div>

						<div class="clearfix form_box">
							<label>所需资料：</label>
							<?php echo $form->textArea($departzl,'content',array('rows'=>5, 'cols'=>44,'class'=>'form_txt1')); ?><?php echo $form->error($departzl,'content'); ?>
						</div>

						<div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=manage/departzladd'));; ?></div>
</div>

<?php $this->endWidget(); ?>