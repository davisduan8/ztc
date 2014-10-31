<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 医院列表';
$this->breadcrumbs=array(
	'医院列表',
);
?>
<div class="clearfix part1">
	<p>
		<a href="#" class="btn1 btn_cur">医院列表</a>
		<a href="index.php?r=admin/hospitaladd" class="btn2">增加医院</a>
	</p>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$hospital->search(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'cssFile'=>'/css/duan.css',
		'summaryText'=>'',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'医院名称','name'=>'h_name'),
			/*array(
				'header'=>'操作',
				'value'=>'$data->getdellink($data->siteid)',
				),
				*/
			array(     
				'header'=>'操作',
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'template'=>'{delete}',
				'deleteButtonUrl'=>'Yii::app()->createUrl("admin/hospitaldel",array("id"=>$data->id))',    
				), 
		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>