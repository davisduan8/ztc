<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 修改资料';
$this->breadcrumbs=array(
	'修改资料',
);
?>
<div class="clearfix part1">
	<p>
		<label class="btn1 btn_cur">修改资料</label> 
	</p>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="form1 mt20">
	<strong class="form_tit">增加科室</strong>
	<div class="clearfix form_box">
		<label>真实姓名：</label>
		<?php echo $form->textField($expert,'ename',array('class'=>'form_txt1')); ?><?php echo $form->error($expert,'ename'); ?>
	</div>
	<div class="clearfix form_box">
		<label>性　　别：</label>
		<?php echo $form->textField($expert,'sex',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>年　　龄：</label>
		<?php echo $form->textField($expert,'age',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>职务名称：</label>
		<?php echo $form->textField($expert,'position',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>学术专长：</label>
		<?php echo $form->textField($expert,'skilled',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>所属医院：</label>
		<?php 
		$connection=Yii::app()->db;   
		$command=$connection->createCommand('select id,h_name from ztc_hospital order by id asc');
		$rows=$command->queryAll();
		
		foreach ( $rows as $vo)
		{
			$val[$vo['id']]=$vo['h_name'];
		}
		echo $form->dropDownlist($expert,'hospitalid',$htmlOptions=$val);
		//echo $form->textField($doctor,'hospitalid'); 
		?>
	</div>
	
	<div class="clearfix form_box">
		<label>所属科室：</label>
		<?php 
		$connection=Yii::app()->db;   
		$command=$connection->createCommand('select id,title from ztc_depart order by id asc');
		$rows=$command->queryAll();
		
		foreach ( $rows as $vo)
		{
			$vals[$vo['id']]=$vo['title'];
		}
		echo $form->dropDownlist($expert,'departid',$htmlOptions=$vals);
		//echo $form->textField($doctor,'departid'); 
		?>
	</div>

	<div class="clearfix form_box">
		<label>联系手机：</label>
		<?php echo $form->textField($expert,'moblie',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>电子邮箱：</label>
		<?php echo $form->textField($expert,'email',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>擅　　长：</label>
		<?php echo $form->textArea($expert,'skilled',array('class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box">
		<label>简　　介：</label>
		<?php echo $form->textArea($expert,'intro',array('class'=>'form_txt1')); ?>
	</div>


	<div class="tj_btn tj_btn2"><?php echo $form->hiddenField($expert,'userid',$htmlOptions=array('value'=>$userid));?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=expert/exdzl&id='.$userid));; ?></div>
</div>

<?php $this->endWidget(); ?>