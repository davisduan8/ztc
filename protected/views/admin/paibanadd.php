<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 排班列表';
$this->breadcrumbs=array(
	'排班列表',
);
?>
<link rel="stylesheet" href="/css/duan.css" />
<div class="clearfix part1">
	<p>
		<a href="index.php?r=admin/paiban" class="btn1">近期排班表</a>
		<a href="#" class="btn2 btn_cur">排班安排</a>
	</p>
</div>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paibanadd-form','enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),)); ?>
<div class="form1 mt20">
	<strong class="form_tit">排班安排</strong>
	<div class="clearfix form_box">
		<label>排班日期：</label>
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
            'style'=>'width:120px',
            'class'=>'form_txt1',  
        )   
    ));  
     ?>
	</div>

	<div class="clearfix form_box select_box0301">
		<label>时间安排：</label>
		<?php echo $form->dropDownList($model, 'item', array('1' => '上午', '2' => '下午'),array('class'=>'myselect0301')); ?>
	</div>


	<div class="clearfix form_box" style="clear:both;">
		<label>选择专家：</label>
		<div class="xzzj_01">
		<?php 
		$connection=Yii::app()->db;   
		//$command=$connection->createCommand('select userid,ename from ztc_expert order by userid asc');
		$command=$connection->createCommand('select b.userid,b.ename,a.siteid from ztc_user as a left join ztc_expert as b on a.id=b.userid where a.siteid='.Yii::app()->user->siteid.' and role=2 order by a.id asc');
		$rows=$command->queryAll();
		
		//if($rows[0]['ename'])
		
		if($rows){
			foreach ( $rows as $vo)
			{
				if($vo['ename']){
					$val[$vo['userid']]=$vo['ename'];
				}
			}
			if(empty($val)){
				echo "专家未添加或未完善专家资料";
			}else{
				echo $form->checkBoxList($model,"zjdata",$val); 
			}
		}
		?>
		</div>
	</div>


	<div class="tj_btn tj_btn2"><?php echo $form->hiddenField($model,'siteid',array('value'=>Yii::app()->user->siteid)); ?><?php echo CHtml::imageButton(Yii::app()->baseUrl.'/img/tj_031.jpg',array('submit' => 'index.php?r=admin/paibanadd')); ?></div>
</div>

	
<?php $this->endWidget(); ?>