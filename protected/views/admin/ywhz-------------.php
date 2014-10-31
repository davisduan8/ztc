<?php
$this->breadcrumbs=array(
	'已完成理会诊',
);
?>

<style type="text/css">
.verify{margin-left:10px;}
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}

</style>
<dl class="h_flm">
	<dt>已完成会诊</dt>
</dl>
<div style="clear:both"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
       // 'cssFile'=>'http://tr.kw120.com/css/gridstyles.css',
	'columns'=>array(
		array(
			'header'=>'申请医院',
			'name'=>'hospitalid',
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
			'header'=>'预约时间',
			'name'=>'pre_time',
			'type'=>'date',
			'filter'=>false,
		),

		array(
			'header'=>'会诊时间',
			'name'=>'end_time',
			'type'=>'date',
			'filter'=>false,
		),
            array(
			'class'=>'CLinkColumn',
			'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'操作',
			'linkHtmlOptions'=>array('title'=>'已会诊'),
			'imageUrl'=>Yii::app()->request->baseUrl . '/images/ck.gif',
			'urlExpression' => 'Yii::app()->createURL("admin/ylist",array("id"=>$data->id))',
		),


	),
    
)); ?>
