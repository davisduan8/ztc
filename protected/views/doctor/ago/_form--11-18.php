<?php 
/**
 *定义数组使radio的样式不用换行
 */		
$tplarray=array('template'=>'{input} {label}','separator'=>'&nbsp;&nbsp;');
?>

<div class="box_ri_con">

<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform','enctype'=>'multipart/form-data')));  ?>

	<?php echo CHtml::errorSummary($model); ?>
<table width="0" border="0">
    	<tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_name') ?>:</td>
	    <td><?php echo $form->textField($model,'p_name',array('maxlength'=>40,'class'=>'inp2')); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
     <tr>
    <td align="right" valign="middle"><?php echo $form->labelEx($model,'p_sex'); ?>：</td>
    <td colspan="4">
  
      <?php echo $form->radioButtonList($model,'p_sex',array('男'=>'男', '女'=>'女'),$tplarray); ?>
      <label for="radio"></label>
    </tr>
       <tr>
	    <td align="right" valign="middle"> <?php echo $form -> labelEx($model, 'p_age') ?>:</td>
	    <td><?php echo $form->textField($model,'p_age',array('class'=>'inp2','maxlength'=>40)); ?></td>
	    <td colspan="3">&nbsp;</td>
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
        <!--
      <tr>
	    <td align="right" valign="middle"> 病例资料:</td>
            <td><?php echo CHtml::activeFileField($model, 'hzfj'); ?></td>
	    <td colspan="3">&nbsp;</td>
	</tr>
       -->
          <tr>
           <?php if(!empty($model->hzfj)):?>
            
              <td align="right" valign="middle">     <?php echo CHtml::label('图片预览','') ?></td>
              <td>   <a href="<?php echo Yii::app()->basePath.'/../upload/'. $model->hzfj?>" target="_blank"> <?php echo '<img src="http://localhost/yiiztc/./upload/'.$model->hzfj.'" style="width:230px; height:230px;" />'; ?></a></td>
     
        <?php endif;?>
        </tr>
  
    <tr>
    <td align="right" valign="middle"><?php echo $form->labelEx($model,'pre_time'); ?>：</td>
    <td colspan="4">
        <?php /* echo  $form->textField($model,'pre_time',array('class'=>'date input-text','maxlength'=>40)); */ ?>
     <?php /* echo $form->textField($model,'pre_time',array('class'=>'inp2','maxlength'=>40)); */?>
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
    <!-- 
    <tr>
    <td align="right" valign="middle">选择专家：</td>
    <td colspan="4">
     <?php echo $form->textField($model,'expertid',array('class'=>'inp2','maxlength'=>20)); ?>
   　<button type="button" id="doctorid2" style="width:90px; height:25px;" class="doctorid">选择专家</button>   
    </td>
    </tr>
    -->

    <tr>
    <td align="right" valign="middle"><?php echo $form->labelEx($model,'illness'); ?>：</td>
    <td colspan="4">
     
    <?php echo $form->textArea($model,'illness',array('rows'=>5, 'cols'=>44,'style'=>" color:#5b5a5a; border:1px solid #c3c3c3")); ?>
      
    </td>
    </tr>
    

</table>
<?php  echo $form->hiddenField($model,'id',$htmlOptions=array('value'=>$model->id)); ?> 
    
<input type="hidden" name="Consultation[status]" value="待审核" />
<input type="hidden" name="Consultation[do_doctorid]" value="" />


<div class="h_y_botton"><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=doctor/addhz&cid='.$model->id)); ?></div>


<?php $this->endWidget(); ?>

</div>
