<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加站点';
$this->breadcrumbs=array(
	'增加站点',
);
?>
				<div class="clearfix part1">
					<p>
						<a href="index.php?r=manage/site" class="btn1">站点列表</a>
						<a href="#" class="btn2 btn_cur">增加站点</a>
					</p>
				</div>
				<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'siteadd-form')); ?>
				<div class="form1 mt20">
					<strong class="form_tit">增加站点</strong>
						<div class="clearfix form_box">
							<label>站点名称：</label>
							<?php echo $form->textField($site,'sitename',array('class'=>'form_txt1')); ?>
						</div>
						
						
						<div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=manage/siteadd'));; ?></div>
				</div>
				<?php $this->endWidget(); ?>
