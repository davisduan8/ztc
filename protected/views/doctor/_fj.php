<?php $form=$this->beginWidget('CActiveForm', array(  
    'id'=>'user-form',  
    'enableAjaxValidation'=>false,  
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),  
)); ?>  
<div class="row">  
   <?php /*echo $form->labelEx($model,'des'); */echo "文件上传：";?>  
   <?php echo CHtml::activeFileField($model,'des'); ?>  
    <?php echo $form->error($model,'des'); ?>  
</div> 

<div class="row buttons">  
        <?php echo CHtml::submitButton($model->isNewRecord ? '立即创建' : '保存修改'); ?>  
</div>  
 <?php $this->endWidget(); ?>  



<div class="row">  
       <?php echo '图片预览'; ?>  
 
  <a href="<?php echo Yii::app()->basePath.'/../uploads/'. $model->des?>" target="_blank"> <?php echo '<img src="http://ztc2.kw120.com/./uploads/'.$model->des.'" style="width:230px; height:230px;" />'; ?></a></td>
</div>  

<input type="hidden" name="cid" value="<?php echo $_GET['cid']?>">