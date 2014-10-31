<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 用户增加';
$this->breadcrumbs=array(
	'用户增加',
);
?>
<link rel="stylesheet" type="text/css" href="/css/duan.css" />
				<div class="clearfix part1">
					<p>
						<a href="index.php?r=manage/user" class="btn1">用户列表</a>
						<a href="#" class="btn2 btn_cur">用户增加</a>
					</p>
				</div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'useradd-form',	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),)); ?>

<div class="form1 mt20">
					<strong class="form_tit">用户增加</strong>
						<div class="clearfix form_box">
							<label>用户名：</label>
							<?php echo $form->textField($users,'username',array('class'=>'form_txt1')); ?>
						</div>

						<div class="clearfix form_box">
							<label>密码：</label>
							<?php echo $form->textField($users,'password',array('class'=>'form_txt1')); ?>
						</div>

						<div class="clearfix form_box">
							<label>所属站点：</label>
							<div class="select_box z-index100">
							<?php 
							$connection=Yii::app()->db;   
							$command=$connection->createCommand('select id,sitename from ztc_site order by id desc');
							$rows=$command->queryAll();
							
							foreach ( $rows as $vo)
							{
								$vals[$vo['id']]=$vo['sitename'];
							}
							echo $form->dropDownlist($users,'siteid',$htmlOptions=$vals,array('class'=>'myselect0301'));
							//echo $form->textField($doctor,'departid'); 
							?>
							</div>
						</div>

						<div class="clearfix form_box">
							<label>用户组：</label>
							<div class="select_box z-index100">
							<?php echo $form->dropDownlist($users,'role',$htmlOptions=array('3'=>'管理员','99'=>'账户超管'),array('empty'=>'-请选择-','class'=>'myselect0301')); 	?>
							</div>
						</div>

						<div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=manage/useradd'));; ?></div>
</div>


<?php $this->endWidget(); ?>
