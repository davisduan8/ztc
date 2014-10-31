<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 问诊科室';
$this->breadcrumbs=array(
	'问诊科室列表',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">问诊科室</span>
		<a href="index.php?r=admin/departzladd" class="btn2">增加所需资料</a>
	</p>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$departzl->sitesearch(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'summaryText'=>'',
		'cssFile'=>'/css/duan.css',
		'columns'=>array(
			array('header'=>'编号','name'=>'id'),
			array('header'=>'问诊科室','name'=>'title'),
			array('header'=>'科室所需资料','name'=>'content'), 
			array(
				'header'=>'操作',
				'value'=>'$data->getdellink($data->siteid)',
				),

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>