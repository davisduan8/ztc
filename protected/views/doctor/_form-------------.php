<?php 
/**
 *定义数组使radio的样式不用换行
 */		
$tplarray=array('template'=>'{input} {label}','separator'=>'&nbsp;&nbsp;');
?>
<br />


<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),'htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data')));  ?>

	<?php echo CHtml::errorSummary($model); ?>
<table width="0" border="0">
    <tr>
	    <td align="right" valign="middle"> <?php echo $form -> label($model, 'p_name') ?>:</td>
	    <td><?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'inp2')); ?></td>
	    <td id="jl"><font color='blue'><?php echo $form->error($model,'p_name'); ?></font></td>
	</tr>
	<tr>
	    <td align="right" valign="middle"> <?php echo $form -> label($model, 'p_ename') ?>:</td>
	    <td><?php echo $form->textField($model,'p_ename',array('maxlength'=>40,'class'=>'inp2')); ?></td>
	    <td id="jl"><font color='blue'><?php echo $form->error($model,'p_ename'); ?></font></td>
	</tr>
    <tr>
		<td align="right" valign="middle"><?php echo $form->labelEx($model,'p_sex'); ?>：</td>
		<td colspan="4"><?php echo $form->radioButtonList($model,'p_sex',array('男'=>'男', '女'=>'女'),$tplarray); ?>
    </tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_age') ?>:</td>
	    <td><?php echo $form->textField($model,'p_age',array('maxlength'=>40,'size'=>10)); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
	</tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'depart_id') ?>:</td>
	    <td><?php 
	$connection=Yii::app()->db;   
	$command=$connection->createCommand('select id,title from ztc_depart where siteid is null or siteid='.Yii::app()->user->siteid.' order by id asc');
	$rows=$command->queryAll();
	
	foreach ( $rows as $vo)
	{
		$vals[$vo['id']]=$vo['title'];
	}
	echo $form->dropDownlist($model,'depart_id',$htmlOptions=$vals);
	//echo $form->textField($doctor,'departid'); 
	?></td>
	    <td colspan="3"><?php echo $form->error($model,'depart_id'); ?></td>
	</tr>
        <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_card') ?>:</td>
	    <td><?php echo $form->textField($model,'p_card',array('class'=>'inp2','maxlength'=>40)); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_mobile') ?>:</td>
	    <td><?php echo $form->textField($model,'p_mobile',array('class'=>'inp2','maxlength'=>40)); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>

    <tr>
		<td align="right" valign="middle"><?php echo $form->labelEx($model,'pre_time'); ?>：</td>
		<td colspan="4">
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
						 'class'=>'inp2',
						 //'style'=>'height:18px',  
						 'maxlength'=>8,  
					),  
				));  
			 ?>
		</td>
    </tr>

    <tr>
		<td align="right" valign="middle"><?php echo $form->labelEx($model,'illness'); ?>：</td>
		<td colspan="4"><?php echo $form->textArea($model,'illness',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></td>
    </tr>
    <tr>
		<td align="right" valign="middle"><?php echo $form->labelEx($model,'hzmd'); ?>：</td>
		<td colspan="4"><?php echo $form->textArea($model,'hzmd',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?></td>
    </tr>
    <tr>
    	<td>医学影像：</td>
    	<td><?php echo $form->textArea($model,'dicompic',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3",'id'=>'dicompic')); ?></td>
    </tr>

</table>
<?php  echo $form->hiddenField($model,'id',$htmlOptions=array('value'=>$model->id)); ?> 
<?php  echo $form->hiddenField($model,'siteid',$htmlOptions=array('value'=>Yii::app()->user->siteid)); ?> 
<?php  echo $form->hiddenField($model,'hospitalid',$htmlOptions=array('value'=>$model->hospitalid)); ?>    
<input type="hidden" name="Consultation[status]" value="待审核" />
<input type="hidden" name="Consultation[do_doctorid]" value="" />


<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/addhz&cid='.$model->id)); ?></div>


<?php $this->endWidget(); ?>

