<?php
$this->breadcrumbs=array(
	'待处理会诊',
);
?>

<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}
</style>
<dl class="h_flm">
	<dt>待处理会诊</dt>
</dl>
<div style="clear:both"></div>
<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'申请端',
			'name'=>'hospitalid',
			//'value'=>'$data->getInfo($data->hospitalid)',
		//'value'=>'(($data->getInfo($data->hospitalid)?$data->getInfo($data->hospitalid):"空")?$data->getInfo($data->hospitalid):"空")',
		'value'=>'$data->hospitalid == null? $data->hospitalid:$data->getInfo($data->hospitalid)',
		),
		array(
			'header'=>'患者姓名',
			'name'=>'p_name',
			'type'=>'raw',
		),
        array(
			'header'=>'预约状态',
			'name'=>'status',
			'type'=>'raw',
  		),
  		array(
			'header'=>'申请时间',
			'name'=>'pre_time',
			'type'=>'date',
			'filter'=>false,
		),
          
		array(
			'class'=>'CLinkColumn',
			//'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'查看',
			//'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			'label'=>'查看',
			//'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
			'urlExpression' => 'Yii::app()->createURL("doctor/viewsq",array("cid"=>$data->id))',
		),
		
		array(
			'class'=>'CLinkColumn',
			//'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'修改',
			//'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			'label'=>'修改',
			//'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
			'urlExpression' => 'Yii::app()->createURL("doctor/editsq",array("cid"=>$data->id))',
		),
	),
)); ?>
