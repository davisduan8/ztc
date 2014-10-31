<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 排班列表';
$this->breadcrumbs=array(
	'排班列表',
);
?>
<style type="text/css">
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.h_y_title{ font-size:18px; font-weight:700; width:200px; text-align:center; height:50px; line-height:50px;}
.h_y_name{ height:50px; line-height:50px;}
.h_y_name li{float:left; margin-right:20px;}
.h_y_botton{padding-left:80px; padding-top:20px;}

.hasDatepicker{padding-top:2px;vertical-align:middle;}
.ui-datepicker-trigger{vertical-align:middle; margin-left:10px;}
</style>
<dl class="h_flm">
	<dt><a href="index.php?r=admin/paiban">近期排班表</a></dt>
	<dt>排班安排</dt>
</dl>
<div style="clear:both"></div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paibanadd-form','enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),)); ?>

<div class="h_y_title">排班安排</div>
<div class="h_y_name">
	<li>排班日期：</li>
	<li>
	<?php
      $this->widget('zii.widgets.jui.CJuiDatePicker',array( 
          'language'=>'zh_cn',  
          'attribute' => 'dateid',
          'model'=>$model,
          'name'=>$model->dateid,  
          'options'=>array(  
                        'showAnim'=>'fold',  
                        'showOn'=>'both',  
                        'buttonImage'=>Yii::app()->request->baseUrl.'/images/date.gif',  
                        'Date'=>'new Date()',
                        'buttonImageOnly'=>true,  
                        'dateFormat'=>'yy-mm-dd', 
						'maxDate'=>'10',
						'minDate'=>'0',
            ), 
		  'htmlOptions'=>array(  
            'readonly'=>'readonly',  
            'style'=>'width:120px;',  
        )   
    ));  
     ?>
	</li>
	<li><font color="blue"><?php  echo $form->error($model,'dateid'); ?></font></li>
</div>

<div class="clear"></div>
<div class="h_y_name">
	<li>选择：</li>
	<li><?php echo $form->dropDownList($model, 'item', array('1' => '上午', '2' => '下午')); ?></li>
</div>
<div class="clear"></div>
<div class="h_y_name">
	<li>选择专家：</li>
	<li><?php 
	$connection=Yii::app()->db;   
	//$command=$connection->createCommand('select userid,ename from ztc_expert order by userid asc');
	$command=$connection->createCommand('select b.userid,b.ename,a.siteid from ztc_user as a left join ztc_expert as b on a.id=b.userid where a.siteid='.Yii::app()->user->siteid.' and role=2 order by a.id asc');
	$rows=$command->queryAll();
	if($rows){
	foreach ( $rows as $vo)
	{
		$val[$vo['userid']]=$vo['ename'];
	}
	echo $form->checkBoxList($model,"zjdata",$val); 
	}
	?></li>
	<li><font color="blue"><?php echo $form->error($model,'zjdata'); ?></font></li>
</div>
<div class="clear"></div>

	<?php 
	/*$connection=Yii::app()->db;   
	$command=$connection->createCommand('select userid,ename from ztc_expert order by userid asc');
	$rows=$command->queryAll();
	
	foreach ( $rows as $vo)
	{
		$val[$vo['userid']]=$vo['ename'];
	}
	echo $form->checkBoxList($model,"ename",$val); 
	*/
	?>
	
	<div class="h_y_botton"><?php echo $form->hiddenField($model,'siteid',array('value'=>Yii::app()->user->siteid)); ?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/images/tijao.gif',array('submit' => 'index.php?r=admin/paibanadd')); ?></div>
	
<?php $this->endWidget(); ?>