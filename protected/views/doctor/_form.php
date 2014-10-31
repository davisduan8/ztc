<?php 
/**
 *定义数组使radio的样式不用换行
 */		
$tplarray=array('template'=>'<span class=dian_btn>{input} {label}</span>','separator'=>'&nbsp;&nbsp;');
?>
<br />
<link rel="stylesheet" type="text/css" href="/css/duan.css"/>

<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),'htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data')));  ?>

	<?php echo CHtml::errorSummary($model); ?>
	<div class="clearfix form_box form_box2">
		<label>患者姓名：</label>
		<?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'form_txt1')); ?>
	</div>
	<div class="clearfix form_box form_box2">
		<label>英文姓名：</label>
		<?php echo $form->textField($model,'p_ename',array('maxlength'=>40,'class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box form_box2">
		<label>患者性别：</label>
		<?php echo $form->radioButtonList($model,'p_sex',array('男'=>'男', '女'=>'女'),$tplarray); ?>
	</div>

	<div class="clearfix form_box form_box2">
		<label>患者年龄：</label>
		<?php echo $form->textField($model,'p_age',array('maxlength'=>40,'class'=>'form_txt1')); ?>
	</div>

	<div class="clearfix form_box form_box2">
		<label>预约科室：</label>
		<div class="select_box0301 z-index100">
		<?php 
		$connection=Yii::app()->db;   
		$command=$connection->createCommand('select id,title from ztc_depart where siteid is null or siteid='.Yii::app()->user->siteid.' order by id asc');
		$rows=$command->queryAll();
		
		foreach ( $rows as $vo)
		{
			$vals[$vo['id']]=$vo['title'];
		}
		echo $form->dropDownlist($model,'depart_id',$htmlOptions=$vals,array('class'=>'myselect0301'));
		//echo $form->textField($doctor,'departid'); 
		?>
		</div>
	</div>

	<div class="clearfix form_box form_box2">
		<label>身份证号：</label>
		<?php echo $form->textField($model,'p_card',array('maxlength'=>40,'class'=>'form_txt1')); ?>
	</div>
	<div class="clearfix form_box form_box2">
		<label>手机号码：</label>
		<?php echo $form->textField($model,'p_mobile',array('maxlength'=>40,'class'=>'form_txt1')); ?>
	</div>
	<div class="clearfix form_box form_box2">
		<label>问诊时间：</label>
		<?php
			  $this->widget('zii.widgets.jui.CJuiDatePicker',array( 
				   'language'=>'zh_cn',  
				  'attribute' => 'pre_time',
				  'model'=>$model,
				   'name'=>$model->pre_time,  
				 //  'value'=>$model->pre_time,  
					'options'=>array(  
								'showAnim'=>'fold',  
								'showOn'=>'both',  
								'buttonImage'=>Yii::app()->request->baseUrl.'/images/date.gif',  
								'Date'=>'new Date()',  
								//  'maxDate'=>'new Date()',  'minDate'=>'new Date()',  
								'buttonImageOnly'=>true,  
								'dateFormat'=>'yy-mm-dd',  
					),  
					'htmlOptions'=>array(  
						 'class'=>'form_txt1',
						 //'style'=>'height:18px',  
						 'maxlength'=>8,  
					),  
				));  
			 ?>
	</div>
	<div class="clearfix form_box form_box2">
		<label>病情描述：</label>
		<?php echo $form->textArea($model,'illness',array('rows'=>3, 'cols'=>44,'class'=>'form_txt10301')); ?>
	</div>
	<div class="clearfix form_box form_box2">
		<label>会诊目的：</label>
		<?php echo $form->textArea($model,'hzmd',array('rows'=>3, 'cols'=>44,'class'=>'form_txt10301')); ?>
	</div>
	<div class="clearfix form_box form_box2" style="display:none;">
		<label>医学影像：</label>
		<?php echo $form->textArea($model,'dicompic',array('rows'=>3, 'cols'=>44,'class'=>'form_txt10301','id'=>'dicompic')); ?>
	</div>

	<?php  echo $form->hiddenField($model,'id',$htmlOptions=array('value'=>$model->id)); ?> 
	<?php  echo $form->hiddenField($model,'siteid',$htmlOptions=array('value'=>Yii::app()->user->siteid)); ?> 
	<?php  echo $form->hiddenField($model,'hospitalid',$htmlOptions=array('value'=>$model->hospitalid)); ?>    
	<input type="hidden" name="Consultation[status]" value="待审核" />
	<input type="hidden" name="Consultation[do_doctorid]" value="" />


<div class="tj_btn tj_btn2"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=doctor/addhz&cid='.$model->id)); ?></div>

</div>

<?php $this->endWidget(); ?>

