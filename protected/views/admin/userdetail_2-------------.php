<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 完善专家资料';
$this->breadcrumbs=array(
	'完善专家资料',
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
	<dt>完善专家资料</dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form')); ?>

<div class="h_y_name">
	<li>真实姓名：</li>
	<li><?php echo $form->textField($expert,'ename'); ?></li>
	<li><?php echo $form->error($expert,'ename'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>性　　别：</li>
	<li><?php echo $form->textField($expert,'sex'); ?></li>
	<li><?php echo $form->error($expert,'sex'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>年　　龄：</li>
	<li><?php echo $form->textField($expert,'age'); ?></li>
	<li><?php echo $form->error($expert,'age'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>职　　务：</li>
	<li><?php echo $form->textField($expert,'position'); ?></li>
	<li><?php echo $form->error($expert,'position'); ?></li>
</div>
<div class="clear"></div>
<div class="h_y_name">
	<li>联系手机：</li>
	<li><?php echo $form->textField($expert,'moblie'); ?></li>
	<li><?php echo $form->error($expert,'moblie'); ?></li>
</div>
<div class="clear"></div>


<div class="h_y_name">
	<li>电子邮箱：</li>
	<li><?php echo $form->textField($expert,'email'); ?></li>
	<li><?php echo $form->error($expert,'email'); ?></li>
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
	echo $form->dropDownlist($expert,'hospitalid',$htmlOptions=$val);
	?>
	</li>
	<li><?php echo $form->error($expert,'hospitalid'); ?></li>
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
	echo $form->dropDownlist($expert,'departid',$htmlOptions=$vals);
	
	?></li>
	<li><?php echo $form->error($expert,'departid'); ?></li>
</div>
<div class="clear"></div>

<div class="h_y_name">
	<li>擅　　长：</li>
	<li><?php echo $form->textArea($expert,'skilled'); ?></li>
	<li><?php echo $form->error($expert,'skilled'); ?></li>
</div>
<div class="clear"></div>
<div class="h_y_name">
	<li>简　　介：</li>
	<li><?php echo $form->textArea($expert,'intro'); ?></li>
	<li><?php echo $form->error($expert,'intro'); ?></li>
</div>
<div class="clear"></div>

<?php echo $form->hiddenField($expert,'userid',$htmlOptions=array('value'=>$userid));?> 

<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/userdetail_2&id='.$userid));; ?></div>


<?php $this->endWidget(); ?>