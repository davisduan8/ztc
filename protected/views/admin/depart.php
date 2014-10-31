<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 科室列表';
$this->breadcrumbs=array(
	'科室列表',
);
?>
<div class="clearfix part1">
	<p>
		<a href="#" class="btn1 btn_cur">科室列表</a>
		<a href="index.php?r=admin/departadd" class="btn2">增加科室</a>
	</p>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$depart->sitesearch(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'cssFile'=>'/css/duan.css',
		'summaryText'=>'',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'科室名称','name'=>'title'),
			array(
				'header'=>'操作',
				'value'=>'$data->getdellink($data->siteid)',
				),
			/*array(     
				'header'=>'操作',
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'template'=>'{delete}',
				'deleteButtonUrl'=>'Yii::app()->user->siteid == $data->siteid ? Yii::app()->createUrl("admin/departdel",array("id"=>$data->id)):""',    
				),
			*/ 

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>