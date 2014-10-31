<?php
$this->breadcrumbs=array(
	'待处理会诊',
);
?>
<div class="clearfix part1">
	<p>
		<label class="btn1 btn_cur">待处理列表</label> 
	</p>
</div>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->searchDL(),
	//'dataProvider'=>$model->with('ZtcHospital')->searchDL(),
	
	//'filter'=>$model,
       // 'cssFile'=>'http://tr.kw120.com/css/gridstyles.css',
	'summaryText'=>'',
    'cssFile'=>'/css/duan.css',
	'columns'=>array(
		array(
			'header'=>'申请医院',
			//'name'=>'ZtcHospital.h_name',
			'name'=>'hospitalid',
			'value'=>'$data->hospitalid == null? $data->hospitalid:$data->getInfo($data->hospitalid)',
			//'value'=>'$data->getInfo($data->hospitalid)?$data->getInfo($data->hospitalid):"0"',
	
		    
		),
		array(
			'header'=>'患者姓名',
			'name'=>'p_name',
			'type'=>'raw',
		),
	
		array(
			'header'=>'预约时间',
			'name'=>'pre_time',
			//'type'=>'date',
			//'filter'=>false,
		),
		
		array(
			'header'=>'申请时间',
			'name'=>'creattime',
			'type'=>'date',
			//'filter'=>false,
		),
        array(
			'header'=>'预约状态',
			'name'=>'status',
			'type'=>'raw',
  		),
		 array(
			'class'=>'CLinkColumn',
			'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'操作',
			'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			'imageUrl'=>Yii::app()->request->baseUrl . '/images/hz.gif',
			'urlExpression' => 'Yii::app()->createURL("expert/exview",array("id"=>$data->id))',
		),

	),
    	'template'=>'{items}{pager}',
    	'pager'=>array(
			//'class'=>'CLinkPager',
			'header'=>'',//去掉翻页
			'cssFile'=>'/css/duan.css',
			//'pageSize'=>'10',
		),
)); ?>
