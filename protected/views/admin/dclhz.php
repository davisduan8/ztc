<?php
$this->breadcrumbs=array(
	'待处理会诊',
);

?>
<div class="clearfix part1">
	<p>
		<label class="btn1 btn_cur">待处理会诊</label> 
	</p>
</div>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search3(),
	//'filter'=>$model,
	'summaryText'=>'',
    'cssFile'=>'/css/duan.css',
	'columns'=>array(
		array(
			'header'=>'申请医院',
			'name'=>'hospitalid',
			'value'=>'$data->hospitalid == null? $data->hospitalid:$data->getInfo($data->hospitalid)',
			'filter'=>false,
		),
		array(
			'header'=>'患者姓名',
			'name'=>'p_name',
			'filter'=>false,
		),
        array(
			'header'=>'预约状态',
			'name'=>'status',
			'filter'=>false,
  		),
  		array(
			'header'=>'预约时间',
			'name'=>'pre_time',
			'type'=>'date',
			'filter'=>false,
		),
		array(
			'header'=>'申请时间',
			'name'=>'creattime',
			'type'=>'date',
			'filter'=>false,
		),
            array(
			'class'=>'CLinkColumn',
			'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'操作',
			'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
			'urlExpression' => 'Yii::app()->createURL("admin/verify",array("id"=>$data->id))',
		),


	),
	'pager'=>array(
			//'class'=>'CLinkPager',
			'header'=>'',//去掉翻页
			'cssFile'=>'/css/duan.css',
			//'pageSize'=>'10',
		),
    
)); ?>
