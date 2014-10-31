<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 完善资料';
$this->breadcrumbs=array(
	'完善资料',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">修改资料</span>
	</p>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="clearfix form_box">
    <label>申请医院：</label>
    <?php echo $form->textField($doctor,'hospital',array('class'=>'form_txt1')); ?>
  </div>

  <div class="clearfix form_box">
    <label>联系人：</label>
    <?php echo $form->textField($doctor,'dname',array('class'=>'form_txt1')); ?>
  </div>

  <div class="clearfix form_box">
    <label>联系手机：</label>
    <?php echo $form->textField($doctor,'moblie',array('class'=>'form_txt1')); ?>
  </div>

  <div class="clearfix form_box">
    <label>电子邮箱：</label>
    <?php echo $form->textField($doctor,'email',array('class'=>'form_txt1')); ?>
  </div>

<div class="tj_btn tj_btn2"><?php  echo $form->hiddenField($doctor,'userid',$htmlOptions=array('value'=>$userid)); ?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=doctor/xginfo&id='.$userid));; ?></div>


<?php $this->endWidget(); ?>