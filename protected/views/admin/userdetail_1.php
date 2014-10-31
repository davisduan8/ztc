<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 完善资料';
$this->breadcrumbs=array(
	'完善资料',
);
?>
<link rel="stylesheet" type="text/css" href="/css/duan.css" />
<div class="clearfix part1">
	<p>
		<label class="btn2 btn_cur">完善资料</label>
	</p>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

  <div class="clearfix form_box">
    <label>真实姓名：</label>
    <?php echo $form->textField($doctor,'dname',array('class'=>'form_txt1')); ?>
  </div>
  <div class="clearfix form_box">
    <label>性　　别：</label>
    <?php echo $form->textField($doctor,'sex',array('class'=>'form_txt1')); ?>
  </div>
  <div class="clearfix form_box">
    <label>年　　龄：</label>
    <?php echo $form->textField($doctor,'age',array('class'=>'form_txt1')); ?>
  </div>
  <div class="clearfix form_box">
    <label>联系手机：</label>
    <?php echo $form->textField($doctor,'moblie',array('class'=>'form_txt1')); ?>
  </div>

  <div class="clearfix form_box">
    <label>电子邮箱：</label>
    <?php echo $form->textField($doctor,'email',array('class'=>'form_txt1')); ?>
  </div>

  <div class="clearfix form_box">
    <label>所属医院：</label>
    <?php 
	$connection=Yii::app()->db;   
	$command=$connection->createCommand('select id,h_name from ztc_hospital where siteid='.Yii::app()->user->siteid.' order by id asc');
	$rows=$command->queryAll();
	

	foreach ( $rows as $vo)
	{
		$val[$vo['id']]=$vo['h_name'];
	}
  if($val){
    echo $form->dropDownlist($doctor,'hospitalid',$htmlOptions=$val);
  }else{
    echo "必须先添加医院！";
  }
	
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
	echo $form->dropDownlist($doctor,'departid',$htmlOptions=$vals);
	//echo $form->textField($doctor,'departid'); 
	?>
  </div>

<div class="tj_btn tj_btn2"><?php echo $form->hiddenField($doctor,'userid',$htmlOptions=array('value'=>$userid));?> <?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=admin/userdetail_1&id='.$userid));; ?></div>


<?php $this->endWidget(); ?>