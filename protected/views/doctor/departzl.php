<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 科室列表';
$this->breadcrumbs=array(
	'科室资料列表',
);
?>
<div class="clearfix part1">
	<p>
		<span class="btn1 btn_cur">所需问诊资料</span>
	</p>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$departzl->sitesearch(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
		'summaryText'=>'',
		'cssFile'=>'/css/duan.css',
		'columns'=>array(
			//array('header'=>'编号','name'=>'id'),
			array('header'=>'资料名称','name'=>'title'),
			array('header'=>'资料内容','name'=>'content'),

		),
		/*'pager'=>array(
		'header'=>'',//去掉翻页
		)*/
));
?>