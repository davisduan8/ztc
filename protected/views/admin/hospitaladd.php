<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 增加医院';
$this->breadcrumbs=array(
	'增加医院',
);
?>
<div class="clearfix part1">
	<p>
		<a href="index.php?r=admin/hospital" class="btn1">医院列表</a>
		<a href="#" class="btn2 btn_cur">增加医院</a>
	</p>
</div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="form1 mt20">
	<strong class="form_tit">增加医院名称</strong>
	<div class="clearfix form_box">
		<label>医院名称：</label>
		<?php echo $form->textField($hospital,'h_name',array('class'=>'form_txt1')); ?><?php echo $form->error($hospital,'h_name'); ?>
	</div>
	<div class="tj_btn tj_btn2"><?php echo $form->hiddenField($hospital,'siteid',array('value'=>Yii::app()->user->siteid));?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=admin/hospitaladd'));; ?></div>
</div>

<?php $this->endWidget(); ?>