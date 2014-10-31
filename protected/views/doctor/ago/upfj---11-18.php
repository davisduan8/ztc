<?php
$this->breadcrumbs=array(
	'申请会诊',
);
?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}
.grid-view table.items #yw0_c0{width:70px;}
</style>
<dl class="h_flm">
	<dt>申请常规会诊</dt>
</dl>
<div style="float: right; width: auto; margin-top:10px;">
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  1.填写信息</span>
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid orange; color: orange;">
  2.上传资料</span>
<span style="display: block; width: 120px; border-right: 1px solid rgb(204, 204, 204); text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  3.选择专家</span>
  <span style="display: block; width: 120px; text-align: center; float: left; border-bottom: 3px solid rgb(204, 204, 204);">
  4.完成申请</span>
</div>
<div style="clear:both;"></div>
 <!-- 结束-->
<div style="color:blue;font:bold;font-size:16px;text-align:center; ">
    <?php 
        if(Yii::app()->user->hasFlash('success')){
            echo Yii::app()->user->getFlash('success');
        }
    
    ?>
</div>

<?php /* echo $this->renderPartial('_fj', array('model'=>$info)); */?>

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

