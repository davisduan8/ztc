<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - 医院列表';
$this->breadcrumbs=array(
	'医院列表',
);
?>
<style type="text/css">
dl{margin:0px; padding:0px;}
.h_flm{width:100%; height:35px; border-bottom:1px dotted #D2D2D2; padding-bottom:5px;}
.h_flm dt{width:100px; height:35px; background-color:#68AD5C; float:left; text-align:center; line-height:35px; color:#FFFFFF; border:1px solid #D2D2D2; margin-right:15px;}
.grid-view table.items{border-collapse:inherit;}
.grid-view table.items th{ background-image:none; background-color:#68AD5C;}
.grid-view table.items th, .grid-view table.items td{height:25px; text-align:center;}
.grid-view table.items #yw0_c0{width:70px;}
</style>
<dl class="h_flm">
	<dt>医院列表</dt>
	<dt><a href="index.php?r=admin/hospitaladd">增加医院</a></dt>
</dl>
<div style="clear:both"></div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$hospital->search(),
		//'template'=>'{summary}{items}{pager}',
		//'summaryText'=>'页数：{pages}/{page}页',
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