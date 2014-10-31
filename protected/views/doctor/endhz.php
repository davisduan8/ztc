<?php
$this->breadcrumbs=array(
	'已完成会诊',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">已完成会诊</span>
	</p>
</div>
<?php 
 $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
      //  'cssFile'=>'http://tr.kw120.com/css/gridstyles.css',
	'summaryText'=>'',
	'cssFile'=>'/css/duan.css',
	'columns'=>array(
		array(
			'header'=>'申请医院',
			'name'=>'hospitalid',
		'value'=>'$data->hospitalid == null? $data->hospitalid:$data->getInfo($data->hospitalid)',
			//'value'=>'$data->getInfo($data->hospitalid)',
			'type'=>'raw',
		),
		array(
			'header'=>'患者姓名',
			'name'=>'p_name',
			'type'=>'raw',
		),
		array(
			'header'=>'会诊时间',
			'name'=>'end_time',
			'type'=>'date',
			'filter'=>false,
		),
		
       array(
			'header'=>'预约状态',
			'name'=>'status',
			'type'=>'raw',
			'filter'=>false,
  		),
		
        array(
        'class'=>'CLinkColumn',
			//'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'查看',
			//'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			'label'=>'查看',
			//'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
			'urlExpression' => 'Yii::app()->createURL("doctor/viewfinish",array("cid"=>$data->id))',
			/*'class'=>'CLinkColumn',
			'htmlOptions'=>array('class'=>'showcolumn2'),		
			'header'=>'操作',
			'linkHtmlOptions'=>array('title'=>'待处理会诊'),
			//'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
        											
			'urlExpression' => 'Yii::app()->createURL("doctor/viewfinish",array("cid"=>$data->id))',*/
		),

	),
    	'template'=>'{items}{pager}',
    	'pager'=>array(
			//'class'=>'CLinkPager',
			'header'=>'',//去掉翻页
			'cssFile'=>'/css/duan.css',
			//'pageSize'=>'10',
		),
));
?>

