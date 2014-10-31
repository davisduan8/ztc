<?php
$this->breadcrumbs=array(
	'待处理会诊',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">待处理会诊</span>
	</p>
</div>
<?php  $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search2(),
	//'filter'=>$model,
	'summaryText'=>'',
	'cssFile'=>'/css/duan.css',
	'columns'=>array(
		array(
			'header'=>'申请医院',
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
			'label'=> '修改',
			//'imageUrl'=>Yii::app()->request->baseUrl . '/images/verify.gif',
			'urlExpression' => '$data->status == "待审核"? Yii::app()->createURL("doctor/editsq",array("cid"=>$data->id)):""',
		),

		/*array(
			'class'=>'CLinkColumn',
			'header'=>'会诊',
			'label'=>'会诊',
			'urlExpression' =>'$data->status == "已审核"?$data->getUrl(Yii::app()->user->id,strtotime($data->creattime).$data->id,Yii::app()->user->username,Yii::app()->user->role):""',
			),*/
		array(
				'header'=>'会诊',
				//'value' => 'ddd',
				'value'=>'$data->getMeetlink($data->status,$data->creattime,$data->id)',
				),
	),
	'pager'=>array(
			//'class'=>'CLinkPager',
			'header'=>'',//去掉翻页
			'cssFile'=>'/css/duan.css',
			//'pageSize'=>'10',
		),

)); ?>
