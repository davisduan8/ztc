<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 资料列表';
$this->breadcrumbs=array(
	'资料列表',
);
?>
				<div class="clearfix part1">
					<p>
						<a href="#" class="btn1 btn_cur">问诊科室</a>
						<a href="index.php?r=manage/departzladd" class="btn2">增加所需资料</a>
					</p>
				</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$departzl->search(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'cssFile'=>'/css/duan.css',
		'summaryText'=>'',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'问诊科室','name'=>'title'),
			array('header'=>'问诊所需资料','name'=>'content'),
			array(     
				'header'=>'操作',
				'class'=>'CButtonColumn',     
				'deleteConfirmation'=>'确认要删除?', 
				'template'=>'{delete}',
				'deleteButtonUrl'=>'Yii::app()->createUrl("manage/departzldel",array("id"=>$data->id))',    
				), 

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>