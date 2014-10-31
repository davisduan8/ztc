<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 完善资料';
$this->breadcrumbs=array(
	'完善资料',
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
	<dt>完善资料</dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="h_y_name">
	<li>真实姓名：</li>
	<li><?php echo $form->textField($doctor,'dname'); ?></li>
	<li><?php echo $form->error($doctor,'dname'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>性　　别：</li>
	<li><?php echo $form->textField($doctor,'sex'); ?></li>
	<li><?php echo $form->error($doctor,'sex'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>年　　龄：</li>
	<li><?php echo $form->textField($doctor,'age'); ?></li>
	<li><?php echo $form->error($doctor,'age'); ?></li>
</div>
<div class="clear"></div>


<div class="h_y_name">
	<li>联系手机：</li>
	<li><?php echo $form->textField($doctor,'moblie'); ?></li>
	<li><?php echo $form->error($doctor,'moblie'); ?></li>
</div>
<div class="clear"></div>


<div class="h_y_name">
	<li>电子邮箱：</li>
	<li><?php echo $form->textField($doctor,'email'); ?></li>
	<li><?php echo $form->error($doctor,'email'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>所属医院：</li>
	<li>
	<?php 
	$connection=Yii::app()->db;   
	$command=$connection->createCommand('select id,h_name from ztc_hospital where siteid='.Yii::app()->user->siteid.' order by id asc');
	$rows=$command->queryAll();
	
	foreach ( $rows as $vo)
	{
		$val[$vo['id']]=$vo['h_name'];
	}
	echo $form->dropDownlist($doctor,'hospitalid',$htmlOptions=$val);
	//echo $form->textField($doctor,'hospitalid'); 
	?></li>
	<li><?php echo $form->error($doctor,'hospitalid'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>所属科室：</li>
	<li>
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
	?></li>
	<li><?php echo $form->error($doctor,'departid'); ?></li>
</div>
<div class="clear"></div>

<?php echo $form->hiddenField($doctor,'userid',$htmlOptions=array('value'=>$userid));?> 

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/userdetail_1&id='.$userid));; ?></div>


<?php $this->endWidget(); ?>