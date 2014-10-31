<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加科室';
$this->breadcrumbs=array(
	'增加科室',
);
?>
				<div class="clearfix part1">
					<p>
						<a href="index.php?r=manage/depart" class="btn1">科室列表</a>
						<a href="#" class="btn2 btn_cur">增加科室</a>
					</p>
				</div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="form1 mt20">
					<strong class="form_tit">增加站点</strong>
						<div class="clearfix form_box">
							<label>站点名称：</label>
							<?php echo $form->textField($depart,'title',array('class'=>'form_txt1')); ?><?php echo $form->error($depart,'title'); ?>
						</div>
						<div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=manage/departadd'));; ?></div>
</div>

<?php $this->endWidget(); ?>